<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of wsEstructura
 *
 * @author livio
 */
class wsEstructura {   
    public function recibirEstructura($data){
//                    $sfprueba = sfYAML::dump($data);
//                    file_put_contents(sfConfig::get("sf_root_dir").'/config/siglas/ws.yml', $sfprueba);
//                    exit();
        $servidor_confianza = Doctrine::getTable('Siglas_ServidorConfianza')->findOneByDominio($data['param']['dominio']);
        
        if($servidor_confianza){
            $estructuras = $data['content'];
                    $sfprueba = sfYAML::dump($estructuras);
                    file_put_contents(sfConfig::get("sf_root_dir").'/config/siglas/ws.yml', $sfprueba);
            
            $conn = Doctrine_Manager::connection();
            try {
                $conn->beginTransaction();
                
                $personas_recibidas = array();
                $cargo_recibidos = array();
                
                foreach ($estructuras as $estructura) {
                    $unidad = $estructura['unidad'];

                    foreach ($estructura['funcionarios'] as $funcionario) {
                        $organismo_persona = Doctrine::getTable('Organismos_Persona')->findOneByOrganismoIdAndCi($servidor_confianza->getOrganismoId(),$funcionario['ci']);

                        if(!$organismo_persona){
                            $nombre_simple = $funcionario['primer_nombre'].' '.$funcionario['segundo_nombre'].' '.$funcionario['primer_apellido'].' '.$funcionario['segundo_apellido'];
                            $nombre_simple = str_replace('  ', ' ', $nombre_simple);

                            $organismo_persona = new Organismos_Persona();
                            $organismo_persona->setOrganismoId($servidor_confianza->getOrganismoId());
                            $organismo_persona->setCi($funcionario['ci']);
                            $organismo_persona->setNombreSimple($nombre_simple);
                            $organismo_persona->setPrimerNombre($funcionario['primer_nombre']);
                            $organismo_persona->setSegundoNombre($funcionario['segundo_nombre']);
                            $organismo_persona->setPrimerApellido($funcionario['primer_apellido']);
                            $organismo_persona->setSegundoApellido($funcionario['segundo_apellido']);
                            $organismo_persona->setEmailPrincipal($funcionario['email_institucional']);
                            $organismo_persona->setSexo($funcionario['sexo']);
                            $organismo_persona->setPrivado(FALSE);
                            $organismo_persona->save();
                        } else if($organismo_persona->getStatus()=='I'){
                            $organismo_persona->setStatus('A');
                            $organismo_persona->save();
                        }
                        
                        $personas_recibidas[] = $organismo_persona->getId();

                        foreach ($funcionario['telefonos'] as $telefono) {
                            $organismo_persona_telefono = Doctrine::getTable('Organismos_PersonaTelefono')->findOneByPersonaIdAndTelefono($organismo_persona->getId(),$telefono['numero']);
                            if(!$organismo_persona_telefono){
                                $organismo_persona_telefono = new Organismos_PersonaTelefono();
                                $organismo_persona_telefono->setPersonaId($organismo_persona->getId());
                                $organismo_persona_telefono->setTelefono($telefono['numero']);
                                $organismo_persona_telefono->setTipo($telefono['tipo']);
                                $organismo_persona_telefono->save();
                            }
                        }
                        
                        $organismo_persona_cargo = Doctrine::getTable('Organismos_PersonaCargo')->findOneByPersonaIdAndNombre($organismo_persona->getId(),$funcionario['cargo']);
                        if(!$organismo_persona_cargo){
                            $organismo_persona_cargo = new Organismos_PersonaCargo();
                            $organismo_persona_cargo->setPersonaId($organismo_persona->getId());
                            $organismo_persona_cargo->setNombre($funcionario['cargo']);
                        } else if($organismo_persona_cargo->getStatus()=='I'){
                            $organismo_persona_cargo->setStatus('A');
                        }
                        $organismo_persona_cargo->save();
                        
                        $cargo_recibidos[]=$organismo_persona_cargo->getId();
                    }
                }
                
                //INACTIVACION DE LOS FUNCIONARIOS QUE YA NO ESTAN
                $inactivar_personas = Doctrine_Query::create()
                    ->update('Organismos_Persona')
                    ->set('status','?', 'I')
                    ->where('organismo_id = ?', $servidor_confianza->getOrganismoId())
                    ->andWhereNotIn('id',$personas_recibidas)
                    ->execute();
                
                //INACTIVACION DE LOS CARGOS QUE YA NO TIENEN LOS FUNCIONARIOS
                $inactivar_cargos = Doctrine_Query::create()
                    ->update('Organismos_PersonaCargo')
                    ->set('status','?', 'I')
                    ->whereIn('persona_id', $personas_recibidas)
                    ->andWhereNotIn('id',$cargo_recibidos)
                    ->execute();
                
                $io_basica=array();
                $io_basica = sfYaml::load($servidor_confianza->getIoBasica());

                $io_basica['estructura']['status_recepcion'] = true;
                $io_basica['estructura']['fecha_recepcion'] = date('Y-m-d h:i:s');
  
                $io_basica = sfYaml::dump($io_basica);
                $servidor_confianza->setIoBasica($io_basica);
                $servidor_confianza->save();
                    
                $conn->commit();
                
                $responce['notify']['status']='ok';
                $responce['notify']['message']='El SIGLAS receptor recibio nuestra estructura organizativa con exito.';

            } catch(Exception $e){
                $conn->rollBack();
                
                $io_basica=array();
                $io_basica = sfYaml::load($servidor_confianza->getIoBasica());

                $io_basica['estructura']['status_recepcion'] = false;
                $io_basica['estructura']['fecha_recepcion'] = date('Y-m-d h:i:s');
  
                $io_basica = sfYaml::dump($io_basica);
                $servidor_confianza->setIoBasica($io_basica);
                $servidor_confianza->save();
                
                $responce['notify']['status']='error';
                $responce['notify']['message']='Ocurrio un error al recibir la estructura en el SIGLAS receptor.';
            }

        } else {
            $responce['notify']['status']='error';
            $responce['notify']['message']='El SIGLAS receptor recibio la estructura, sin embargo no la registro ya que no reconoce este SIGLAS como servidor de confianza.';
        }
        
        return $responce;
    }
}