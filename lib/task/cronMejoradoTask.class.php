<?php

class cronMejoradoTask extends sfBaseTask {

    protected function configure() {
        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
        ));

        $this->namespace = 'cronMejorado';
        $this->name = 'procesar';
        $this->briefDescription = '';
    }

    protected function execute($arguments = array(), $options = array()) {



        require_once(sfConfig::get("sf_root_dir") . '/config/ProjectConfiguration.class.php');
        $configuration = ProjectConfiguration::getApplicationConfiguration('acceso', 'dev', true);
        sfContext::createInstance($configuration);



        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();


        $correspondencias = Doctrine_Query::create()
                ->select('c.*')
                ->from('Correspondencia_Correspondencia c')
                ->where('c.status = ?', 'C')
                ->execute();

        foreach ($correspondencias as $correspondencia) {

            $correspondencia_emisores = Doctrine::getTable('Correspondencia_FuncionarioEmisor')->filtrarPorCorrespondencia($correspondencia->getId());



            $i = 0;
            $email_institucional = array();
            $email_personal = array();
            foreach ($correspondencia_emisores as $correspondencia_emisor) {

                if ($correspondencia_emisor->getEmailInstitucional())
                    $email_institucional = array_merge($email_institucional, array($correspondencia_emisor->getPn() . ', ' . $correspondencia_emisor->getPa() . '%%%' . $correspondencia_emisor->getCtnombre() . '%%%' . $correspondencia_emisor->getUnombre() . '%%%' . $correspondencia_emisor->getEmailInstitucional()));
                if ($correspondencia_emisor->getEmailPersonal())
                    $email_personal = array_merge($email_personal, array($correspondencia_emisor->getPn() . ', ' . $correspondencia_emisor->getPa() . '%%%' . $correspondencia_emisor->getCtnombre() . '%%%' . $correspondencia_emisor->getUnombre() . '%%%' . $correspondencia_emisor->getEmailPersonal()));

                $i++;
            }


            $email_institucional = array_unique($email_institucional);
            $email_personal = array_unique($email_personal);



            if (count($email_personal) > 0) {

                $mensaje['mensaje'] = "ENCABEZADOOO<br/>";
                $mensaje['mensaje'] .= "Sistema Integral para la Gestión Laboral, Administrativa y de Servicios (SIGLAS)<br/><br/><br/>";

                for ($i = 0; $i < count($email_personal); $i++) {
                    list($nombre, $cargo, $unidad, $email) = explode('%%%', $email_personal[$i]);

                    $mensaje['mensaje'] .= "Srs.-<br/>";
                    $mensaje['mensaje'] .= "UNIDAD<br/>";
                    $mensaje['mensaje'] .= "NOMBRE<br/>";
                    $mensaje['mensaje'] .= "CARGO<br/><br/><br/>";

                    $mensaje['mensaje'].="REcibe un saludo tienes correspondencia " . $correspondencia->getNCorrespondenciaEmisor() . ' sin atender';


                    $mensaje['emisor'] = 'Correspondencia';
                    $mensaje['receptor'] = $nombre;




                    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', '465', 'ssl')
                            ->setUsername('siglas.pruebas@gmail.com')
                            ->setPassword('siglaspruebas1234');

                    $mailer = Swift_Mailer::newInstance($transport);

                    $message = Swift_Message::newInstance('Correspondencia')
                            ->setContentType('text/html')
                            ->setFrom(array('siglas.pruebas@gmail.com' => 'MI NOMBRE'))
                            ->setTo(array($email => 'NOMBRE DE RECEPTOR'))
                            ->setBody($mensaje['mensaje']);

                    $send = $mailer->send($message);
                    return ($send) ? $mail['OK'] : $mail['nOK'];
                }
            }



//            
//        //Primero declaramos que fichero queremos abrir.
//        $fichero = sfConfig::get("sf_root_dir")."/config/siglas/cron.yml";
//        //Utilizamos la función file_exists() para confirmar su existencia.
//
//        
//        #Abrimos el fichero en modo de escritura 
//        $DescriptorFichero = fopen($fichero,"a"); 
//
//
//$texto = $correspondencia->getNCorrespondenciaEmisor();
//fwrite($DescriptorFichero, $texto . PHP_EOL);
//
//        #Cerramos el fichero 
//        fclose($DescriptorFichero); 
//            
        }
    }

}
