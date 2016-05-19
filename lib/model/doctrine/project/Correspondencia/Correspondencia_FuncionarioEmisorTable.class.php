<?php


class Correspondencia_FuncionarioEmisorTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_FuncionarioEmisor');
    }
    
    public function filtrarPorCorrespondencia($correspondencia_id, $historia=FALSE)
    {
            $q = Doctrine_Query::create()
                ->select('cfe.*, f.primer_nombre as pn, f.segundo_nombre as sn, f.primer_apellido as pa, f.segundo_apellido as sa, 
                        f.ci as ci, f.sexo as sexo, c.unidad_funcional_id as funcional_id, c.codigo_nomina as cod, u.nombre as unombre, 
                        f.email_institucional as email_institucional, f.email_personal as email_personal, f.telf_movil as telf_movil, 
                        fc.observaciones as firma_personal, c.descripcion as firma_cargo, fc.cargo_id as cargo_id,
                        (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre')
                    ->addSelect('(SELECT un.nombre FROM Organigrama_Unidad un WHERE un.id = u.padre_id LIMIT 1) as padre_unidad')
                ->from('Correspondencia_FuncionarioEmisor cfe')
                ->innerjoin('cfe.Funcionarios_Funcionario f')
                ->innerjoin('cfe.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->where('cfe.correspondencia_id = ?', $correspondencia_id);
            //SI LA CONSULTA ES PARA HISTORIAS, NO TOMA EN CUENTA EL STATUS. EJ. CORRESPONDENCIA FIRMADA ANTERIORMENTE POR UN GERENTE DIFERENTE AL ACTUAL
            if(!$historia)
                $q ->andWhere('fc.status = ?','A');

            $q ->orderBy('f.primer_nombre, f.segundo_nombre')
                ->useResultCache(true, 3600, 'correspondencia_enviada_list_funcionario_emisor_'.$correspondencia_id);

            return $q->execute();
    }

    public function filtrarPorCorrespondenciaSeguimiento($correspondencia_id)
    {
            $q = Doctrine_Query::create()
                ->select('cfe.*, f.primer_nombre as pn, f.segundo_nombre as sn, f.primer_apellido as pa, f.segundo_apellido as sa, 
                        f.ci as ci, f.sexo as sexo, c.codigo_nomina as cod, u.nombre as unombre, f.email_institucional as email_institucional, f.email_personal as email_personal, 
                        fc.observaciones as firma_personal, c.descripcion as firma_cargo, fc.cargo_id as cargo_id,
                        (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre')
                    ->addSelect('(SELECT un.nombre FROM Organigrama_Unidad un WHERE un.id = u.padre_id LIMIT 1) as padre_unidad')
                ->from('Correspondencia_FuncionarioEmisor cfe')
                ->innerjoin('cfe.Funcionarios_Funcionario f')
                ->innerjoin('cfe.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->where('cfe.correspondencia_id = ?', $correspondencia_id)
                ->orderBy('f.primer_nombre, f.segundo_nombre');

            return $q->execute();
    }
    
    public function filtrarPorCorrespondenciaPasivo($correspondencia_id)
    {
            //ESTA FUNCION FILTRA SIN IMPORTAR LOS STATUS (REPORTES, INFO DE HISTORIAL, TEASER DE REDIRECCIONES)
            $q = Doctrine_Query::create()
                ->select('cfe.id, f.primer_nombre as pn, f.segundo_nombre as sn, f.primer_apellido as pa, f.segundo_apellido as sa, 
                        f.ci as ci, f.sexo as sexo, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre')
                ->from('Correspondencia_FuncionarioEmisor cfe')
                ->innerjoin('cfe.Funcionarios_Funcionario f')
                ->innerjoin('cfe.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->where('cfe.correspondencia_id = ?', $correspondencia_id);

            return $q->execute();
    }

    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
            $q = Doctrine_Query::create()
                ->select('cfe.*, f.sexo as sexo, concat(f.primer_nombre, \' \', f.segundo_nombre, \', \', f.primer_apellido, \' \', f.segundo_apellido) as persona, ct.nombre as ctnombre')
                ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = cfe.id_update LIMIT 1) as user_update')
                ->from('Correspondencia_FuncionarioEmisor cfe')
                ->innerjoin('cfe.Funcionarios_Funcionario f')
                ->leftjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->where('cfe.correspondencia_id = ?', sfContext::getInstance()->getUser()->getAttribute('correspondencia_id'))
                ->andWhere('fc.status = ?','A')
                ->orderBy('f.primer_nombre, f.segundo_nombre')
                ->useResultCache(true, 3600, 'correspondencia_funcionario_emisor_list_'.sfContext::getInstance()->getUser()->getAttribute('correspondencia_id'));

            return $q;

    }

    public function comboCorrepondenciaFuncionarioEmisor()
    {
        $funcionario_id = sfContext::getInstance()->getUser()->getAttribute('funcionario_id');
        $correspondencia_id = sfContext::getInstance()->getUser()->getAttribute('correspondencia_id');

        $q = Doctrine_Query::create()
            ->select('f.*')
            ->from('Funcionarios_Funcionario f')
            ->where('(f.id IN (
                        SELECT cfu.funcionario_id
                        FROM Correspondencia_FuncionarioUnidad cfu
                        WHERE cfu.autorizada_unidad_id IN (
                            SELECT cfu2.autorizada_unidad_id
                            FROM Correspondencia_FuncionarioUnidad cfu2
                            WHERE cfu2.funcionario_id = '.$funcionario_id.'
                            AND cfu2.status = \'A\'
                            AND cfu2.redactar = \'t\')
                        AND cfu.firmar = \'t\')
                     OR f.id = '.$funcionario_id.')');
        
        if($correspondencia_id!='')
        {
            $q->andWhere('f.id NOT IN (
                        SELECT cfe.funcionario_id
                        FROM Correspondencia_FuncionarioEmisor cfe
                        WHERE cfe.correspondencia_id = '.$correspondencia_id.')');
        }
        
        $funcionarios_firman = $q->execute();

        $opciones[''] = '<- Seleccione ->';
        foreach ($funcionarios_firman as $funcionario_firma) {

            $nombre = $funcionario_firma->getPrimerNombre().' '.
                      $funcionario_firma->getSegundoNombre().', '.
                      $funcionario_firma->getPrimerApellido().' '.
                      $funcionario_firma->getSegundoApellido();

            $opciones[$funcionario_firma->getId()] = ucwords(strtolower($nombre));
        }

        return $opciones;
    }

    public function firmantesGrupos()
    {
        $funcionario_id = sfContext::getInstance()->getUser()->getAttribute('funcionario_id');
        
        $q = Doctrine_Query::create()
            ->select('f.*')
            ->from('Funcionarios_Funcionario f')
            ->where('(f.id IN (
                        SELECT cfu.funcionario_id
                        FROM Correspondencia_FuncionarioUnidad cfu
                        WHERE cfu.autorizada_unidad_id IN (
                            SELECT cfu2.autorizada_unidad_id
                            FROM Correspondencia_FuncionarioUnidad cfu2
                            WHERE cfu2.funcionario_id = '.$funcionario_id.'
                            AND cfu2.status = \'A\'
                            AND cfu2.redactar = \'t\')
                        AND cfu.firmar = \'t\'))')
            ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
            ->innerjoin('fc.Organigrama_Cargo c')
            ->innerjoin('c.Organigrama_CargoTipo ct')
            ->andWhere('fc.status = ?','A')
            ->execute();
        
        
        $opciones[''] = '<- Seleccione ->';
        foreach ($q as $funcionario_firma) {
            
            $nombre = $funcionario_firma->getPrimerNombre().' '.
                      $funcionario_firma->getSegundoNombre().', '.
                      $funcionario_firma->getPrimerApellido().' '.
                      $funcionario_firma->getSegundoApellido();

            $opciones[$funcionario_firma->getId()] = ucwords(strtolower($nombre));
        }

        return $opciones;
    }
    
    public function firmantesUnidades($unidad_ids,$tipo_firmante, $tipos_cargo = null)
    {   
        $q1=''; $q2='';
        if($tipo_firmante=='autorizados' || $tipo_firmante=='especificos'){
            $q1 = Doctrine_Query::create()
                ->select('cfu.id, cfu.funcionario_id, concat(f.primer_nombre, \' \', f.segundo_nombre, \' \', f.primer_apellido, \' \', f.segundo_apellido) as persona, 
                         fc.id as funcionario_cargo_id, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre, 
                         cfu.autorizada_unidad_id, cfu.dependencia_unidad_id')
//                ->addSelect('(SELECT un.nombre FROM Organigrama_Unidad un WHERE un.id = cfu.dependencia_unidad_id LIMIT 1) as unombre')
                ->from('Correspondencia_FuncionarioUnidad cfu')
                ->innerjoin('cfu.Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('c.Organigrama_CargoGrado cg')
                ->where('cfu.autorizada_unidad_id IN ('.$unidad_ids.')')
                ->andWhere('c.unidad_funcional_id = cfu.dependencia_unidad_id')
                ->andWhere('cfu.deleted_at is null')
                ->andWhere('cfu.firmar = ?', 't')
                ->andWhere('fc.status = ?', 'A')
                ->andWhere('cfu.status = ?', 'A')
                ->orderBy('ct.orden, cg.orden, ct.nombre DESC, f.primer_nombre, f.primer_apellido');
        } 
        
        if($tipo_firmante=='todos' || $tipo_firmante=='especificos') {
            
            $q2 = Doctrine_Query::create()
                ->select('f.id, fc.funcionario_id as funcionario_id, concat(f.primer_nombre, \' \', f.segundo_nombre, \' \', f.primer_apellido, \' \', f.segundo_apellido) as persona, 
                         fc.id as funcionario_cargo_id, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre')
//                ->addSelect('(SELECT un.nombre FROM Organigrama_Unidad un WHERE un.id = cfu.dependencia_unidad_id LIMIT 1) as unombre')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('c.Organigrama_CargoGrado cg')
                ->where('c.unidad_funcional_id IN ('.$unidad_ids.')')
                ->andWhere('c.status = ?', 'A')
                ->andWhere('fc.status = ?', 'A')
                ->orderBy('ct.orden, cg.orden, ct.nombre DESC, f.primer_nombre, f.primer_apellido');
        }

        if($tipo_firmante=='especificos') {
            $ids = implode(',', $tipos_cargo);
            
            $q1->addWhere('c.cargo_tipo_id IN ('.$ids.')');
            $q2->addWhere('c.cargo_tipo_id IN ('.$ids.')');
        }

        $opciones=array();
        
        if($q1 != ''){
            $q1 = $q1->execute();
            foreach ($q1 as $funcionario_firma) {
                $nombre = $funcionario_firma->getPersona();

                if($funcionario_firma->getDependenciaUnidadId() == $funcionario_firma->getAutorizadaUnidadId()){
                    $opciones[$funcionario_firma->getFuncionarioId().'-'.$funcionario_firma->getFuncionarioCargoId()] = $nombre.' ('.$funcionario_firma->getCtnombre().')';
                } else {
                    $opciones[$funcionario_firma->getFuncionarioId().'-'.$funcionario_firma->getFuncionarioCargoId().'-'.$funcionario_firma->getDependenciaUnidadId()] = $nombre.' ('.$funcionario_firma->getCtnombre().')';
                }
            }
        }
        
        if($q2 != ''){
            $q2 = $q2->execute();
            foreach ($q2 as $funcionario_firma) {
                $nombre = $funcionario_firma->getPersona();

                $opciones[$funcionario_firma->getFuncionarioId().'-'.$funcionario_firma->getFuncionarioCargoId()] = $nombre.' ('.$funcionario_firma->getCtnombre().')';
            }
        }
//        echo $tipo_firmante;
//        print_r($opciones); exit();
        return $opciones;
    }
}