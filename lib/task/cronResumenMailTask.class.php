<?php

class cronResumenMailTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'diario';
    $this->name             = 'resumenMail';
    $this->briefDescription = 'Genera notificaciones por email de correspondencia recibidas el dia anterior';
    $this->detailedDescription = <<<EOF
The [cronResumenMail|INFO] task does things.
Call it with:

  [php symfony cronResumenMail|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    require_once(sfConfig::get("sf_root_dir") . '/config/ProjectConfiguration.class.php');
    $configuration = ProjectConfiguration::getApplicationConfiguration('correspondencia', 'dev', true);
    sfContext::createInstance($configuration);

    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $docs = Doctrine_Query::create()
        ->select('c.n_correspondencia_emisor as n_correspondencia_emisor,
            c.emisor_unidad_id as emisor_unidad_id,
            f.campo_uno as asunto, tf.nombre as formato, r.*')
        ->from('Correspondencia_Receptor r')
        ->innerJoin('r.Correspondencia_Correspondencia c')
        ->innerJoin('c.Correspondencia_Formato f')
        ->innerJoin('f.Correspondencia_TipoFormato tf')
        ->where('r.establecido = ?', 'S')
        ->andWhere("c.status = ?", 'E')
        ->orderBy('r.funcionario_id desc')
        ->execute();
    
    $resumen_doc= Array();
    $i= 0; $j= 0;
    foreach($docs as $documentos) {
        if($i > 0) {
            if($documentos->getFuncionarioId()!= $docs[$i-1]['funcionario_id'])
                $j= 0;
        }
        
        $resumen_doc[$documentos->getFuncionarioId()][$j]['receptor']= $documentos->getFuncionarioId();
        $resumen_doc[$documentos->getFuncionarioId()][$j]['formato']= $documentos->getFormato();
        $resumen_doc[$documentos->getFuncionarioId()][$j]['prepara']= $documentos->getIdUpdate();
        $resumen_doc[$documentos->getFuncionarioId()][$j]['unidad']= $documentos->getEmisorUnidadId();
        $resumen_doc[$documentos->getFuncionarioId()][$j]['asunto']= $documentos->getAsunto();
        $resumen_doc[$documentos->getFuncionarioId()][$j]['fecha']= $documentos->getCreatedAt();
        
        $j++; $i++;
    }

    $i=0;
    foreach($resumen_doc as $key => $values) {
        $usuarios = Doctrine_Query::create()
            ->select('f.primer_nombre as nombre, f.primer_apellido as apellido, f.email_personal as email_personal, f.email_institucional as email_institucional')
            ->from('Funcionarios_Funcionario f')
            ->where('f.id = ?', $key)
            ->execute();
        
        foreach($usuarios as $val) {
            $email_institucional= Array();
            $email_personal= Array();
            $email_internos= Array();

            if ($val->getEmailInstitucional())
                $email_institucional[] = $val->getEmailInstitucional();
            if ($val->getEmailPersonal())
                $email_personal[] = $val->getEmailPersonal();
            $email_institucional = array_unique($email_institucional);
            $email_personal = array_unique($email_personal);
            $email_internos = array_merge($email_institucional, $email_personal);

            $i= 0;
            foreach($email_internos as $mail) {
                $email_internos[$i]= $val->getNombre().' '.$val->getApellido().'%%%'.$mail;
                $i=0;
            }
            
            if(count($email_internos) > 0) {
//                print_r($resumen_doc[$key]);
//                print_r($email_internos);
//                echo '#################';
                $this->notifyEmail($email_internos, $resumen_doc[$key]);
            }
            //incluir otras notificaciones
        }
        $i++;
    }
    

//    
//    print_r($resumen_doc);
    
    
    exit;
    
  }

  public function notifyDesk()
  {
      //Notificiones con formato para envio de sms de texto
  }

  public function notifySms()
  {
      //Notificiones con formato para envio de sms de texto
  }

  public function notifyEmail($email_internos, $resumen_docs)
  {
      //Parametros:
      //1- array con email internos (incluye los personales e institucionales) de un solo funcionario 99
      //2- array con todos los parametros para la creacion del resumen

        $months = array("", "enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
        $date = date('d', strtotime($f_envio)).' de '. $months[(int)date('m', strtotime($f_envio))] .' de '. date('Y', strtotime($f_envio)) .', a las '.date('h:i A', strtotime($f_envio));

        $mensaje['mensaje'] = sfConfig::get('sf_organismo') . "<br/>";
        $mensaje['mensaje'] .= "Sistema Integral para la Gestión Laboral, Administrativa y de Servicios (SIGLAS)<br/><br/><br/>";

        
        
        
        for ($i = 0; $i < count($email_internos); $i++) {
            list($nombre, $email) = explode('%%%', $email_internos[$i]);

            $mensaje['mensaje'] .= "Sr(a).-<br/>";
            $mensaje['mensaje'] .= $nombre . "<br/><br/><br/>";

            $mensaje['mensaje'].="Reciba un cordial saludo Bolivariano y Revolucionario, nos dirigimos a usted en la " .
                    "oportunidad de informarle del siguiente resumen de correspondencias recibidas el d&iacute; de ayer, no leidas a&uacute;n.<br/><br/>";

            $mensaje['mensaje'] .= "<br/><br/>Con la intención de que sean atendidos los planteamientos de dicho " . $formato .
                    " y que se informen los resultados obtenidos, " .
                    "le invitamos a hacer uso del SIGLAS-" . sfConfig::get('sf_siglas') . ".<br/><br/>" .
                    "Reiterándole el compromiso de trabajo colectivo para la construcción de la patria socialista, " .
                    "se despide. <br/><br/>" . sfConfig::get('sf_organismo');

            $mensaje['emisor'] = 'Correspondencia';
            $mensaje['receptor'] = $nombre;

            Email::notificacion('correspondencia', $email, $mensaje, 'inmediata');
        }
  }
}
