<?php
/*
  Para llamar a esta tarea se añade al cron las siguientes lineas
  * * * * * cd /var/www/siglas-kernel/ && symfony calendario:procesar --frecuencia=manana
  * * * * * cd /var/www/siglas-kernel/ && symfony calendario:procesar --frecuencia=hoy
  * * * * * cd /var/www/siglas-kernel/ && symfony calendario:procesar --frecuencia=hora
 */
class cronCalendarioTask extends sfBaseTask
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

    $this->namespace        = 'calendario';
    $this->name             = 'procesar';
    $this->briefDescription = '';
            
    $this->addOption('frecuencia', '', sfCommandOption::PARAMETER_REQUIRED, 'frecuencia de envio de notificaciones (hoy, manana, hora)');
  }

  protected function execute($arguments = array(), $options = array())
  {
    require_once(sfConfig::get("sf_root_dir") . '/config/ProjectConfiguration.class.php');
    $configuration = ProjectConfiguration::getApplicationConfiguration('herramientas', 'dev', true);
    sfContext::createInstance($configuration);
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
    if($options['frecuencia']== 'hoy')
    {
        $eventos = Doctrine_Query::create()
                    ->select('e.id')
                    ->from('Public_Eventos e')
                    ->where("date_part('year',e.f_inicio) = ?", date('Y'))
                    ->andWhere("date_part('month',e.f_inicio) = ?", date('m'))
                    ->andWhere("date_part('day',e.f_inicio) = ?", date('d'))
                    ->execute();
    }
    elseif($options['frecuencia']== 'manana')
    {
        $eventos = Doctrine_Query::create()
                    ->select('e.id')
                    ->from('Public_Eventos e')
                    ->where("date_part('year',e.f_inicio) = ?", date('Y'))
                    ->andWhere("date_part('month',e.f_inicio) = ?", date('m'))
                    ->andWhere("date_part('day',e.f_inicio) = ?", date('d',strtotime('+1 day')))
                    ->execute();
    }
    elseif($options['frecuencia']== 'hora')
    {
        $date = date("H");
        $date = strtotime ('+1 hours', strtotime($date) ) ;
        $date = date ('d' , $date);
        $date = date("Y-m-d H");
        $eventos = Doctrine_Query::create()
                    ->select('e.id')
                    ->from('Public_Eventos e')
                    ->where("date_part('year',e.f_inicio) = ?", date('Y'))
                    ->andWhere("date_part('month',e.f_inicio) = ?", date('m'))
                    ->andWhere("date_part('day',e.f_inicio) = ?", date('d'))
                    ->andWhere("date_part('hour',e.f_inicio) = ?", date('H', strtotime("+1 hour")))
                    ->execute();
    }
    
    foreach($eventos as $evento) {
        
      $datos_evento_afectado= Doctrine::getTable('Public_Eventos')->findOneById($evento->getId());
      $datos_evento_invitado = Doctrine_Query::create()
                                ->select('e.funcionario_invitado_id,ei.id,ei.cargo_invitado_id, ei.unidad_invitado_id')
                                ->from('Public_EventosInvitados ei')
                                ->where("ei.evento_id =?", $evento->getId())
                                ->andWhere("ei.aprobado = 1")
                                ->execute();
      
      $datosFuncionarios = Doctrine_Query::create()
                            ->select('fc.id,
                                    f.ci as ci,
                                    f.primer_nombre as primer_nombre,
                                    f.primer_apellido as primer_apellido,
                                    f.email_personal as email_personal,
                                    f.email_institucional as email_institucional,
                                    f.id as funcionario_id,
                                    fc.cargo_id as cargo_id,
                                    c.unidad_funcional_id as unidad_id, u.nombre as unombre')
                            ->from('Funcionarios_FuncionarioCargo fc')
                            ->innerjoin('fc.Funcionarios_Funcionario f')
                            ->leftjoin('fc.Organigrama_Cargo c')
                            ->innerjoin('c.Organigrama_UnidadFuncional u')
                            ->where('fc.status = ?', 'A')
                            ->andWhere("c.id = ?",$datos_evento_afectado->getCargoId())
                            ->andWhere("u.id = ?",$datos_evento_afectado->getUnidadId())
                            ->andWhere('f.id = ?', $datos_evento_afectado->getFuncionarioId())
                            ->execute();
      $creadorEvento = $datosFuncionarios[0]->getPrimerNombre()." ".$datosFuncionarios[0]->getPrimerApellido();
      
//      $this->notifyDesk($datos_evento_afectado,$datosFuncionarios,$options['frecuencia'],$creadorEvento);
//        $this->notifySms($datos_evento_afectado,$datosFuncionarios,$options['frecuencia'],$creadorEvento);
        $this->notifyEmail($datos_evento_afectado,$datosFuncionarios,$options['frecuencia'],$creadorEvento);
        
      foreach($datos_evento_invitado as $dato_evento_invitado){
          
          $datosFuncionarios = Doctrine_Query::create()
                            ->select('fc.id,
                                    f.ci as ci,
                                    f.primer_nombre as primer_nombre,
                                    f.primer_apellido as primer_apellido,
                                    f.email_personal as email_personal,
                                    f.email_institucional as email_institucional,
                                    f.id as funcionario_id,
                                    fc.cargo_id as cargo_id,
                                    c.unidad_funcional_id as unidad_id, u.nombre as unombre')
                            ->from('Funcionarios_FuncionarioCargo fc')
                            ->innerjoin('fc.Funcionarios_Funcionario f')
                            ->leftjoin('fc.Organigrama_Cargo c')
                            ->innerjoin('c.Organigrama_UnidadFuncional u')
                            ->where('fc.status = ?', 'A')
                            ->andWhere("c.id = ?",$dato_evento_invitado->getCargoInvitadoId())
                            ->andWhere("u.id = ?",$dato_evento_invitado->getUnidadInvitadoId())
                            ->andWhere('f.id = ?', $dato_evento_invitado->getFuncionarioInvitadoId())
                            ->execute();
//      $this->notifyDesk($datos_evento_afectado,$datosFuncionarios,$options['frecuencia'],$creadorEvento);
//      $this->notifySms($datos_evento_afectado,$datosFuncionarios,$options['frecuencia'],$creadorEvento);
        $this->notifyEmail($datos_evento_afectado,$datosFuncionarios,$options['frecuencia'],$creadorEvento);
      }
    }
  }
  
  public function notifyDesk($datos_evento_afectado,$datosFuncionarios,$frecuencia,$creadorEvento)
  {
    $datos_evento_afectado = Doctrine::getTable('Public_Eventos')->findOneById($evento_afectado);
    $datos_evento_invitado = Doctrine_Query::create()
                                ->select('e.funcionario_invitado_id')
                                ->from('Public_EventosInvitados ei')
                                ->where("ei.evento_id =?", $evento_afectado)
                                ->andWhere("ei.aprobado = 1")
                                ->execute();

    $html= '
        <table width="100%">
            <tr>
                <td colspan="2" class="f11n">Mañana empieza el evento: <b>' . $datos_evento_afectado->getTitulo() . '</b></td>
            </tr>
            <tr>
                <td>Inicia: '.date("d/m/Y H:m A", strtotime($datos_evento_afectado->getFInicio())).'</td>
                <td>Finaliza: '.date("d/m/Y H:m A", strtotime($datos_evento_afectado->getFFinal())).'</td>
            </tr>
    </table>';

    $comunicaciones_notificacion = new Comunicaciones_Notificacion();
    $comunicaciones_notificacion->setFuncionarioId($evento_afectado->getFuncionarioId());
    $comunicaciones_notificacion->setAplicacionId(9); //Calendario
    $comunicaciones_notificacion->setFormaEntrega('desk');
    $comunicaciones_notificacion->setMetodoId(12); //calendario
    $comunicaciones_notificacion->setFEntrega(date('Y-m-d H:i:s'));
    $comunicaciones_notificacion->setMensaje($html);
    $comunicaciones_notificacion->setStatus('A');
    $comunicaciones_notificacion->setIdUpdate("000");
    $comunicaciones_notificacion->save();
    
    foreach($datos_evento_invitado as $eventoInvitado)
    {
        $comunicaciones_notificacion = new Comunicaciones_Notificacion();
        $comunicaciones_notificacion->setFuncionarioId($eventoInvitado->getFuncionarioInvitadoId());
        $comunicaciones_notificacion->setAplicacionId(9); //Calendario
        $comunicaciones_notificacion->setFormaEntrega('desk');
        $comunicaciones_notificacion->setMetodoId(12); //calendario
        $comunicaciones_notificacion->setFEntrega(date('Y-m-d H:i:s'));
        $comunicaciones_notificacion->setMensaje($html);
        $comunicaciones_notificacion->setStatus('A');
        $comunicaciones_notificacion->setIdUpdate("000");
        $comunicaciones_notificacion->save();
    }
  }
  
  public function notifySms($datos_evento_afectado,$datosFuncionarios,$frecuencia,$creadorEvento)
  {
      $datos_funcio_afectado= Doctrine::getTable('Funcionarios_Funcionario')->findOneById($funcionario_afectado);
      $datos_evento_afectado= Doctrine::getTable('Public_Eventos')->findOneById($evento_afectado);
  }
  
  public function notifyEmail($datos_evento_afectado,$datosFuncionarios,$frecuencia,$creadorEvento)
  {   
      
      if($frecuencia == 'hoy') { 
          if($datos_evento_afectado->getDia() == "TRUE")
              $mensaje_frecuencia = "el dia de hoy"; 
          else
            $mensaje_frecuencia = "el dia de hoy desde las ".date('h:i:s A',strtotime($datos_evento_afectado->getFInicio()))." hasta las ".date('h:i:s A',strtotime($datos_evento_afectado->getFFinal()));
      }
      elseif($frecuencia == 'manana') { 
          if($datos_evento_afectado->getDia() == "TRUE")
              $mensaje_frecuencia = "el dia de mañana"; 
          else
            $mensaje_frecuencia = "el dia de mañana desde las ".date('h:i:s A',strtotime($datos_evento_afectado->getFInicio()))." hasta las ".date('h:i:s A',strtotime($datos_evento_afectado->getFFinal()));
      }
      elseif($frecuencia == 'hora') { 
            $mensaje_frecuencia = "dentro de una hora (Desde: ".date('h:i:s A',strtotime($datos_evento_afectado->getFInicio()))." Hasta: ".date('h:i:s A',strtotime($datos_evento_afectado->getFFinal())).")";
      }
      
      
        if($datosFuncionarios[0]->getEmailPersonal() || $datosFuncionarios[0]->getEmailInstitucional()){
            $mensaje['mensaje'] = sfConfig::get('sf_organismo') . "<br/>";
            $mensaje['mensaje'] .= "Sistema Integral para la Gestión Laboral, Administrativa y de Servicios (SIGLAS)<br/><br/><br/>";
            $mensaje['mensaje'] .= "Srs.-<br/>";
            $mensaje['mensaje'] .= $datosFuncionarios[0]->getUnombre() . "<br/>";
            $mensaje['mensaje'] .= $datosFuncionarios[0]->getPrimerNombre()." ".$datosFuncionarios[0]->getPrimerApellido() . "<br/><br/><br/>";

            $mensaje['mensaje'].="Reciba un cordial saludo Bolivariano y Revolucionario, nos dirigimos a usted en la " .
                    "oportunidad de informarle que ".$mensaje_frecuencia." comienza el evento:  <b>".$datos_evento_afectado->getTitulo().".</b>
                     <br/><br/>
                     Evento creado por: ".$creadorEvento."<br/>Fecha: ".date('d-m-Y h:i:s a',  strtotime($datosFuncionarios[0]->getCreatedAt()));

            $mensaje['mensaje'] .= "<br/><br/><br/>Le invitamos a hacer uso del SIGLAS-" . sfConfig::get('sf_siglas') . ".<br/><br/>" .
                    "Reiterándole el compromiso de trabajo colectivo para la construcción de la patria socialista, " .
                    "se despide. <br/><br/>" . sfConfig::get('sf_organismo');

            $mensaje['emisor'] = 'Calendario';
            $mensaje['receptor'] = $datosFuncionarios[0]->getPrimerNombre()." ".$datosFuncionarios[0]->getPrimerApellido();
            
            if($datosFuncionarios[0]->getEmailPersonal())
                Email::notificacion('calendario', $datosFuncionarios[0]->getEmailPersonal(), $mensaje, 'inmediata');
            
            if($datosFuncionarios[0]->getEmailInstitucional())
                Email::notificacion('calendario', $datosFuncionarios[0]->getEmailInstitucional(), $mensaje, 'inmediata');
        }
  }
}
