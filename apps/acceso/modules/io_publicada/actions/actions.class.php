<?php

require_once dirname(__FILE__).'/../lib/io_publicadaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/io_publicadaGeneratorHelper.class.php';

/**
 * io_publicada actions.
 *
 * @package    siglas
 * @subpackage io_publicada
 * @author     Livio Lopez
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class io_publicadaActions extends autoIo_publicadaActions
{
  public function extraerArray($array) {
      foreach ($array as $key => $value) {
          if(is_array($value)){
              $array_formateado[$key]=$this->extraerArray($value);
              
              if(is_numeric($key)){
                  return $array_formateado;
              }
          } else {
              $array_formateado[$key]=false;
          }
      }
      
      return $array_formateado;
  }

  public function executeRegresarConfiguraciones(sfWebRequest $request)
  {
    $this->redirect('configuracion/index?opcion=interoperabilidad');
  }
  
  public function executeDetectarParametrosSalida(sfWebRequest $request)
  {
        $parametros = $request->getParameter('siglas_servicios_publicados');
        $prueba = $request->getParameter('parametros_prueba');
      
        // URL DEL WS O SERVICIO QUE PUBLICAMOS EN ESTE SIGLAS
        $wsdl = trim($parametros['url'])."?wsdl";

        // INSTANCIAMOS EL WS     
        $client = new nusoap_client($wsdl,'wsdl');

        // FORMATEO DE PARAMETROS
        $input=array();
        if(isset($prueba['parametros_entrada'])){
            foreach ($prueba['parametros_entrada']['nombres'] as $key => $parametro) {
                if(!$parametro=='' && $prueba['parametros_entrada']['pruebas'][$key] != ''){
                    $input[trim($parametro)]= $prueba['parametros_entrada']['pruebas'][trim($key)];
                    $parametros_entrada[trim($parametro)]= $prueba['parametros_entrada']['tipo'][trim($key)];
                } else {
                    echo "<script>$('#button_save_servicio').hide();</script>";
                    echo '<div id="div_error_salida" class="error">Alguno de los parametros de entrada contiene valores vacios.</div>';
                    exit();
                }
            }
        }
        
        if(count($input)==0){
            echo "<script>$('#button_save_servicio').hide();</script>";
            echo '<div id="div_error_salida" class="error">Para detectar los parametros de salida debe agregar al menos un parametro de entrada.</div>';
            exit();
        }
        
        $param = array('input'=>$input);

        // LLAMADO DEl SERVICIO PARA QUE LLENE LA VARIABLE $response
        $response = $client->call(trim($parametros['funcion']), $param);
        
        // DETECTAMOS ALGUN ERROR CON LA CONEXION DE WS
        $error = $client->getError();
        
        if ($error) {
            return 'Error en la conexion con el servidor del web service.<br/><br/>'.$error;
        } else {
            // ANALIZAMOS EL FORMULARIO LOS DATOS QUE NOS DIO EL WEB SERVICE
            if(isset($response['notify'])){
                if(isset($response['notify']['status'])){
                    if($response['notify']['status']=='ok'){
                        $array_entrada_yml = sfYAML::dump($parametros_entrada);

                        $parametros__salida = $this->extraerArray($response['content']);

                        $array_salida_yml = sfYAML::dump($parametros__salida);
                        $array_salida_yml_print = str_replace(': false', '', $array_salida_yml);
                        echo '<br/><pre>';
                        print_r($parametros__salida);
                        echo '</pre>';

                        echo '<input type="hidden" name="siglas_servicios_publicados[parametros_entrada]" value="'.$array_entrada_yml.'"/>';
                        echo '<input type="hidden" name="siglas_servicios_publicados[parametros_salida]" value="'.$array_salida_yml.'"/>';

                        echo "<script>$('#button_save_servicio').show();</script>";
                    } else {
                        echo "Estatus de consulta: <font style='color: red;'>".$response['notify']['status']."</font><br>";
                        echo "Mensaje: ".$response['notify']['message']."<br>";
                        echo "<script>$('#button_save_servicio').hide();</script>";
                    }
                } else {
                    echo "Estatus de consulta: <font style='color: red;'>Error</font><br>";
                    echo "Mensaje: El WS no posee la estructura estadar para deteccion de errores<br>";
                    echo "<script>$('#button_save_servicio').hide();</script>";
                }
            } else {
                echo "Estatus de consulta: <font style='color: red;'>Error</font><br>";
                echo "Mensaje: El WS no posee la estructura estadar basica<br>";
                echo "<pre>";
                print_r($response);
                echo "<pre/>";
                echo "<script>$('#button_save_servicio').hide();</script>";
            }
        }
        
    $client->setDebugLevel(0);
    $client->clearDebug();
    exit();
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $datos =$request->getParameter('siglas_servicios_publicados');
    $crontab =$request->getParameter('frecuencia_crontab');
    
    if($datos['tipo'] == 'consulta'){
        $datos['crontab'] = 'false';
    } else {
        $frecuencia = $crontab['minuto'].' '.$crontab['hora'].' '.$crontab['dia_mes'].' '.$crontab['mes'].' '.$crontab['dia_semana'];
        $datos['crontab'] = $frecuencia;
    }
    
    $revision_servicios_publicados = Doctrine::getTable('Siglas_ServiciosPublicados')->findOneByFuncion($datos['funcion']);
    
    if((!$revision_servicios_publicados) || ($revision_servicios_publicados && $revision_servicios_publicados->getId() == $datos['id'])){
        $request->setParameter('siglas_servicios_publicados',$datos);

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
          $notice = $form->getObject()->isNew() ? 'El servicio se ha registrado correctamente.' : 'El servicio se ha editado correctamente.';

          try {
            $siglas_servicios_publicados = $form->save();

            if($siglas_servicios_publicados->getRecursos()!='false'){
                $ruta_recurso = sfConfig::get('sf_upload_dir').'/interoperabilidad/recursos_internos';
//                chmod($ruta_recurso, 0777);
                $nombre_recurso_new = sfConfig::get('sf_siglas').'_'.$siglas_servicios_publicados->getFuncion().'_'.$siglas_servicios_publicados->getTipo().'.zip';

                if (rename($ruta_recurso.'/'.$siglas_servicios_publicados->getRecursos(), $ruta_recurso.'/'.$nombre_recurso_new)){
                    // El archivo ha sido cargado correctamente
                    $siglas_servicios_publicados->setRecursos($nombre_recurso_new);
                    $siglas_servicios_publicados->save();
                } else {
                    echo $ruta_recurso.'/'.$siglas_servicios_publicados->getRecursos().'->'.$ruta_recurso.'/'.$nombre_recurso_new;
                    exit();
                }
            }

          } catch (Doctrine_Validator_Exception $e) {

            $errorStack = $form->getObject()->getErrorStack();

            $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
            foreach ($errorStack as $field => $errors) {
                $message .= "$field (" . implode(", ", $errors) . "), ";
            }
            $message = trim($message, ', ');

            $this->getUser()->setFlash('error', $message);
            return sfView::SUCCESS;
          }

          $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $siglas_servicios_publicados)));

          if ($request->hasParameter('_save_and_add'))
          {
            $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

            $this->redirect('@siglas_servicios_publicados_new');
          }
          else
          {
            $this->getUser()->setFlash('notice', $notice);

            $this->redirect(array('sf_route' => 'siglas_servicios_publicados_edit', 'sf_subject' => $siglas_servicios_publicados));
          }
        }
        else
        {
          $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }
    else
    {
      $this->getUser()->setFlash('error', 'Ya se ha registrado otro web service con el nombre de función '.$datos['funcion'].'.', false);
    }
  }
}
