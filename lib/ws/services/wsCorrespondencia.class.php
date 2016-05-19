<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of wsCorrespondencia
 *
 * @author ProSoft Soutions Venezuela C.A.
 */
class wsCorrespondencia {
    public function recibirExterna($correspondencia_externa){
//        return $correspondencia_externa;
        $t_correspondencia = $correspondencia_externa['content']['correspondencia'];
        $t_formato = $correspondencia_externa['content']['formato'];
        $t_emisor = $correspondencia_externa['content']['emisor'];
        $t_receptor_externo = $correspondencia_externa['content']['receptor_externo'];
        $t_adjuntos = $correspondencia_externa['content']['adjunto'];
        $t_fisicos = $correspondencia_externa['content']['fisico'];
        
        $organismo_persona = Doctrine::getTable('Organismos_Persona')->findOneByOrganismoIdAndCi($correspondencia_externa['param']['heis'],$t_emisor[0]['cedula']);
        if(!$organismo_persona){
            $organismo_persona = new Organismos_Persona();
            $organismo_persona->setOrganismoId($correspondencia_externa['param']['heis']);
            $organismo_persona->setCi($t_emisor[0]['cedula']);
            $organismo_persona->setNombreSimple(str_replace('  ', ' ', $t_emisor[0]['primer_nombre'].' '.$t_emisor[0]['segundo_nombre'].' '.$t_emisor[0]['primer_apellido'].' '.$t_emisor[0]['segundo_apellido']));
            $organismo_persona->setPrimerNombre($t_emisor[0]['primer_nombre']);
            $organismo_persona->setSegundoNombre($t_emisor[0]['segundo_nombre']);
            $organismo_persona->setPrimerApellido($t_emisor[0]['primer_apellido']);
            $organismo_persona->setSegundoApellido($t_emisor[0]['segundo_apellido']);
            $organismo_persona->setEmailPrincipal($t_emisor[0]['email_principal']);
            $organismo_persona->setEmailSecundario($t_emisor[0]['email_secundario']);
            $organismo_persona->setSexo($t_emisor[0]['sexo']);
            $organismo_persona->setPrivado(FALSE);
            $organismo_persona->save();
        }
        
        foreach ($t_emisor[0]['telefonos'] as $telefono) {
            $organismo_persona_telefono = Doctrine::getTable('Organismos_PersonaTelefono')->findOneByPersonaIdAndTelefono($organismo_persona->getId(), $telefono['numero']);
            if (!$persona_telefono) {
                $organismo_persona_telefono = new Organismos_PersonaTelefono();
                $organismo_persona_telefono->setPersonaId($organismo_persona->getId());
                $organismo_persona_telefono->setTelefono($telefono['numero']);
                $organismo_persona_telefono->setTipo($telefono['tipo']);
                $organismo_persona_telefono->save();
            }
        }
        
        $organismo_persona_cargo = Doctrine::getTable('Organismos_PersonaCargo')->findOneByPersonaIdAndNombre($organismo_persona->getId(),$t_emisor[0]['cargo']);
        if(!$organismo_persona_cargo){
            $organismo_persona_cargo = new Organismos_PersonaCargo();
            $organismo_persona_cargo->setPersonaId($organismo_persona->getId());
            $organismo_persona_cargo->setNombre($t_emisor[0]['cargo']);
        } else if($organismo_persona_cargo->getStatus()=='I'){
            $organismo_persona_cargo->setStatus('A');
        }
        $organismo_persona_cargo->save();
        

        $correspondencia = new Correspondencia_Correspondencia();
        $correspondencia->setNCorrespondenciaEmisor($t_correspondencia['correlativo'].date('i:s'));
        $correspondencia->setNCorrespondenciaExterna($t_correspondencia['correlativo']);
        $correspondencia->setFEnvio($t_correspondencia['f_envio']);
        $correspondencia->setPrivado($t_correspondencia['privado']);           
        $correspondencia->setPrioridad($t_correspondencia['prioridad']);
        $correspondencia->setTipoTrasladoExterno('Interoperabilidad');
        $correspondencia->setEmisorOrganismoId($correspondencia_externa['param']['heis']);
        $correspondencia->setEmisorPersonaId($organismo_persona->getId());
        $correspondencia->setEmisorPersonaCargoId($organismo_persona_cargo->getId());
        $correspondencia->setInteroperabilidadRecibidaId($correspondencia_externa['param']['interoperabilidad_recibida_id']);
        $correspondencia->setStatus('E');
        $correspondencia->save();
        
        foreach ($t_receptor_externo as $key => $receptor_interno) {
            $funcionario_receptor = Doctrine::getTable('Funcionarios_Funcionario')->findOneByCi($receptor_interno['persona_ci']);
            
            if($funcionario_receptor){
                $funcionario_cargos_receptor = Doctrine::getTable('Funcionarios_FuncionarioCargo')->historicoCargosFuncionario($funcionario_receptor->getId());
                
                $cargo_receptor_good = NULL;
                $funcionario_receptor_good = NULL;
                foreach ($funcionario_cargos_receptor as $funcionario_cargo_receptor) {
                    $formato_cargo = Formateo::cargo($funcionario_cargo_receptor->getUnidad(), $funcionario_cargo_receptor->getCargoTipo());

                    if($formato_cargo == $receptor_interno['persona_cargo']){
                        $unidad_receptor_good = $funcionario_cargo_receptor->getUnidadId();
                        $cargo_receptor_good = $funcionario_cargo_receptor->getCargoId();

                        if($funcionario_cargo_receptor->getStatus()=='A'){
                            $funcionario_receptor_good = $funcionario_receptor->getId();
                        }
                    }
                }
                
                if($cargo_receptor_good != NULL && $funcionario_receptor_good == NULL){
                    $funcionario_cargos_actual = Doctrine::getTable('Funcionarios_FuncionarioCargo')->funcionarioDelCargo($cargo_receptor_good);
                    
                    if(count($funcionario_cargos_actual)>0){
                        $funcionario_receptor_good = $funcionario_cargos_actual[0]->getId();
                    }
                }
            }

            if($cargo_receptor_good != NULL && $funcionario_receptor_good != NULL){
                $receptor = new Correspondencia_Receptor();
                $receptor->setCorrespondenciaId($correspondencia->getId());
                $receptor->setUnidadId($unidad_receptor_good);
                $receptor->setCargoId($cargo_receptor_good);
                $receptor->setFuncionarioId($funcionario_receptor_good);
                $receptor->setCopia('N');
                $receptor->setEstablecido('S');
                $receptor->setPrivado($t_correspondencia['privado']);
                $receptor->save();
            }
        }
        
        $formato = new Correspondencia_Formato();
        $formato->setCorrespondenciaId($correspondencia->getId());
        $formato->setTipoFormatoId($t_formato['tipo_formato_id']);
        $formato->setCampoUno($t_formato['campo_uno']);
        $formato->setCampoDos($t_formato['campo_dos']);
        $formato->setCampoTres($t_formato['campo_tres']);
        $formato->setCampoCuatro($t_formato['campo_cuatro']);
        $formato->setCampoCinco($t_formato['campo_cinco']);
        $formato->setCampoSeis($t_formato['campo_seis']);
        $formato->setCampoSiete($t_formato['campo_siete']);
        $formato->setCampoOcho($t_formato['campo_ocho']);
        $formato->setCampoNueve($t_formato['campo_nueve']);
        $formato->setCampoDiez($t_formato['campo_diez']);
        $formato->setCampoOnce($t_formato['campo_once']);
        $formato->setCampoDoce($t_formato['campo_doce']);
        $formato->setCampoTrece($t_formato['campo_trece']);
        $formato->setCampoCatorce($t_formato['campo_catorce']);
        $formato->setCampoQuince($t_formato['campo_quince']);
        $formato->save();
        
        foreach ($t_fisicos as $key => $fisico) {
            $tipo_anexo_fisico = Doctrine::getTable('Correspondencia_TipoAnexoFisico')->findOneByNombre($fisico['tipo']);
            if(!$tipo_anexo_fisico){
                $tipo_anexo_fisico = new Correspondencia_TipoAnexoFisico();
                $tipo_anexo_fisico->setNombre($fisico['tipo']);
                $tipo_anexo_fisico->save();
            }
            
            $anexo_fisico = new Correspondencia_AnexoFisico();
            $anexo_fisico->setCorrespondenciaId($correspondencia->getId());
            $anexo_fisico->setTipoAnexoFisicoId($tipo_anexo_fisico->getId());
            $anexo_fisico->setObservacion($fisico['observacion']);
            $anexo_fisico->save();
        }
        
        $resultado['content']['status']='ok';
        $resultado['content']['correspondencia_entrada_id'] = $correspondencia->getId();
        
        //rollback status error
        return $resultado;
    }
}
