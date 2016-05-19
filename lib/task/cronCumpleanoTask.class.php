<?php

class cronCumpleanoTask extends sfBaseTask
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
    $this->name             = 'cumpleano';
    $this->briefDescription = 'Genera notificaciones siglas para usuarios que cumplan años, tambien a los miembros de su grupo';
    $this->detailedDescription = '';
  }

  protected function execute($arguments = array(), $options = array())
  {
    require_once(sfConfig::get("sf_root_dir") . '/config/ProjectConfiguration.class.php');
    $configuration = ProjectConfiguration::getApplicationConfiguration('correspondencia', 'dev', true);
    sfContext::createInstance($configuration);

    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $fechas_actuales= Array();

    $rango_max= date('Y')- 17;
    $rango_min= date('Y')- 80;
    for($rango_min; $rango_min <= $rango_max; $rango_min++)
        $fechas_actuales[]= $rango_min.'-'.date('m-d');

    $usuarios = Doctrine_Query::create()
                    ->select('f.id')
                    ->from('Funcionarios_Funcionario f')
                    ->whereIn("f.f_nacimiento", $fechas_actuales)
                    ->execute();

    foreach($usuarios as $val) {
        $this->notifyDesk($val->getId());

        //incluir otras notificaciones
    }
  }

  public function notifyDesk($funcionario_afectado)
  {
    $datos_func= Doctrine::getTable('Funcionarios_FuncionarioCargo')->unidadDelCargoDelFuncionario($funcionario_afectado);

    $adicionales= FALSE;
    if(count($datos_func)> 0) {
        $otros_func= Doctrine::getTable('Funcionarios_FuncionarioCargo')->funcionariosPorUnidad($datos_func[0]['unidad_id']);
        $adicionales= TRUE;
    }

    $datos_funcio_afectado= Doctrine::getTable('Funcionarios_Funcionario')->busquedaFuncionarioCargoUnidad($funcionario_afectado);

    if(file_exists(sfConfig::get("sf_root_dir").'/web/images/fotos_personal/'.$datos_funcio_afectado[0]['ci'].'.jpg')){
        $route_personal= '/images/fotos_personal/'.$datos_funcio_afectado[0]['ci'].'.jpg';
    } else {
        $route_personal= '/images/other/siglas_photo_small_'.$datos_funcio_afectado[0]['sexo'].substr($datos_funcio_afectado[0]['ci'], -1).'.png';
    }

    $mensaje= $this->randomMessage();

    $html= '
        <table width="100%">
            <tr>
                <td rowspan="3" width="65"><img style="border-radius: 7px; border: 1px solid #a6a6a6" src="' . $route_personal . '" width="60"/></td>
                <td class="f11n">' . date('d-m-Y h:i A', strtotime($datos_funcio_afectado[0]['created_at'])) . '</td>
            </tr>
            <tr>
                <td><font style="font-size: 19px">¡<b>'. $datos_funcio_afectado[0]['primer_nombre'] .'</b> el d&iacute;a de hoy, SIGLAS y todo su equipo te desean FELIZ CUMPLEAÑO!</font></td>
            </tr>
            <tr>
                <td class="f16n">
                    <em>'. $mensaje .'</em>
                </td>
            </tr>
    </table>';

    $comunicaciones_notificacion = new Comunicaciones_Notificacion();
    $comunicaciones_notificacion->setFuncionarioId($funcionario_afectado);
    $comunicaciones_notificacion->setAplicacionId(6); //funcionarios
    $comunicaciones_notificacion->setFormaEntrega('desk');
    $comunicaciones_notificacion->setMetodoId(5); //cumpleano
    $comunicaciones_notificacion->setFEntrega(date('Y-m-d H:i:s'));
    $comunicaciones_notificacion->setMensaje($html);
    $comunicaciones_notificacion->setStatus('A');
    $comunicaciones_notificacion->setIdUpdate("000");

    $comunicaciones_notificacion->save();

    //ADICIONALES. MIEMBROS DE SU GRUPO
    if($adicionales) {
        foreach($otros_func as $value) {
            if($value->getId() != $funcionario_afectado) {
                $html= '
                    <table width="100%">
                        <tr>
                            <td rowspan="3" width="65"><img style="border-radius: 7px; border: 1px solid #a6a6a6" src="' . $route_personal . '" width="60"/></td>
                            <td class="f11n">' . date('d-m-Y h:i A', strtotime($datos_funcio_afectado[0]['created_at'])) . '</td>
                        </tr>
                        <tr>
                            <td><font style="font-size: 17px">¿Sab&iacute;as que...? Hoy, <b>'. $datos_funcio_afectado[0]['primer_nombre'] .' '. $datos_funcio_afectado[0]['primer_apellido'] .'</b> esta cumpliendo a&ntilde;os!</font></td>
                        </tr>
                        <tr>
                            <td class="f16n">
                                <em>Nosotros ya '. (($datos_funcio_afectado[0]['sexo']== 'M') ? 'lo' : 'la') .' felicitamos en su d&iacute;a, solo faltas t&uacute;... ;)</em>
                            </td>
                        </tr>
                </table>';

                $comunicaciones_notificacion = new Comunicaciones_Notificacion();
                $comunicaciones_notificacion->setFuncionarioId($value->getId());
                $comunicaciones_notificacion->setAplicacionId(6); //funcionarios
                $comunicaciones_notificacion->setFormaEntrega('desk');
                $comunicaciones_notificacion->setMetodoId(5); //cumpleano
                $comunicaciones_notificacion->setFEntrega(date('Y-m-d H:i:s'));
                $comunicaciones_notificacion->setMensaje($html);
                $comunicaciones_notificacion->setStatus('A');
                $comunicaciones_notificacion->setIdUpdate("000");

                $comunicaciones_notificacion->save();
            }
        }
    }



  }

  public function randomMessage() {
      $mensaje= Array(
          'Hacerse mayor es comprender que, a pesar de cerrar ciclos, quedan muchos por abrir. ¡Feliz cumplea&ntilde;os!',
          'Esperamos que hoy sea un buen día para que la felicidad dibuje una sonrisa en tu cara. No eres más viej@: ¡eres más sabi@!. ¡Feliz cumplea&ntilde;os!',
          'Deseamos que cumplas muchos a&ntilde;os más lleno de bendición y felicidad. ¡Feliz cumplea&ntilde;os!',
          'Hoy y siempre el amor, la felicidad y los exitos te acompa&ntilde;en. ¡Feliz cumplea&ntilde;os!',
          'Esperamos que el día de hoy sea un día llenos de sorpresas y que dios te ilumine y te llene de bendiciones hoy y todos los días de tu vida. ¡Feliz cumplea&ntilde;os!',
          'Que pases un día feliz al lado de tus personas amadas y que Dios derrame en ti una enredadera de bendiciones. ¡Feliz cumplea&ntilde;os!',
          'Hola!!!! esperamos estés pasando muy feliz el Día de tu Cumplea&ntilde;os y deseamos que cumplas muchísimos a&ntilde;os más que puedas disfrutar a plenitud, un gran abrazo. ¡Feliz cumplea&ntilde;os!',
          'Que dios te de salud y muchos a&ntilde;os de vida, que en el día de hoy te colme de felicidad al lado de tus seres mas queridos. ¡Feliz cumplea&ntilde;os!',
          'Que desde hoy la magia sea tu mejor traje, tu sonrisa el mejor regalo, tus ojos el mejor destino y tu felicidad mi mejor deseo. ¡Feliz cumplea&ntilde;os!',
          'Que en este día y el resto de tus días te ilumine y te de toda la felicidad que te mereces. ¡Feliz cumplea&ntilde;os!',
          'Que Dios te colme de muchas bendiciones, te proteja y te de mucha salud y prosperidad. ¡Feliz cumplea&ntilde;os!',
          'Esperamos que el día de tu cumplea&ntilde;os pases un día muy feliz, que dios te ilumine siempre. ¡Feliz cumplea&ntilde;os!',
          'Felicidades!!!! Esperamos que tengas un día maravilloso, lleno de amor de todos los que te rodean, que dios te bendiga hoy y siempre. ¡Feliz cumplea&ntilde;os!',
          'Te deseamos una luz para tu camino, un ángel para tu destino, felicidad para tu vida y la bendición de dios en cada minuto de tu vida. ¡Feliz cumplea&ntilde;os!',
          'Esperamos que tengas un feliz y hermoso día y que la pases genial en tu cumplea&ntilde;os.',
          'Feliz cumplea&ntilde;os a ti, Feliz cumplea&ntilde;os a ti, Feliz cumplea&ntilde;os…….., Feliz cumplea&ntilde;os a ti!!!! Esperamos que cumplas muchos a&ntilde;os más.',
          'La vida se resume en 4 palabras: Dios, salud, amor y esperanza. Que el primero siempre te cuide y que el resto nunca te falte. ¡Feliz cumplea&ntilde;os!',
          'Que las bendiciones del buen dios te inunde con mucho amor, felicidad, salud y prosperidad. ¡Feliz cumplea&ntilde;os!',
          'Que todos tus sue&ntilde;os se hagan realidad y que dios siempre ilumine tu caminar y te colme de bendiciones. ¡Feliz cumplea&ntilde;os!',
          'Hola!!!! No podía dejar de pasar a desearte un Feliz Cumplea&ntilde;os, espero que la estés pasando super bien.',
          'Hoy celebramos que eres un a&ntilde;o mayor... pero no te preocupes que estás mucho mejor. FELIZ CUMPLEA&Ntilde;OS!!!',
          'Las palabras no pueden sustituír un abrazo... pero sirven para hacerte llegar nuestros mejores deseos. ¡Feliz cumplea&ntilde;os!',
      );

      $index= rand(0, count($mensaje)-1);

      return $mensaje[$index];
  }
  
  public function notifySms()
  {
      //Notificiones con formato para envio de sms de texto
  }
  
  public function notifyEmail()
  {
      //Notificiones con formato para envio de correo electronico
  }
}