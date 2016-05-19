<?php

require_once dirname(__FILE__).'/../lib/usuarioGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/usuarioGeneratorHelper.class.php';

/**
 * usuario actions.
 *
 * @package    sigla-(institution)
 * @subpackage xxxxx
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    0.1 $
 */
class usuarioActions extends autoUsuarioActions
{
  public function executeIndex(sfWebRequest $request)
  {
        // ########### LIMPIESA DE SESSIONES Y DATOS DE LOGEO ############
        $this->getUser()->setAuthenticated(false);
        $this->getUser()->clearCredentials();
        
        $sf_autenticacion = sfYaml::load(sfConfig::get("sf_root_dir")."/config/siglas/autenticacion.yml");
        if(isset($sf_autenticacion['asistente'])) {
            $this->sf_autenticacion= $sf_autenticacion['asistente'];
        }
  }
  
  public function executeResetToken(sfWebRequest $request)
  {
    $this->getUser()->setAttribute('session_count_token', 0);
    exit();
  }
  
  public function executeUpdateToken(sfWebRequest $request)
  {
    echo "<script>$('#token_update').html('token');</script>";
    
    $usuario = Doctrine::getTable('Acceso_Usuario')->find($this->getUser()->getAttribute('usuario_id'));
    $usuario->setUltimoStatus(date('Y-m-d h:i:s'));
    $usuario->save();

    $this->getUser()->setAttribute('session_count_token', $this->getUser()->getAttribute('session_count_token')+1);

    $session_expira = $this->getUser()->getAttribute('sf_session_expira')/2;
    
    if($this->getUser()->getAttribute('session_count_token')>=$session_expira){
        echo "<script>location.href='".sfConfig::get('sf_app_acceso_url')."usuario/expiraSession';</script>";
        exit();
    }
    
    $ultimo_intento = $session_expira-1;
    if($this->getUser()->getAttribute('session_count_token')==$ultimo_intento){
        echo "<script>
                $('#expira_minutos').html('1');
                $('#expira_segundos').html('59');
              </script>";
    }
        
    exit();
  }
  
  public function executeExpiraSession(sfWebRequest $request)
  {
        // ########### LIMPIESA DE SESSIONES Y DATOS DE LOGEO ############
        $this->getUser()->setAuthenticated(false);
        $this->getUser()->clearCredentials();
        $this->getUser()->getAttributeHolder()->clear();
  }
  
  public function executeCambiarTiempoSession(sfWebRequest $request){
        $this->getUser()->setAttribute('session_count_token', 0);
        $this->getUser()->setAttribute('sf_session_expira', $request->getParameter('minutos'));
        
        $usuario = Doctrine::getTable('Acceso_Usuario')->find($this->getUser()->getAttribute('usuario_id'));
        
        $variables_entorno = sfYaml::load($usuario->getVariablesEntorno());
        $variables_entorno['tiempo_expira_session'] = $request->getParameter('minutos');
        $variables_entorno = sfYAML::dump($variables_entorno);
        
        $usuario->setVariablesEntorno($variables_entorno);
        $usuario->save();
        
        exit();
  }

  public function executeNew(sfWebRequest $request)
  {
        $this->getUser()->getAttributeHolder()->clear();
        $this->getUser()->setFlash('error', 'Parece que se ha intentado violar el sistema. Se ha registrado este evento.');
        $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario');
  }

  public function executeOlvidoClave(sfWebRequest $request)
  {
  }

  public function executePrimerIngreso(sfWebRequest $request)
  {
  }

  public function executeFindUser(sfWebRequest $request)
  {
      $cedula = $request->getParameter('cedula');
      $funcionario = Doctrine::getTable('Funcionarios_Funcionario')->findOneByCi($cedula);

      if(count($funcionario) > 1) {
            $this->funcionario = $funcionario;
      } else {
            exit;
      }
  }

  public function executeTercerPaso(sfWebRequest $request)
  {
      $cedula = $request->getParameter('cedula');
      $funcionario = Doctrine::getTable('Funcionarios_Funcionario')->findOneByCi($cedula);

      $this->usuario_clavetemporal = Doctrine::getTable('Acceso_Usuario')->findOneByUsuarioEnlaceIdAndEnlaceId($funcionario->getId(),1);
      $this->funcionario= $funcionario;
  }

  public function executeChangeEmailorTelf(sfWebRequest $request) {
      $act = $request->getParameter('act');
      $cedula = $request->getParameter('cedula');
      $funcionario = Doctrine::getTable('Funcionarios_Funcionario')->findOneByCi($cedula);
      if($act== 'email') {
            $email = trim($request->getParameter('email'));
            $funcionario->setEmailPersonal($email);
            $funcionario->setIdUpdate('999999');
            $funcionario->save();
            echo $email;
            exit;
      }else {
            $telf = $request->getParameter('telf');
            $funcionario->setTelfMovil($telf);
            $funcionario->setIdUpdate('999999');
            $funcionario->save();
            exit;
      }

  }

  public function executeEnviarCodigoValidador(sfWebRequest $request)
  {
        $email_escrito= trim($request->getParameter('email'));
        $funcionario = Doctrine::getTable('Funcionarios_Funcionario')->find($this->getUser()->getAttribute('funcionario_id'));

        if($funcionario->getEmailPersonal()==$email_escrito) {
            $chars = "abcdefghijkmnopqrstuvwxyz023456789";
            srand((double)microtime()*1000000);
            $i = 0;
            $temporal = '';

            while ($i <= 7) {
                $num = rand() % 33;
                $tmp = substr($chars, $num, 1);
                $temporal = $temporal . $tmp;
                $i++;
            }

            $codigo_crypt = crypt($temporal,$funcionario->getCi());

            $funcionario->setCodigoValidadorEmail($codigo_crypt);
            $funcionario->save();

            $mensaje['mensaje'] = 'Gracias por validar tu correo electrónico.<br/><br/>'.
                    'Ingresa el siguiente código en el campo "Código validador"<br/><br/>'.
                    '<b>Codigo:</b> '.$temporal;

            $mensaje['emisor'] = 'Validador de email SIGLAS';
            $mensaje['receptor'] = $funcionario->getPrimerNombre().' '.$funcionario->getPrimerApellido();

            Email::notificacion_libre('validacion', $funcionario->getEmailPersonal(), $mensaje);

//            echo '<script>alert("En su correo electrónico encontrará el Codigo Validador para ingresarlo y poder continuar.");</script>';
        } else {
//            echo '<script>alert("El correo electrónico fue modificado, por tanto no podra ejecutar esta acción, por favor ingrese su correo electrónico e intentelo de nuevo.");</script>';
        }

        exit();
  }

  public function executeConfirmarCodigoValidador(sfWebRequest $request)
  {
        $email_escrito= trim($request->getParameter('email'));
        $funcionario = Doctrine::getTable('Funcionarios_Funcionario')->find($this->getUser()->getAttribute('funcionario_id'));

        $codigo_crypt = crypt(trim($request->getParameter('codigo_validador')),$funcionario->getCi());

        if($funcionario->getCodigoValidadorEmail()==$codigo_crypt) {
            $funcionario->setEmailValidado(TRUE);
            $funcionario->save();

            $this->getUser()->setFlash('notice', ' Gracias por validar tu correo electrónico.');
        } else {
            $this->getUser()->setFlash('error_validacion', ' El código validador no corresponde con el enviado a su correo electrónico.');
        }

        $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario/session');
  }

  public function executeClaveTemporal(sfWebRequest $request)
  {
        $app= 'contraseña';
        if($request->getParameter('act')) {
            $firstime= true;
            $envio_sms= $request->getParameter('celphone');
            $app= 'bienvenido';
        }else {
            $firstime= false;
        }

        $cedula = $request->getParameter('cedula');
        $funcionario = Doctrine::getTable('Funcionarios_Funcionario')->findOneByCi($cedula);

        if($funcionario)
        {
            if($funcionario->getEmailInstitucional()!=null || $funcionario->getEmailPersonal()!=null || $funcionario->getTelfMovil()!=null)
            {
                $usuario_clavetemporal = Doctrine::getTable('Acceso_Usuario')->findOneByUsuarioEnlaceIdAndEnlaceId($funcionario->getId(),1);

                $chars = "abcdefghijkmnopqrstuvwxyz023456789";
                srand((double)microtime()*1000000);
                $i = 0;
                $temporal = '';

                while ($i <= 7) {
                    $num = rand() % 33;
                    $tmp = substr($chars, $num, 1);
                    $temporal = $temporal . $tmp;
                    $i++;
                }

                $temporal_crypt = crypt($temporal,$usuario_clavetemporal->getNombre());

                $this->getUser()->setAttribute('usuario_id', 0);
                $usuario_clavetemporal->setClaveTemporal($temporal_crypt);
                $usuario_clavetemporal->save();
                $this->getUser()->getAttributeHolder()->remove('usuario_id');

                if($firstime == false) {
                    $mensaje['mensaje'] = 'Se ha generado una contraseña temporal automaticamente.<br/><br/>'.
                            'Para ingresar al SIGLAS introduzca los siguientes datos: <br/><br/>'.
                            '<b>Usuario:</b> '.$usuario_clavetemporal->getNombre().'<br/>'.
                            '<b>Contraseña:</b> '.$temporal;

                    $mensaje['emisor'] = 'Recuperación de contraseña';
                    $mensaje['receptor'] = $funcionario->getPrimerNombre().' '.$funcionario->getPrimerApellido();

                    $recipiente = '';
                    if ($funcionario->getEmailInstitucional()!=null)
                    {
                        Email::notificacion_libre($app, $funcionario->getEmailInstitucional(), $mensaje);
                        $recipiente = 'correo electronico institucional';
                    }
                }else {
                    $mensaje['mensaje'] = 'Bienvenid@ al SIGLAS. Al ingresar con la contraseña temporal el sistema le pedir&aacute; cambiarla por una propia.<br/><br/>'.
                            'Para ingresar al SIGLAS introduzca los siguientes datos: <br/><br/>'.
                            '<b>Usuario:</b> '.$usuario_clavetemporal->getNombre().'<br/>'.
                            '<b>Contraseña:</b> '.$temporal;

                    $mensaje['emisor'] = 'Bienvenido al SIGLAS';
                    $mensaje['receptor'] = $funcionario->getPrimerNombre().' '.$funcionario->getPrimerApellido();
                }

                if ($funcionario->getEmailPersonal()!=null)
                {
                    Email::notificacion_libre($app, $funcionario->getEmailPersonal(), $mensaje);
                    if($recipiente=='')
                        $recipiente = 'correo electronico personal';
                    elseif ($funcionario->getTelfMovil()!=null)
                        $recipiente .= ', su correo electronico personal';
                    else
                        $recipiente .= ' y su correo electronico personal.';
                }

                if($firstime == false || $envio_sms== 'on') {
                    if ($funcionario->getTelfMovil()!=null)
                    {
                        $mensaje['mensaje'] = 'usuario: '.$usuario_clavetemporal->getNombre().' - contrasena temporal: '.$temporal;

                        Sms::notificacion_sistema($app, $funcionario->getTelfMovil(), $mensaje);
                        if($recipiente=='')
                            $recipiente = 'telefono movil.';
                        else
                            $recipiente .= ' y su telefono movil.';
                    }
                }

                if($firstime == false)
                    $this->getUser()->setFlash('notice', ' Se ha enviado la clave temporal a su '.$recipiente);
                else
                    $this->getUser()->setFlash('notice', ' En su correo electrónico encontrará Usuario y Clave temporal para ingresar.');
            } else {
                $this->getUser()->setFlash('error', ' La cédula no tiene ningún correo electronico o telefono movil asociado, por lo cual no podra recuperar la contraseña de esta manera, por favor comuniquese con la Oficina de Tecnologia.');
            }
        } else {
            $this->getUser()->setFlash('error', ' La cédula que ingreso no se encuentra registrada en el sistema.');
        }

        $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario');
  }

  public function executeCambioClave(sfWebRequest $request)
  {
      $this->usuario = $request->getParameter('user');

      // la variable nuevo viene del template cambioClave
      if($request->getParameter('nuevo'))
      {
          $actual = strtolower(trim($request->getParameter('actual')));
          $nuevo = strtolower(trim($request->getParameter('nuevo')));
          $repite = strtolower(trim($request->getParameter('repite')));

          $abc = 'abcdefghijklmnñopqrstuvwxyz012345678909876543210';

          if($nuevo != $repite)
          {
              $this->getUser()->setFlash('error', ' Error en la contraseña nueva y su repetición');
          }
          elseif (strlen($nuevo) < 6) // CLAVE MAYOR A 5 CARACTERES
          {
              $this->getUser()->setFlash('error', ' La contraseña nueva tiene que tener al menos 6 caracteres');
          }
          elseif(preg_match('/'.$nuevo.'/', $abc)) // CLAVE NO PUEDE SER CADENAS 123456 ABCDEF
          {
              $this->getUser()->setFlash('error', ' La contraseña nueva no puede ser cadenas como "abcdef" o "123456"');
          }
          else
          {
              $usuario = $request->getParameter('user');
              $actual_tmp = $actual;

              $actual = crypt($actual_tmp,$usuario);
              $usuario_buscar = Doctrine::getTable('Acceso_Usuario')->findOneByNombreAndClave($usuario,$actual);

              if(!$usuario_buscar)
              {
                  $usuario_buscar = Doctrine::getTable('Acceso_Usuario')->findOneByNombreAndClaveTemporal($usuario,$actual);
              }

              if($usuario_buscar)
              {
                  $nuevo = crypt($nuevo,$usuario);

		    $conn = Doctrine_Manager::connection();
		    try
		    {
                        $conn->beginTransaction();

    			$usuario_cambioclave = Doctrine::getTable('Acceso_Usuario')->find($usuario_buscar->getId());

    			$usuario_cambioclave -> setClave($nuevo);
                        $usuario_cambioclave -> setStatus('A');
                        $usuario_cambioclave -> setVisitas($usuario_cambioclave -> get("visitas") + 1);
                        $usuario_cambioclave -> setUltimocambioclave(date('Y-m-d H:i:s'));
                        $usuario_cambioclave -> setClaveTemporal(null);

                        if($this->getUser()->getAttribute('usuario_id'))
                            $usuario_cambioclave -> setIdUpdate($this->getUser()->getAttribute('usuario_id'));
                        else
                            $usuario_cambioclave -> setIdUpdate($usuario_buscar->getId());

                        $usuario_cambioclave -> save();

		        $auditoriaclave = new Acceso_AuditoriaClave();
		        $auditoriaclave ->setUsuarioId($this->getUser()->getAttribute('usuario_id'));
		        $auditoriaclave ->setClave($nuevo);
		        $auditoriaclave ->setFechaCambio(date('Y-m-d H:i:s'));


		        $auditoriaclave -> save();

                        $conn->commit();

                        if($this->getUser()->getAttribute('usuario_id')) {
                            $this->getUser()->setFlash('notice', ' El cambio se a efectuado correctamente. La proxima vez que ingrese al sistema introduzca su nueva contraseña');
                            $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario/session');

                        } else {
                            $this->getUser()->setFlash('notice', ' El cambio se a efectuado correctamente, por favor ingrese al sistema con su nueva contraseña');

                            $this->getUser()->setAuthenticated(false);
                            $this->getUser()->clearCredentials();
                            $this->getUser()->getAttributeHolder()->clear();

                            $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario');
                        }
		    }
		    catch (Exception $e){
		        $conn->rollBack();
		        throw $e;

                        $this->getUser()->setFlash('error', ' El cambio de contraseña no se pudo efectuar, por favor intente nuevamente o comuniquese a la Direccion de Informática');
		    }
              }
              else
              {
                  $this->getUser()->setFlash('error', ' Error en el usuario o contraseña actual');
              }
          }
      }
  }

  public function executeSession(sfWebRequest $request)
  {
        // ########### DATOS PARA PANTALLA INICIAL ############
        $session_usuario = $this->getUser()->getAttribute('session_usuario');
        if($session_usuario['enlace_id']==1)
        {
            // ########### FUNCIONARIOS ############
            $this->datosfuncionario_list = Doctrine::getTable('Funcionarios_Funcionario')->datosSessionFuncionario($this->getUser()->getAttribute('funcionario_id'));
            //$this->datosamigos = Doctrine::getTable('Public_Amigo')->buscarAmigo($this->getUser()->getAttribute('funcionario_id'));

//            $delegado = Doctrine::getTable('Acceso_AccionDelegada')->FuncionarioDelegado(sfContext::getInstance()->getUser()->getAttribute('usuario_id'));
        }
        elseif($session_usuario['enlace_id']==2)
        {
            // ########### FUNCIONARIOS ############
            $this->datosproveedor_list = Doctrine::getTable('Proveduria_Proveedor')->find($this->getUser()->getAttribute('funcionario_id'));
        }
        else
        {
            // ########### ERROR NO TIENE ENLACE A TABLAS DE PERSONA ############
            $this->getUser()->getAttributeHolder()->clear();
            $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario');
        }

//        $this->mensajes = Doctrine::getTable('Public_Mensajes')->mensajesActivos($this->getUser()->getAttribute('funcionario_id'));
  }

  public function executeSalir()
  {
        // ########### LIMPIESA DE SESSIONES Y DATOS DE LOGEO ############
        $this->getUser()->setAuthenticated(false);
        $this->getUser()->clearCredentials();
        $this->getUser()->getAttributeHolder()->clear();

        $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario');
  }

  public function executeLogin(sfWebRequest $request)
  {
        // ########### ADMIN MODULE ############
        $correspondencia= TRUE;
        $archivo= TRUE;
        $rrhh= TRUE;
        $inventario= FALSE;
        $vehiculo= FALSE;
        
        // ########### LIMPIESA DE SESSIONES Y DATOS DE LOGEO ############
        $this->getUser()->setAuthenticated(false);
        $this->getUser()->clearCredentials();
        $this->getUser()->getAttributeHolder()->clear();
        
        // ########### CAPTURAR IP, PUERTA Y PC ##############
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            $ip=$_SERVER["HTTP_X_FORWARDED_FOR"];
            $puerta=$_SERVER["REMOTE_ADDR"];
            $pc = gethostbyaddr($ip);
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
            $pc = gethostbyaddr($ip);
            $puerta='NINGUNA';
        }
        
        // ########### VERIFICAR IP VALIDA DE ACCESO ##############
        $rangos_ip = explode(';',sfConfig::get('sf_rangos_ip'));
        $rangos_ip[] = '127.0.0.1';
        
        $ip_i = 'i'.$ip;
        $ip_valida = FALSE;
        foreach ($rangos_ip as $rango_ip) {
            $rango_ip_i = 'i'.$rango_ip;
            if(preg_match('/'.$rango_ip_i.'/', $ip_i)){
               $ip_valida = TRUE; 
            }
        }
        
        // ########### PARAMETROS DEL FORMULARIO ############
        $usuario=strtolower(trim($request->getParameter('usuario')));
        $contrasena_tmp=strtolower(trim($request->getParameter('contrasena')));
        $contrasena_ldap = trim($request->getParameter('contrasena'));

        // ########### ENCRIPTAMIENTO DE LA CONTRASEÑA PARA LA BUSQUEDA EN TABLA ############
        
        $sf_autenticacion = sfYaml::load(sfConfig::get("sf_root_dir")."/config/siglas/autenticacion.yml");
        
        // ########### AUTENTICACION INTERNA ############
        $usuario_session = '';
        $metodo_ingreso = '';
        if($sf_autenticacion['metodo']=='siglas' || $sf_autenticacion['metodo']=='ambos'){
            $contrasena = crypt($contrasena_tmp,$usuario);
            $usuario_session = Doctrine::getTable('Acceso_Usuario')->findOneByNombreAndClave($usuario,$contrasena);
            $metodo_ingreso = 'siglas';
        }
        
        // ########### AUTENTICACION LDAP ############
        if(($sf_autenticacion['metodo']=='ldap' || $sf_autenticacion['metodo']=='ambos') && ($usuario_session == '')){
            // ########### VERIFICAR CONEXION LDAP ############
            $ds = ldap_connect($sf_autenticacion['parametros_ldap']['url']);
            if (!$ds) {
                $this->getUser()->setFlash('error', 'No fue posible la conexión con el servidor LDAP, contacte al administrador del SIGLAS.');
                $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario');
            }
            // ########### SETEAR LA VERSION DEL PROTOCOLO LDAP ############
            ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, $sf_autenticacion['parametros_ldap']['version']);
            
            // ########### CAPTURAR ATRIBUTOS DEL LDAP ############
            $r = ldap_bind($ds);
            
            $sr = ldap_search($ds, $sf_autenticacion['parametros_ldap']['dc'], "uid=".$usuario);
            $entry = ldap_get_entries($ds, $sr);
            
            if(count($entry[0])>0){
                // ########### BUSCAR NOMBRE GLOBAL UNICO (Distinguished Name – DN) DE USUARIO ############
                $dn='';
                foreach ($entry[0] as $key => $value) {
                    if($key=='dn'){
                        $dn = $value;
                    }
                }

                if($dn==''){
                    $this->getUser()->setFlash('error', 'No fue posible identificar el DN del servidor LDAP, contacte al administrador del SIGLAS.');
                    $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario');
                }
                
                // ########### AUTENTICAR USUARIO CON LDAP ############ 
                $r = ldap_bind($ds, $dn, $contrasena_ldap);

                if ($r) {
                    // ########### SI AUTENTICA LDAP BUSCA USUARIO EN SIGLAS ############ 
                    $usuario_session = Doctrine::getTable('Acceso_Usuario')->findOneByLdap($usuario);

                    if(!$usuario_session){
                        $this->getUser()->setFlash('error', 'El usuario existe en el servidor LDAP, sin embargo no posee acceso SIGLAS.');
                        $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario');
                    }
                }
            }
            
            $metodo_ingreso = 'ldap';
        }

        // ########### SI EL USUARIO FUE ENCONTRADO ############
        if($usuario_session)
        {
            // ########### VERIFICACION DEL ULTIMO CAMBIO DE CLAVE (MAXIMO 180 DIAS) ############
            $dias_ultimocambio = floor((time() - strtotime($usuario_session->getUltimocambioclave())) / 86400 );
            
            if ($usuario_session->getAccesoGlobal() == TRUE){
                $ip_valida = TRUE;
            }

            if ($usuario_session->getStatus() == 'I')
            {
                // ########### USUARIO INACTIVO ############
                $this->getUser()->setFlash('error', 'El usuario se encuentra inactivo o no tiene un perfil asociado.');
                $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario');
            }
            elseif ($ip_valida == FALSE)
            {
                // ########### VERIFICAR ACCESO GLOBAL ############
                $this->getUser()->setFlash('error', 'Usted no esta autorizado para ingresar fuera las instalaciones de '.sfConfig::get('sf_siglas').'.');
                $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario');
            }
            elseif ($usuario_session->getStatus() == 'R' &&  $metodo_ingreso != 'ldap')
            {
                $this->getUser()->setAttribute('usuario_id', $usuario_session->getId());
                // ########### REINICIO DE CLAVE ############
                $this->getUser()->setFlash('notice', 'La contraseña se ha reiniciado. Para comenzar el uso del sistema es necesario crear una contraseña nueva.');
                $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario/cambioClave?user='.$usuario_session->getNombre());
            }
            elseif($dias_ultimocambio > 180 &&  $metodo_ingreso != 'ldap')
            {
                $this->getUser()->setAttribute('usuario_id', $usuario_session->getId());
                // ########### PEDIR CAMBIO DE CLAVE SI NO LO HA ECHO EN 60 DIAS ############
                $this->getUser()->setFlash('notice', 'Su contraseña tiene mas de 6 meses de uso, por motivos de seguridad, resguardo de sus datos y para continuar el uso del sistema es necesario renovarla.');
                $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario/cambioClave?user='.$usuario_session->getNombre());
            }
            elseif ($usuario_session->getVisitas() == 0  &&  $metodo_ingreso != 'ldap')
            {
                $this->getUser()->setAttribute('usuario_id', $usuario_session->getId());
                // ########### PEDIR CAMBIO DE CLAVE SI ES PRIMERA VES QUE INGRESA ############
                $this->getUser()->setFlash('notice', 'Bienvenido al SIGLAS-'.sfConfig::get('sf_siglas').', por motivos de seguridad, resguardo de sus datos y para comenzar el uso del sistema es necesario crear una contraseña nueva.');
                $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario/cambioClave?user='.$usuario_session->getNombre());
            }
            else
            {
                // ########### SI TODO ESTA BIEN BUSCAR LOS PERFILES DEL USUARIO ############

                $usuario_perfiles = Doctrine::getTable('Acceso_UsuarioPerfil')->buscarPerfiles($usuario_session->getId());

                if(count($usuario_perfiles)>0)
                {
                    // ########### SI TIENE PERFILES AGREGAR LOS NOMBRES COMO CREDENCIALES PARA EL ACCESO ############
                    // ########### Y GENERAR UNA CADENA CON LOS ID Y AGREGARLOS COMO SESSION PARA EL MENU ############

                    $perfiles = count($usuario_perfiles);

                    $perfiles_ids = array();

                    for($i=0;$perfiles>$i;$i++)
                    {
                        $perfiles_ids[$i] = $usuario_perfiles[$i]['id'];

                        $this->getUser()->addCredential($usuario_perfiles[$i]['nombre']);
                    }

                    // ########### SI TODO ESTA BIEN CREAR DATOS DE LOGEO ############

                    $this->getUser()->setAuthenticated(true);
                    $this->getUser()->setCulture('es');
                    
                    // CONTADOR DE CANTIDAD DE ACTUALIZACIONES DE ULTIMO STATUS
                    $this->getUser()->setAttribute('session_count_token', 0);

                    // INICIO NUEVO FORMATO DE SESSION DE DATOS DE USUARIO
                    // INICIO NUEVO FORMATO DE SESSION DE DATOS DE USUARIO
                    // INICIO NUEVO FORMATO DE SESSION DE DATOS DE USUARIO
                    $this->getUser()->setAttribute('usuario_id', $usuario_session->getId());
                    
                    $session_usuario['usuario_nombre'] = $usuario_session->getNombre();
                    $session_usuario['enlace_id'] = $usuario_session->getEnlaceId();
                    $session_usuario['visitas'] = $usuario_session->getVisitas();
                    $session_usuario['ultima_conexion'] = $usuario_session->getUltimaconexion();
                    $session_usuario['tema'] = $usuario_session->getTema();
                    
                    $this->getUser()->setAttribute('session_usuario', $session_usuario);
                    
                    // FIN NUEVO FORMATO DE SESSION DE DATOS DE USUARIO
                    // FIN NUEVO FORMATO DE SESSION DE DATOS DE USUARIO
                    // FIN NUEVO FORMATO DE SESSION DE DATOS DE USUARIO

                    // ########### SI ES FUNCIONARIO BUSCAR UNIDAD Y DATOS DE PERSONA ############

                    if($usuario_session->getEnlaceId()==1){
                        
                        $funcionario_persona = Doctrine::getTable('Funcionarios_Funcionario')->find($usuario_session->getUsuarioEnlaceId());

//                        $this->getUser()->setAttribute('funcionario_ci', $funcionario_persona->get("ci"));
                        
                        // INICIO NUEVO FORMATO DE SESSION DE DATOS DE FUNCIONARIO
                        // INICIO NUEVO FORMATO DE SESSION DE DATOS DE FUNCIONARIO
                        // INICIO NUEVO FORMATO DE SESSION DE DATOS DE FUNCIONARIO
                        $this->getUser()->setAttribute('funcionario_id', $funcionario_persona->getId());
                        
                        $session_funcionario['cedula'] = $funcionario_persona->getCi();
                        $session_funcionario['primer_nombre'] = $funcionario_persona->getPrimerNombre();
                        $session_funcionario['segundo_nombre'] = $funcionario_persona->getSegundoNombre();
                        $session_funcionario['primer_apellido'] = $funcionario_persona->getPrimerApellido();
                        $session_funcionario['segundo_apellido'] = $funcionario_persona->getSegundoApellido();
                        $session_funcionario['sexo'] = $funcionario_persona->getSexo();
                        
                        $this->getUser()->setAttribute('session_funcionario', $session_funcionario);
                        // FIN NUEVO FORMATO DE SESSION DE DATOS DE FUNCIONARIO
                        // FIN NUEVO FORMATO DE SESSION DE DATOS DE FUNCIONARIO
                        // FIN NUEVO FORMATO DE SESSION DE DATOS DE FUNCIONARIO

                        // INICIO NUEVO FORMATO DE SESSION DE DATOS DE CARGOS
                        // INICIO NUEVO FORMATO DE SESSION DE DATOS DE CARGOS
                        // INICIO NUEVO FORMATO DE SESSION DE DATOS DE CARGOS
                        $funcionario_unidades = Doctrine::getTable('Funcionarios_FuncionarioCargo')->unidadDelCargoDelFuncionario($usuario_session->getUsuarioEnlaceId());
                        $config_pkcsc='';
                        $i=0;
                        foreach ($funcionario_unidades as $funcionario_unidad) {
                            $session_cargos[$i]['funcionario_cargo_id'] = $funcionario_unidad->getId();
                            $session_cargos[$i]['unidad_id'] = $funcionario_unidad->getUnidadId();
                            $session_cargos[$i]['cargo_id'] = $funcionario_unidad->getCargoId();
                            $session_cargos[$i]['cargo_condicion_id'] = $funcionario_unidad->getCargoCondicionId();
                            $session_cargos[$i]['cargo_tipo_id'] = $funcionario_unidad->getCargoTipoId();
                            $session_cargos[$i]['cargo_grado_id'] = $funcionario_unidad->getCargoGradoId();
                            
                            $funcionario_certificado = Doctrine::getTable('Funcionarios_FuncionarioCargoCertificado')->findOneByFuncionarioCargoIdAndStatus($funcionario_unidad->getId(),'A');                            

                            if($funcionario_certificado){
                                $configuraciones_pkcsc = sfYaml::load($funcionario_certificado->getConfiguraciones());

                                // configuracion de token
                                foreach ($configuraciones_pkcsc as $configuracion_pkcsc) {
                                    if($configuracion_pkcsc['ip']==$ip){
                                        $config_pkcsc=$configuracion_pkcsc['configuracion'];
                                    } else if($config_pkcsc==''){
                                        $config_pkcsc=$configuracion_pkcsc['configuracion'];
                                    }
                                }
                            }
                            $i++;
                        }
                        $this->getUser()->setAttribute('config_pkcsc', $config_pkcsc);
                        
                        $this->getUser()->setAttribute('session_cargos', $session_cargos);
                        // FIN NUEVO FORMATO DE SESSION DE DATOS DE CARGOS
                        // FIN NUEVO FORMATO DE SESSION DE DATOS DE CARGOS
                        // FIN NUEVO FORMATO DE SESSION DE DATOS DE CARGOS
                        
                        $this->getUser()->setAttribute('funcionario_cargo_id', $funcionario_unidades[0]['cargo_id']);
                        $this->getUser()->setAttribute('funcionario_unidad_id', $funcionario_unidades[0]['unidad_id']);

                        $funcionario_list = Doctrine::getTable('Funcionarios_Funcionario')->datosSessionFuncionario($usuario_session->getUsuarioEnlaceId());
                        $this->getUser()->setAttribute('funcionario_gr', $funcionario_list[0]['cgid']);

//                        SESIONES PARA LA CARGA DE CORRESPONDENCIA SIN LEER (COMENTAR EN CASO TAL)
                        if($funcionario_list[0]['cgid'] != 99) {
                            $unidades= Array();
                            $unidades[]= 0; 
                            //unidades a las que el usuario tiene acceso
                            $unidades_autorizadas = Doctrine::getTable('Correspondencia_FuncionarioUnidad')->funcionarioAutorizado($usuario_session->getUsuarioEnlaceId());
                            foreach($unidades_autorizadas as $values) {
                                $unidades[]= $values->getAutorizadaUnidadId();
                            }

//                            autoridades (99's) de los grupos a los que pertenece el usuario
                            $unidad_autoridad= Doctrine::getTable('Organigrama_Cargo')->autoridadesPorUnidad($unidades);
                            $this->getUser()->setAttribute('funcionario_autoridades_autorizadas', $unidad_autoridad);
                        }

                    } elseif($usuario_session->getEnlaceId()==2) {
                        $this->getUser()->setAttribute('proveedor_id', $usuario_session->getUsuarioEnlaceId());
                    }

                    // ########### INCREMENTAR EL NUMERO DE VISITAS Y LA FECHA DE LA UNTIMA VISITA ############

                    $usuario_registrarvisita = Doctrine::getTable('Acceso_Usuario')->find($usuario_session->getId());

                    $usuario_registrarvisita->setVisitas($usuario_registrarvisita->getVisitas() + 1);
                    $usuario_registrarvisita->setUltimaconexion(date('Y-m-d H:i:s'));
                    $usuario_registrarvisita->setClaveTemporal(null);
                    $usuario_registrarvisita->setIp($ip);
                    $usuario_registrarvisita->setPuerta($puerta);
                    $usuario_registrarvisita->setPc($pc);

                    $agente = $_SERVER["HTTP_USER_AGENT"];

                    // Detección del Sistema Operativo
                    $so = "Otro";
                    if(preg_match("/Win/i", $agente))$so = "Windows";
                    elseif((preg_match("/Mac/i", $agente)) || (preg_match("/PPC/i", $agente))) $so = "Mac";
                    elseif(preg_match("/Linux/i", $agente))$so = "Linux";
                    elseif(preg_match("/FreeBSD/i", $agente))$so = "FreeBSD";
                    elseif(preg_match("/SunOS/i", $agente))$so = "SunOS";
                    elseif(preg_match("/IRIX/i", $agente))$so = "IRIX";
                    elseif(preg_match("/BeOS/i", $agente))$so = "BeOS";
                    elseif(preg_match("/OS\/2/i", $agente))$so = "OS/2";
                    elseif(preg_match("/AIX/i", $agente))$so = "AIX";

                    $usuario_registrarvisita->setSo($so);
                    $usuario_registrarvisita->setAgente($agente);
                    
                    $edit_variables_entorno = 0;
                    $variables_entorno = sfYaml::load($usuario_registrarvisita->getVariablesEntorno());
                    
                    // INICIO REVISION DE VARIABLES DE ENTORNO
                    if(!isset($variables_entorno['tiempo_expira_session'])){
                        $sf_seguridad = sfYaml::load(sfConfig::get("sf_root_dir")."/config/siglas/seguridad.yml");
                        
                        $variables_entorno['tiempo_expira_session'] = $sf_seguridad['session']['expira'];
                        $variables_entorno_yml = sfYAML::dump($variables_entorno);
                        $usuario_registrarvisita->setVariablesEntorno($variables_entorno_yml);
                    }
                    
                    if(!isset($variables_entorno['correspondencia'])){
                        $variables_entorno['correspondencia'] = array();
                        $edit_variables_entorno = 1;
                    }
                    
                    if(!isset($variables_entorno['correspondencia']['bandeja_enviada_defecto'])){
                        $variables_entorno['correspondencia']['bandeja_enviada_defecto'] = ' ';
                        $edit_variables_entorno = 1;
                    }
                    
                    if(!isset($variables_entorno['correspondencia']['bandeja_recibida_defecto'])){
                        $variables_entorno['correspondencia']['bandeja_recibida_defecto'] = '';
                        $edit_variables_entorno = 1;
                    }
                    
                    if(!isset($variables_entorno['correspondencia']['bandeja_externa_defecto'])){
                        $variables_entorno['correspondencia']['bandeja_externa_defecto'] = '';
                        $edit_variables_entorno = 1;
                    }
                    
                    if($edit_variables_entorno == 1){
                        $variables_entorno_yml = sfYAML::dump($variables_entorno);
                        $usuario_registrarvisita->setVariablesEntorno($variables_entorno_yml);
                    }
                    // FIN REVISION DE VARIABLES DE ENTORNO
                    
                    $this->getUser()->setAttribute('sf_variables_entorno', $variables_entorno);
                    $this->getUser()->setAttribute('sf_session_expira', $variables_entorno['tiempo_expira_session']);
                        
                    $usuario_registrarvisita->save();

                    if(preg_match("/Firefox\/2\./", $agente) ||
                       preg_match("/Firefox\/3\./", $agente) ||
                       preg_match("/Firefox\/4\./", $agente) ||
                       preg_match("/Firefox\/5\./", $agente) ||
                       preg_match("/Firefox\/6\./", $agente) ||
                       preg_match("/Firefox\/7\./", $agente) ||
                       preg_match("/Firefox\/8\./", $agente) ||
                       preg_match("/Firefox\/9\./", $agente) ||
                       preg_match("/Firefox\/10\./", $agente) ||
                       preg_match("/Firefox\/11\./", $agente) ||
                       preg_match("/Firefox\/12\./", $agente) ||
                       preg_match("/Firefox\/13\./", $agente) ||
                       preg_match("/Firefox\/14\./", $agente) ||
                       preg_match("/Firefox\/15\./", $agente) ||
                       preg_match("/Firefox\/16\./", $agente) ||
                       preg_match("/Firefox\/17\./", $agente) ||
                       preg_match("/Firefox\/18\./", $agente) ||
                       preg_match("/Firefox\/19\./", $agente) ||
                       preg_match("/Firefox\/20\./", $agente) ||
                       preg_match("/Firefox\/21\./", $agente) ||
                       preg_match("/Firefox\/22\./", $agente) ||
//                       preg_match("/Firefox\/23\./", $agente) ||
                       preg_match("/Chrome\/6\./", $agente) ||
                       preg_match("/Chrome\/7\./", $agente) ||
                       preg_match("/Chrome\/8\./", $agente) ||
                       preg_match("/Chrome\/9\./", $agente) ||
                       preg_match("/Chrome\/10\./", $agente) ||
                       preg_match("/Chrome\/11\./", $agente) ||
                       preg_match("/Chrome\/12\./", $agente) ||
                       preg_match("/Chrome\/13\./", $agente) ||
                       preg_match("/Chrome\/14\./", $agente) ||
                       preg_match("/Chrome\/15\./", $agente) ||
                       preg_match("/Chrome\/16\./", $agente) ||
                       preg_match("/Chrome\/17\./", $agente) ||
                       preg_match("/Chrome\/18\./", $agente) ||
                       preg_match("/Chrome\/19\./", $agente) ||
                       preg_match("/Chrome\/20\./", $agente) ||
                       preg_match("/Chrome\/21\./", $agente) ||
                       preg_match("/Chrome\/22\./", $agente) ||
                       preg_match("/Chrome\/23\./", $agente) ||
                       preg_match("/Chrome\/24\./", $agente) ||
                       preg_match("/Chrome\/25\./", $agente) ||
                       preg_match("/Chrome\/26\./", $agente) ||
                       preg_match("/Chrome\/27\./", $agente) ||
                       preg_match("/Chrome\/28\./", $agente) ||
  //                     preg_match("/Chrome\/29\./", $agente) ||
  //                     preg_match("/Chrome\/30\./", $agente) ||
                       preg_match("/MSIE 4\./",$agente) ||
                       preg_match("/MSIE 5\./",$agente) ||
                       preg_match("/MSIE 6\./",$agente) ||
                       preg_match("/MSIE 7\./",$agente) ||
                       preg_match("/MSIE 8\./",$agente) ||
                       preg_match("/MSIE 9\./",$agente) ||
                       preg_match("/Opera\/8\./",$agente) ||
                       preg_match("/Opera\/9\./",$agente) ||
                       preg_match("/Opera\/10\./",$agente) ||
                       preg_match("/Opera\/11\./",$agente)
                            )
                    {   $this->getUser()->setAuthenticated(false);
                        $this->getUser()->clearCredentials();
                        $this->getUser()->getAttributeHolder()->clear();
                        $this->getUser()->setFlash('actualizar', 't');
                        $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario'); }

                    // #####################################################
                    // ########### INICIO GENERAR MENU DINAMICO ############
                    // #####################################################


                    $funcionarios_cargos= Array();
                    $funcionarios_unidades= Array();
                    for($i=0; $i< count($funcionario_unidades); $i++) {
                        $funcionarios_unidades[]= $funcionario_unidades[$i]['unidad_id'];
                        $funcionarios_cargos[]= $funcionario_unidades[$i]['cargo_grado_id'];
                    }
                    
                    $usuario_menu = Doctrine::getTable('Acceso_ModuloPerfil')->buscarModuloPerfil($perfiles_ids);


                    $modulos = count($usuario_menu);

                    $cadena_script = '';
                    $cadena_modulos = '';
                    $cadena_perfiles = '';

                    $perfil = 0;
                    $mayor = 0;
                    $c = 1;

                    for($i=0;$modulos>$i;$i++)
                    {
                        if($perfil!=$usuario_menu[$i]['perfil_id'])
                        {
                            $perfil = $usuario_menu[$i]['perfil_id'];

                            $cadena_script .= 'document.getElementById("perfil'.$usuario_menu[$i]['perfil_id'].'").style.visibility="hidden"; ';

                            $cadena_perfiles .= '<option value="perfil'.$usuario_menu[$i]['perfil_id'].'">'.$usuario_menu[$i]['pnombre'].'</option>';

                            if($i!=0)
                                $cadena_modulos .= '</table></div><div id="perfil'.$usuario_menu[$i]['perfil_id'].'" style="visibility:hidden; position:absolute; left:0px; top:0px;"><table class="vns">';
                            else
                                $cadena_modulos .= '<div id="perfil'.$usuario_menu[$i]['perfil_id'].'" style="visibility:visible; position:absolute; left:0px; top:0px;"><table>';

                            if($mayor<$c)
                                $mayor = $c;

                            $c = 0;
                        }

                        $c++;

                        $app = 'sf_app_'.$usuario_menu[$i]['aplicacion'].'_url';
                        $cadena_modulos .= '<tr>
                                                <td>
                                                    <div style="position: relative; width:185px;">
                                                    <a href="'.sfConfig::get($app).$usuario_menu[$i]['vinculo'].'">
                                                        <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/'.$usuario_menu[$i]['imagen'].'"></div>
                                                        <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">'.$usuario_menu[$i]['mnombre'].'</div>
                                                    </a>
                                                    </div><br/>
                                                </td>
                                            </tr>';
                    }

//                    if($funcionario_unidad[0]['cargo_grado_id']==99)
//                    {
//                        $cadena_modulos .='<tr><td width="10"><font class="vns">&#149;</font></td><td><a href="'.sfConfig::get('sf_app_rrhh_url').'odi" class="vns">ODI</a></td></tr>';
//                    }

                    if($mayor<$c)
                        $mayor = $c;

                    $mayor = ($mayor * 17) + 15;

                    $cadena_perfiles = '<select id ="perfiles_menu" name="perfiles_menu" onchange="javascript:mostrarcombo()">'
                                       .$cadena_perfiles.
                                       '</select>';

                    $cadena_script = '<script> function mostrarcombo(){'
                                     .$cadena_script.
                                     'cual = document.getElementById("perfiles_menu").value; document.getElementById(cual).style.visibility="visible"; } </script>';

                    $modulos_autorizados = Doctrine::getTable('Acceso_AutorizacionModulo')->findByFuncionarioId($this->getUser()->getAttribute('funcionario_id'));

                    $cadena_autorizados = '';

                    foreach ($modulos_autorizados as $modulo_autorizado) {
                        $this->getUser()->addCredential('autorizado_permiso_'.$modulo_autorizado->getModuloId().'_'.$modulo_autorizado->getPermiso());

                        $modulo = Doctrine::getTable('Acceso_Modulo')->find($modulo_autorizado->getModuloId());
                        $app = 'sf_app_'.$modulo->getAplicacion().'_url';
                        $cadena_autorizados .= '<tr>
                                                    <td width="24" align="center">
                                                        <div style="position: relative; width:185px;">
                                                        <a href="'.sfConfig::get($app).$modulo->getVinculo().'">
                                                            <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/'.$modulo->getImagen().'"></div>
                                                            <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">'.$modulo->getNombre().'</div>
                                                        </a>
                                                        </div><br/>
                                                    </td>
                                                </tr>';
                    }

                    $cadena_modulos = '<div id="menu_sigla" style="visibility:visible; position:relative; left:0px; top:0px; width:185px; height:'.$mayor.'px;">'
                                      .$cadena_modulos
                                      .$cadena_autorizados
                                      .'</table></div></div>';

                    $cadena_menu = $cadena_script.
                                   '<table align="center">';



                    if($usuario_session->getEnlaceId()==1)
                    {
                        
                        $sf_oficinasClave = sfYaml::load(sfConfig::get("sf_root_dir")."/config/siglas/oficinasClave.yml");

                        ////////////// CORRESPONDENCIA
                        ////////////// CORRESPONDENCIA
                        ////////////// CORRESPONDENCIA
                        if($correspondencia) :
                            //cuenta en cuantos grupos tengo permiso de administrar
                            $admin_count = Doctrine::getTable('Correspondencia_FuncionarioUnidad')->adminFuncionarioGrupoCount($this->getUser()->getAttribute('funcionario_id'));

                            $cadena_menu.= '<tr><td>'.
                                               '<table width="100%">'.
                                                   '<tr>'.
                                                       '<td>
                                                           <div class="barra_herramientas_title">
                                                                <div>
                                                                    <div style="position: relative; cursor: pointer;" class="abrir_config">
                                                                        <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/config_black.png"></div>
                                                                        <div class="barra_herramientas_title_text" style="position: absolute; left: 24px;">Correspondencia</div>
                                                                    </div>
                                                                </div>';

                                    if(in_array(99, $funcionarios_cargos))
                                    {
                                                $cadena_menu.= '<br/>
                                                                <div class="detalles" style="display: none;">
                                                                    <table>
                                                                        <tr>
                                                                            <td width="24" height="20" align="center"></td>
                                                                            <td width="200">
                                                                                <div style="position: relative;">
                                                                                <a href="' . sfConfig::get('sf_app_correspondencia_url') . 'grupos/gruposIni">
                                                                                    <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/grupos_arbol.png"></div>
                                                                                    <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Permisos del Grupo</div>
                                                                                </a>
                                                                                </div>
                                                                                <br/>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="24" height="20"></td>
                                                                            <td>
                                                                                <div style="position: relative;">
                                                                                <a href="'.sfConfig::get('sf_app_correspondencia_url').'correlativos/correlativosIni">
                                                                                    <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/loading_arbol.png"></div>
                                                                                    <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Correlativos</div>
                                                                                </a>
                                                                                </div>
                                                                                <br/>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="24" height="20"></td>
                                                                            <td>
                                                                                <div style="position: relative;">
                                                                                <a href="'.sfConfig::get('sf_app_correspondencia_url').'instruccion">
                                                                                    <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/asignar_arbol.png"></div>
                                                                                    <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Instrucciones</div>
                                                                                </a>
                                                                                </div>
                                                                                <br/>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="24" height="20"></td>
                                                                            <td>
                                                                                <div style="position: relative;">
                                                                                <a href="'.sfConfig::get('sf_app_acceso_url').'delegar/accion?a=fc">
                                                                                    <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/delegar_arbol.png"></div>
                                                                                    <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Delegar Firma</div>
                                                                                </a>
                                                                                </div>
                                                                                <br/>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>';
                                    } else {
                                        if($admin_count[0][0] > 0) {
                                            $cadena_menu.= '<br/>
                                                                <div class="detalles" style="display: none;">
                                                                    <table>
                                                                        <tr>
                                                                            <td width="24" height="20" align="center"></td>
                                                                            <td width="200">
                                                                                <div style="position: relative;">
                                                                                <a href="' . sfConfig::get('sf_app_correspondencia_url') . 'grupos/gruposIni">
                                                                                    <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/grupos_arbol.png"></div>
                                                                                    <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Permisos del Grupo</div>
                                                                                </a>
                                                                                </div>
                                                                                <br/>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="24" height="20"></td>
                                                                            <td>
                                                                                <div style="position: relative;">
                                                                                <a href="'.sfConfig::get('sf_app_correspondencia_url').'correlativos/correlativosIni">
                                                                                    <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/loading_arbol.png"></div>
                                                                                    <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Correlativos</div>
                                                                                </a>
                                                                                </div>
                                                                                <br/>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>';
                                        } else {  $cadena_menu.= '<br/>'; } }

                                            $cadena_menu.= '</div>
                                                        </td>
                                                    </tr>';





                                    $cadena_menu.= '<tr>'.
                                                       '<td>
                                                            <div style="position: relative;">
                                                            <a href="'.sfConfig::get('sf_app_correspondencia_url').'enviada">
                                                                <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/send.png"></div>
                                                                <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Enviadas</div>
                                                            </a>
                                                            </div>
                                                           <div style="position: relative;">'.
                                                            '<div style="position: absolute; right: 0px;"><a href="'.sfConfig::get('sf_app_correspondencia_url').'enviada/nueva" title="Nuevo Envío"><img src="/images/icon/new.png"></a></div>'.
                                                        '</div><br/></td>'.
                                                   '</tr>'.
                                                   '<tr>'.
                                                       '<td>
                                                            <div style="position: relative;">
                                                            <a href="'.sfConfig::get('sf_app_correspondencia_url').'recibida">
                                                                <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/reply.png"></div>
                                                                <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Recibidas###sin_leer###</div>
                                                            </a>
                                                            </div><br/>
                                                        </td>'.
                                                   '</tr>';

                            $funcionario_grupo = Doctrine::getTable('Correspondencia_FuncionarioUnidad')->findOnebyFuncionarioIdAndStatus($this->getUser()->getAttribute('funcionario_id'),'A');

                            if($funcionario_grupo)
                            {
                                 $cadena_menu .= '<tr>'.
                                                         '<td>
                                                            <div style="position: relative;">
                                                            <a href="'.sfConfig::get('sf_app_correspondencia_url').'externa">
                                                                <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/externo.png"></div>
                                                                <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Externas</div>
                                                            </a>
                                                            </div>';


                                        $funcionario_grupo = Doctrine::getTable('Correspondencia_FuncionarioUnidad')->findOnebyFuncionarioIdAndRecibirAndStatus($this->getUser()->getAttribute('funcionario_id'),'t','A');

                                        if($funcionario_grupo)
                                            if($funcionario_grupo->getRecibir()=='t')
                                                $cadena_menu .= '<div style="position: relative;"><div style="position: absolute; right: 0px;"><a href="'.sfConfig::get('sf_app_correspondencia_url').'externa/new" title="Nueva Recepción"><img src="/images/icon/new.png"></a></div></div>';

                                        $cadena_menu .= '</td>'.
                                                      '</tr>';
                            }

                            $cadena_menu.='</td></tr></table></td></tr>';

                            $cadena_menu .= '<tr><td><br/>'.
                                                '<HR width=100% align="center">'.
                                           '</td></tr>';
                        endif;

                        ////////////// CORRESPONDENCIA
                        ////////////// CORRESPONDENCIA
                        ////////////// CORRESPONDENCIA

                        
                        
                        ////////////// ARCHIVO
                        ////////////// ARCHIVO
                        ////////////// ARCHIVO
                        if($archivo) :
                            //cuenta en cuantos grupos tengo permiso de administrar
                            $admin_count = Doctrine::getTable('Archivo_FuncionarioUnidad')->adminFuncionarioGrupoCount($this->getUser()->getAttribute('funcionario_id'));
                            $cadena_menu.= '<tr><td>'.
                                               '<table width="100%">'.
                                                   '<tr>'.
                                                       '<td>
                                                           <div class="barra_herramientas_title">
                                                                <div>
                                                                <div style="position: relative; cursor: pointer;" class="abrir_config">
                                                                    <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/config_black.png"></div>
                                                                    <div class="barra_herramientas_title_text" style="position: absolute; left: 24px;">Archivo</div>
                                                                </div>
                                                                </div>';

                                    if(in_array(99, $funcionarios_cargos) || $admin_count[0][0] > 0)
                                    {
                                                $cadena_menu.= '<br/>
                                                                <div class="detalles" style="display: none;">
                                                                    <table>
                                                                        <tr>
                                                                            <td width="24" height="20" align="center"></td>
                                                                            <td width="200">
                                                                                <div style="position: relative;">
                                                                                <a href="' . sfConfig::get('sf_app_archivo_url') . 'expediente/configuracion">
                                                                                    <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/config_arbol.png"></div>
                                                                                    <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Configuraci&oacute;n General</div>
                                                                                </a>
                                                                                </div>
                                                                                <br/>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="24" height="20" align="center"></td>
                                                                            <td width="200">
                                                                                <div style="position: relative;">
                                                                                <a href="' . sfConfig::get('sf_app_archivo_url') . 'grupos/gruposIni">
                                                                                    <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/grupos_arbol.png"></div>
                                                                                    <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Permisos del Grupo</div>
                                                                                </a>
                                                                                </div>
                                                                                <br/>
                                                                            </td>
                                                                        </tr>
                                                                            <tr>
                                                                                <td width="24" height="20"></td>
                                                                                <td>
                                                                                    <div style="position: relative;">
                                                                                    <a href="'.sfConfig::get('sf_app_archivo_url').'serie_documental">
                                                                                        <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/series_doc_arbol.png"></div>
                                                                                        <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Series Documentales</div>
                                                                                    </a>
                                                                                    </div>
                                                                                    <br/>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="24" height="20"></td>
                                                                                <td>
                                                                                    <div style="position: relative;">
                                                                                    <a href="'.sfConfig::get('sf_app_archivo_url').'estante">
                                                                                        <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/file-manager_arbol.png"></div>
                                                                                        <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Estanteria</div>
                                                                                    </a>
                                                                                    </div>
                                                                                    <br/>
                                                                                </td>
                                                                            </tr>
                                                                    </table>
                                                                </div>';
                                    } else { $cadena_menu.= '<br/>'; }

                                            $cadena_menu.= '</div>
                                                        </td>
                                                    </tr>';




                            $cadena_menu .= '<tr>
                                                <td>
                                                    <div style="position: relative;">
                                                            <a href="'.sfConfig::get('sf_app_archivo_url').'expediente">
                                                                <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/adjuntar_carpeta.png"></div>
                                                                <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Expedientes</div>
                                                            </a>
                                                            </div>
                                                           <div style="position: relative;">
                                                            <div style="position: absolute; right: 0px;"><a href="'.sfConfig::get('sf_app_archivo_url').'prestamos_solicitados" title="Prestamos que Solicito"><img src="/images/icon/prestamo_receive_doc.png"></a></div>
                                                        </div><br/>
                                                </td>
                                            </tr>';

                            $cadena_menu.='</td></tr></table></td></tr>';

                            $cadena_menu .= '<tr><td>'.
                                                '<HR width=100% align="center">'.
                                           '</td></tr>';
                        endif;

                        ////////////// ARCHIVO
                        ////////////// ARCHIVO
                        ////////////// ARCHIVO


                        
                        ////////////// RRHH
                        ////////////// RRHH
                        ////////////// RRHH
                        if($rrhh) :
                            $cadena_menu.= '<tr><td>'.
                                           '<table width="100%">'.
                                               '<tr>'.
                                                   '<td>
                                                       <div class="barra_herramientas_title">
                                                            <div>
                                                            <div style="position: relative; cursor: pointer;" class="abrir_config">
                                                                <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/config_black.png"></div>
                                                                <div class="barra_herramientas_title_text" style="position: absolute; left: 24px;">Recursos Humanos</div>
                                                            </div>
                                                            </div>';
                                if(in_array(99, $funcionarios_cargos) && in_array($sf_oficinasClave['recursos_humanos']['seleccion'], $funcionarios_unidades))
                                {
                                            $cadena_menu.= '<br/>
                                                            <div class="detalles" style="display: none;">
                                                                <table>
                                                                    <tr>
                                                                        <td width="24" height="20" align="center"></td>
                                                                        <td width="200">
                                                                            <div style="position: relative;">
                                                                            <a href="' . sfConfig::get('sf_app_rrhh_url') . 'configuracion">
                                                                                <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/tool_arbol.png"></div>
                                                                                <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Configuraciones</div>
                                                                            </a>
                                                                            </div>
                                                                            <br/>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="24" height="20" align="center"></td>
                                                                        <td width="200">
                                                                            <div style="position: relative;">
                                                                            <a href="'.sfConfig::get('sf_app_acceso_url').'delegar/accion?a=arrhh">
                                                                                <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/tool_arbol.png"></div>
                                                                                <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Delegar Administracion</div>
                                                                            </a>
                                                                            </div>
                                                                            <br/>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>';
                                } elseif (in_array(99, $funcionarios_cargos) && !in_array($sf_oficinasClave['recursos_humanos']['seleccion'], $funcionarios_unidades)) {
                                                $cadena_menu.= '<br/>
                                                            <div class="detalles" style="display: none;">
                                                                <table>
                                                                    <tr>
                                                                        <td width="24" height="20" align="center"></td>
                                                                        <td width="200">
                                                                            <div style="position: relative;">
                                                                            <a href="'.sfConfig::get('sf_app_acceso_url').'delegar/accion?a=arrhh">
                                                                                <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/tool_arbol.png"></div>
                                                                                <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Delegar Administracion</div>
                                                                            </a>
                                                                            </div>
                                                                            <br/>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>';
                                } else { $cadena_menu.= '<br/>'; }

                                        $cadena_menu.= '</div>
                                                    </td>
                                                </tr>';




                            $cadena_menu .= '<tr>
                                                <td>
                                                    <div style="position: relative;">
                                                            <a href="'.sfConfig::get('sf_app_rrhh_url').'vacaciones">
                                                                <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/beach.png"></div>
                                                                <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Vacaciones</div>
                                                            </a>
                                                            </div>
                                                           <br/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div style="position: relative;">
                                                            <a href="'.sfConfig::get('sf_app_rrhh_url').'reposos">
                                                                <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/reposo_uno.png"></div>
                                                                <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Reposos Medicos</div>
                                                            </a>
                                                            </div>
                                                           <br/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div style="position: relative;">
                                                            <a href="'.sfConfig::get('sf_app_rrhh_url').'permisos">
                                                                <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/permiso.png"></div>
                                                                <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Permisos</div>
                                                            </a>
                                                            </div>
                                                           <br/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div style="position: relative;">
                                                        <a href="'.sfConfig::get('sf_app_rrhh_url').'documentos">
                                                            <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/titulo.png"></div>
                                                            <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Documentos</div>
                                                        </a>
                                                    </div>
                                                    <br/>
                                                </td>
                                            </tr>';

                            $cadena_menu.='</td></tr></table></td></tr>';

                            $cadena_menu .= '<tr><td>'.
                                                '<HR width=100% align="center">'.
                                           '</td></tr>';
                        endif;

                        ////////////// RRHH
                        ////////////// RRHH
                        ////////////// RRHH


                        
                        ////////////// INVENTARIO
                        ////////////// INVENTARIO
                        ////////////// INVENTARIO
                        if($inventario) :
                            if(in_array(99, $funcionarios_cargos))
                            {

                            $cadena_menu.= '<tr><td>'.
                                               '<table width="100%">'.
                                                   '<tr>'.
                                                       '<td>
                                                           <div class="barra_herramientas_title">
                                                                <div>
                                                                <div style="position: relative; cursor: pointer;" class="abrir_config">
                                                                    <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/config_black.png"></div>
                                                                    <div class="barra_herramientas_title_text" style="position: absolute; left: 24px;">Proveeduria</div>
                                                                </div>
                                                                </div>';

                                    if($funcionario_unidades[0]['unidad_id']==$sf_oficinasClave['administracion']['seleccion'])
                                    {
                                                $cadena_menu.= '<br/>
                                                                <div class="detalles" style="display: none;">
                                                                    <table>
                                                                        <tr>
                                                                            <td width="24" height="20" align="center"></td>
                                                                            <td width="200">
                                                                                <div style="position: relative;">
                                                                                <a href="' . sfConfig::get('sf_app_inventario_url') . 'articulo">
                                                                                    <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/inventario_arbol.png"></div>
                                                                                    <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Inventario</div>
                                                                                </a>
                                                                                </div>
                                                                                <br/>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="24" height="20" align="center"></td>
                                                                            <td width="200">
                                                                                <div style="position: relative;">
                                                                                <a href="' . sfConfig::get('sf_app_proveedores_url') . 'proveedor">
                                                                                    <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/delivery_arbol.png"></div>
                                                                                    <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Proveedores</div>
                                                                                </a>
                                                                                </div>
                                                                                <br/>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>';
                                    } else { $cadena_menu.= '<br/>'; }

                                            $cadena_menu.= '</div>
                                                        </td>
                                                    </tr>';




                            $cadena_menu .= '<tr>
                                                <td>
                                                    <div style="position: relative;">
                                                            <a href="'.sfConfig::get('sf_app_inventario_url').'articulo_egreso">
                                                                <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/entrega.png"></div>
                                                                <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Asignaciones</div>
                                                            </a>
                                                            </div>
                                                           <br/>
                                                </td>
                                            </tr>';

                            $cadena_menu.='</td></tr></table></td></tr>';

                            $cadena_menu .= '<tr><td>'.
                                                '<HR width=100% align="center">'.
                                           '</td></tr>';

                            }
                        endif;
                        
                        ////////////// INVENTARIO
                        ////////////// INVENTARIO
                        ////////////// INVENTARIO



                        ////////////// VEHICULO
                        ////////////// VEHICULO
                        ////////////// VEHICULO
                        if($vehiculo) :
                            if(in_array(99, $funcionarios_cargos))
                            {

                            $cadena_menu.= '<tr><td>'.
                                               '<table width="100%">'.
                                                   '<tr>'.
                                                       '<td>
                                                           <div class="barra_herramientas_title">
                                                                <div>
                                                                <div style="position: relative; cursor: pointer;" class="abrir_config">
                                                                    <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/config_black.png"></div>
                                                                    <div class="barra_herramientas_title_text" style="position: absolute; left: 24px;">Transporte</div>
                                                                </div>
                                                                </div>';

                                    if($funcionario_unidades[0]['unidad_id']==$sf_oficinasClave['administracion']['seleccion'])
                                    {
                                                $cadena_menu.= '<br/>
                                                                <div class="detalles" style="display: none;">
                                                                    <table>
                                                                        <tr>
                                                                            <td width="24" height="20" align="center"></td>
                                                                            <td width="200">
                                                                                <div style="position: relative;">
                                                                                <a href="' . sfConfig::get('sf_app_acceso_url') . 'configuracion?opcion=gps&prv=true">
                                                                                    <div style="position: absolute; left: -10px; width: 24px; text-align: center;"><img src="/images/icon/inventario_arbol.png"></div>
                                                                                    <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Configuraciones</div>
                                                                                </a>
                                                                                </div>
                                                                                <br/>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>';
                                    } else { $cadena_menu.= '<br/>'; }

                                            $cadena_menu.= '</div>
                                                        </td>
                                                    </tr>';




                            $cadena_menu .= '<tr>
                                                <td>
                                                    <div style="position: relative;">
                                                            <a href="'.sfConfig::get('sf_app_vehiculos_url').'vehiculo">
                                                                <div style="position: absolute; width: 24px; text-align: center;"><img style="vertial-align: middle" src="/images/icon/tracker/car.png"></div>
                                                                <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Vehículo</div>
                                                            </a>
                                                            </div>
                                                           <br/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div style="position: relative;">
                                                            <a href="'.sfConfig::get('sf_app_vehiculos_url').'conductor">
                                                                <div style="position: absolute; width: 24px; text-align: center;"><img style="vertial-align: middle" src="/images/icon/tracker/conductor.png"></div>
                                                                <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">Conductores</div>
                                                            </a>
                                                            </div>
                                                           <br/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div style="position: relative;">
                                                            <a href="'.sfConfig::get('sf_app_vehiculos_url').'tracker">
                                                                <div style="position: absolute; width: 24px; text-align: center;"><img src="/images/icon/tracker/gps.png"></div>
                                                                <div style="position: absolute; left: 24px;" class="barra_herramientas_fond_text">GPS</div>
                                                            </a>
                                                            </div>
                                                           <br/>
                                                </td>
                                            </tr>';

                            $cadena_menu.='</td></tr></table></td></tr>';

                            $cadena_menu .= '<tr><td>'.
                                                '<HR width=100% align="center">'.
                                           '</td></tr>';

                            }
                        endif;
                        
                        ////////////// VEHICULO
                        ////////////// VEHICULO
                        ////////////// VEHICULO
                    }
                                       $cadena_menu.='<tr><td>&nbsp;&nbsp;&nbsp;'.
                                            $cadena_perfiles.
                                       '</td></tr>'.
                                       '<tr><td><br/>'.
                                            $cadena_modulos.
                                       '</td></tr>'.
                                   '</table>';

                    $cadena_menu = str_replace("  ", "", $cadena_menu);
                    $cadena_menu = str_replace("  ", "", $cadena_menu);
                    $cadena_menu = str_replace("  ", "", $cadena_menu);
                    $cadena_menu = str_replace("  ", "", $cadena_menu);
                    
                    $this->getUser()->setAttribute('zmenu', $cadena_menu);

                    // #####################################################
                    // ############ FIN GENERAR MENU DINAMICO ##############
                    // #####################################################


                    // INICIO BORRADO DE CACHE

                    $ultimo_corte = new herramientas();
                    $ultimo_corte->corteCache();

                    // FIN BORRADO DE CACHE
                }
                else
                {
                    // ########### ERROR NO TIENE PERFILES ############
                    $this->getUser()->setFlash('error', 'El usuario que ha ingresado tiene problemas de perfil de acceso, por favor comuniquese a la Dirección de Informática y reporte el error con el número P-'.$usuario_session->getId().'.');
                    $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario');
                }

                $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario/session');
            }
        }
        else
        {
            // REVISAR SI TIENE CLAVE TEMPORAL
            $usuario_session = Doctrine::getTable('Acceso_Usuario')->findOneByNombreAndClaveTemporal($usuario,$contrasena);

            if($usuario_session)
            {
                //UN CORREO SOLO SE VALIDA AL INGRESAR CON CLAVE TEMPORAL Y HAYA EMAIL EN DB (SIGNIFICA QUE HIZO LOS TRES PASO DE PRIMER INGRESO)
                $funcionario_usr= Doctrine::getTable('Funcionarios_Funcionario')->findOneById($usuario_session->getId());
                if($funcionario_usr->getEmailPersonal() != '') {
                    $funcionario_usr->setEmailValidado(true);
                    $funcionario_usr->save();
                }
                $this->getUser()->setAttribute('usuario_id', $usuario_session->getId());
                // ########### REINICIO DE CLAVE ############
                $this->getUser()->setFlash('notice', 'La contraseña se ha reiniciado automaticamente. Para comenzar el uso del sistema es necesario crear una contraseña nueva.');
                $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario/cambioClave?user='.$usuario_session->getNombre());
            } else {
                // ########### LOGEO MALO ############
                $this->getUser()->setFlash('error', 'La información de nombre de usuario o contraseña introducida no es correcta.');
                $this->redirect(sfConfig::get('sf_app_acceso_url').'usuario');
            }
        }

  }

  public function executeFuncionarioUnidad(sfWebRequest $request)
  {
        $this->funcionario_selected = 0;
        $this->funcionarios = Doctrine::getTable('Funcionarios_FuncionarioCargo')->funcionarioDeUnidades(array($request->getParameter('u_id')));
  }
}
