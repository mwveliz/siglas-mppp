<?php

class cronCorrespondenciaBitacoraTask extends sfBaseTask {

    protected function configure() {
        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
        ));

        $this->namespace = 'cronCorrespondenciaBitacora';
        $this->name = 'procesar';
        $this->briefDescription = '';
        
        $this->addOption('frecuencia', null, sfCommandOption::PARAMETER_REQUIRED, 'Tipo de reporte ', false);
    }

    protected function execute($arguments = array(), $options = array()) {
        
        require_once(sfConfig::get("sf_root_dir") . '/config/ProjectConfiguration.class.php');
        $configuration = ProjectConfiguration::getApplicationConfiguration('correspondencia', 'dev', true);
        sfContext::createInstance($configuration);

        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        if($options['frecuencia']=='hoy'){
            
            
            $fecha_inicio=date('Y-m-d').' 00:00:00';
            $fecha_final=date('Y-m-d').' 23:59:59';
            
//            $fecha_inicio='2012-12-18 00:00:00';
//            $fecha_final='2012-12-18 23:59:59';
            
            $funcionarios_correspondencia = array();
            $correspondencias = Doctrine_Query::create()
                    ->select("f.id as funcionario_id")
                    
                    ->addSelect("(SELECT COUNT(c.id) as sin_leer
                                 FROM Correspondencia_Correspondencia c
                                 WHERE (c.id IN (SELECT r.correspondencia_id
                                        FROM Correspondencia_Receptor r 
                                        WHERE r.funcionario_id = f.id 
                                        AND r.establecido = 'S'))
                                 AND c.status IN ('E')
                                 AND c.f_envio > '".$fecha_inicio."' 
                                 AND c.f_envio < '".$fecha_final."') as sin_leer")

                    ->addSelect("(SELECT COUNT(c2.id) as recibidas
                                 FROM Correspondencia_Correspondencia c2
                                 WHERE (c2.id IN (SELECT r2.correspondencia_id
                                        FROM Correspondencia_Receptor r2
                                        WHERE r2.funcionario_id = f.id 
                                        AND r2.establecido = 'S'))
                                 AND c2.status IN ('L')
                                 AND c2.updated_at > '".$fecha_inicio."' 
                                 AND c2.updated_at < '".$fecha_final."') as recibidas")

                    ->addSelect("(SELECT COUNT(c3.id) as por_firmar
                                 FROM Correspondencia_Correspondencia c3
                                 WHERE (c3.id IN (SELECT fe.correspondencia_id 
                                        FROM Correspondencia_FuncionarioEmisor fe 
                                        WHERE fe.funcionario_id = f.id))
                                 AND c3.status IN ('C')
                                 AND c3.created_at > '".$fecha_inicio."' 
                                 AND c3.created_at < '".$fecha_final."') as por_firmar")

                    ->addSelect("(SELECT COUNT(c4.id) as enviadas
                                 FROM Correspondencia_Correspondencia c4
                                 WHERE (c4.id IN (SELECT fe2.correspondencia_id 
                                        FROM Correspondencia_FuncionarioEmisor fe2 
                                        WHERE fe2.funcionario_id = f.id))
                                 AND c4.status IN ('E')
                                 AND c4.created_at > '".$fecha_inicio."' 
                                 AND c4.created_at < '".$fecha_final."') as enviadas")

                    ->addSelect("(SELECT COUNT(c5.id) as entregadas
                                 FROM Correspondencia_Correspondencia c5
                                 WHERE (c5.id IN (SELECT fe3.correspondencia_id 
                                        FROM Correspondencia_FuncionarioEmisor fe3 
                                        WHERE fe3.funcionario_id = f.id))
                                 AND c5.status IN ('L')
                                 AND c5.created_at > '".$fecha_inicio."' 
                                 AND c5.created_at < '".$fecha_final."') as entregadas")

                    ->addSelect("(SELECT COUNT(c6.id) as devueltas
                                 FROM Correspondencia_Correspondencia c6
                                 WHERE (c6.id IN (SELECT fe4.correspondencia_id 
                                        FROM Correspondencia_FuncionarioEmisor fe4 
                                        WHERE fe4.funcionario_id = f.id))
                                 AND c6.status IN ('D')
                                 AND c6.created_at > '".$fecha_inicio."' 
                                 AND c6.created_at < '".$fecha_final."') as devueltas")

                    ->addSelect("(SELECT COUNT(c7.id) as anuladas
                                 FROM Correspondencia_Correspondencia c7
                                 WHERE (c7.id IN (SELECT fe5.correspondencia_id 
                                        FROM Correspondencia_FuncionarioEmisor fe5 
                                        WHERE fe5.funcionario_id = f.id))
                                 AND c7.status IN ('A')
                                 AND c7.created_at > '".$fecha_inicio."' 
                                 AND c7.created_at < '".$fecha_final."') as anuladas")

                    ->from('Funcionarios_Funcionario f')
                    ->where("f.id IN (148)")
                    ->execute(); 



            foreach ($correspondencias as $correspondencia) {
                //BANDEJA DE ENVIADA
                $funcionarios_correspondencia[$correspondencia->getFuncionarioId()]['sin_leer'] = $correspondencia->getSinLeer();
                $funcionarios_correspondencia[$correspondencia->getFuncionarioId()]['recibidas'] = $correspondencia->getRecibidas();
                
                //BANDEJA DE RECIBIDA
                $funcionarios_correspondencia[$correspondencia->getFuncionarioId()]['por_firmar'] = $correspondencia->getPorFirmar();
                $funcionarios_correspondencia[$correspondencia->getFuncionarioId()]['enviadas'] = $correspondencia->getEnviadas();
                $funcionarios_correspondencia[$correspondencia->getFuncionarioId()]['entregadas'] = $correspondencia->getEntregadas();
                $funcionarios_correspondencia[$correspondencia->getFuncionarioId()]['devueltas'] = $correspondencia->getDevueltas();
                $funcionarios_correspondencia[$correspondencia->getFuncionarioId()]['anuladas'] = $correspondencia->getAnuladas();

            }

            print_r($funcionarios_correspondencia);
        } else {
            echo "opcion desconocida\n";
        }
    }

}


//                $unidad_cargo = Doctrine::getTable('Funcionarios_FuncionarioCargo')->unidadCargoActual($recibida->getId());
//                
//                if(count($unidad_cargo)>0){
//                    $unidad_cargo = $unidad_cargo[0];
//                    $unidad = $unidad_cargo->getUnidad();
//                    $cargo = $unidad_cargo->getCargoTipo();
//                }