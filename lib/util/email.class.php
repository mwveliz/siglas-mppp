<?php

class Email {
    static function notificacion($aplicacion, $email, $mensaje, $modo, $adjuntos= NULL) {
        $sf_email = sfYaml::load(sfConfig::get('sf_root_dir')."/config/siglas/email.yml");
        $adjuntos_ar= Array();
        if($adjuntos && count($adjuntos)> 0) {
            //envia correo con adjunto solo si este existe y es menor a 10 MB
            $cant= 0;
            foreach($adjuntos as $adjunto) {
                if(file_exists(sfConfig::get('sf_root_dir').'/web/uploads/' . $aplicacion . '/' . $adjunto) && filesize(sfConfig::get('sf_root_dir').'/web/uploads/' . $aplicacion . '/'.$adjunto) < 10485760) {
                    $adjunto= sfConfig::get('sf_root_dir').'/web/uploads/' . $aplicacion . '/'.$adjunto;
                    $parts= explode('__', $adjunto);
                    if(count($parts) > 1)
                        $file_name= $parts[count($parts)-1];
                    else
                        $file_name= $parts[0];
                    $adjuntos_ar[$cant]['name']= $file_name;
                    $adjuntos_ar[$cant]['route']= $adjunto;
                    $cant++;
                }
            }
        }
        
        if($sf_email['activo']==true)
        {
            if($sf_email['aplicaciones'][$aplicacion][$modo]['activo']==true)
            {
                foreach ($sf_email['cuentas'] as $cuenta) {
                    if($cuenta['activo']==true)
                    {
                        $mail = self::mensaje($aplicacion, $mensaje);

                        $conector = $cuenta['conector'];
                        $acceso = $cuenta['acceso'];

                        $transport = Swift_SmtpTransport::newInstance($conector['smtp'], $conector['port'], $conector['cifrado'])
                                ->setUsername($acceso['usuario'])
                                ->setPassword($acceso['clave']);

                        $mailer = Swift_Mailer::newInstance($transport);

                        $message = Swift_Message::newInstance($mail['asunto'])
                                ->setContentType('text/html')
                                ->setFrom(array($acceso['usuario'] => $mensaje['emisor']))
                                ->setTo(array($email => $mensaje['receptor']))
                                ->setBody($mail['mensaje']);

                        if(count($adjuntos_ar) > 0) {
                            foreach($adjuntos_ar as $val) {
                                $attachment = Swift_Attachment::fromPath($val['route'])
                                        ->setFilename($val['name']);
                                $message->attach($attachment);
                            }
                        }

                        if(!$sock = @fsockopen($conector['smtp'], $conector['port'], $num, $error, 5))
                            $send = false;
                        else
                            $send = $mailer->send($message);

                        return ($send) ? $mail['OK'] : $mail['nOK'];
                    }
                }
            }
        }
    }

    static function notificacion_libre($aplicacion, $email, $mensaje) {
        $sf_email = sfYaml::load(sfConfig::get('sf_root_dir')."/config/siglas/email.yml");

        foreach ($sf_email['cuentas'] as $cuenta) {
            if($cuenta['activo']==true)
            {
                $mail = self::mensaje($aplicacion, $mensaje);

                $conector = $cuenta['conector'];
                $acceso = $cuenta['acceso'];

                $transport = Swift_SmtpTransport::newInstance($conector['smtp'], $conector['port'], $conector['cifrado'])
                        ->setUsername($acceso['usuario'])
                        ->setPassword($acceso['clave']);

                $mailer = Swift_Mailer::newInstance($transport);

                $message = Swift_Message::newInstance($mail['asunto'])
                        ->setContentType('text/html')
                        ->setFrom(array($acceso['usuario'] => $mensaje['emisor']))
                        ->setTo(array($email => $mensaje['receptor']))
                        ->setBody($mail['mensaje']);

                $send = $mailer->send($message);
                return ($send) ? $mail['OK'] : $mail['nOK'];
            }
        }
    }

    static function mensaje($aplicacion, $mensaje) {
        $asunto = '';
        $msj = array();

        switch ($aplicacion) {
            case 'mensajes':
                $asunto = "SIGLAS-".sfConfig::get('sf_siglas')." / Nuevo mensaje de ".$mensaje['emisor'];

                $msj['men_inicio'] = "<p>".$mensaje['mensaje']."</p>";

                $OK = true;

                $nOK = false;

                break;
            case 'correspondencia':
                $asunto = "SIGLAS-".sfConfig::get('sf_siglas')." / Correspondencia";

                $msj['men_inicio'] = "<p>".$mensaje['mensaje']."</p>";

                $OK = true;

                $nOK = false;

                break;
            case 'archivo':
                $asunto = "SIGLAS-".sfConfig::get('sf_siglas')." / Archivo";

                $msj['men_inicio'] = "<p>".$mensaje['mensaje']."</p>";

                $OK = true;

                $nOK = false;

                break;
            case 'contraseña':
                $asunto = "SIGLAS-".sfConfig::get('sf_siglas')." / Recuperación de contraseña";

                $msj['men_inicio'] = "<p>".$mensaje['mensaje']."</p>";

                $OK = true;

                $nOK = false;

                break;
            case 'bienvenido':
                $asunto = "SIGLAS-".sfConfig::get('sf_siglas')." / Bienvenid@";

                $msj['men_inicio'] = "<p>".$mensaje['mensaje']."</p>";

                $OK = true;

                $nOK = false;

                break;
            case 'validacion':
                $asunto = "SIGLAS-".sfConfig::get('sf_siglas')." / Validación de contacto";

                $msj['men_inicio'] = "<p>".$mensaje['mensaje']."</p>";

                $OK = true;

                $nOK = false;

                break;
            case 'calendario':
                $asunto = "SIGLAS-".sfConfig::get('sf_siglas')." / Evento proximo";

                $msj['men_inicio'] = "<p>".$mensaje['mensaje']."</p>";

                $OK = true;

                $nOK = false;

                break;
        }

        return array('asunto' => $asunto, 'mensaje' => self::plantilla($msj), 'OK' => $OK, 'nOK' => $nOK);
    }

    static function plantilla($info) {
        $html = "
            <table cellspacing=0 celpadding=0>
                <tr>
                    <td>
                        <h3>
                            <img src='".sfConfig::get('sf_dominio')."/images/organismo/banner_izquierdo.png' ALT='".sfConfig::get('sf_organismo')."' width='440'/>
                        </h3>
                    </td>
                    <td>
                        <h3>
                            <img src='".sfConfig::get('sf_dominio')."/images/organismo/banner_derecho.png' ALT=''/>
                        </h3>
                    </td>
                </tr>";
        $html.= "<tr>
                    <td colspan='2'><hr color='silver'/><br/><br/></td>
                </tr>";
        $html.= "<tr>
                    <td colspan='2' style='padding-left:25x' align='center'>{$info['men_inicio']}</td>
                </tr>";
        $html.= "<tr>
                    <td colspan='2'><br/><br/><hr color='silver'/></td>
                </tr>";
        $html .= "<tr>
                    <td colspan='2' align='center'>
                        <img src='".sfConfig::get('sf_dominio')."/images/organismo/pdf/gob_footer_pdf.png' width='550' ALT=''/><br/>
                        <font size='1' color='silver'>".sfConfig::get('sf_dominio')."</font>
                    </td>
                </tr>";
                    
        $html.= "</table>";

        return $html;
    }
}
?>
