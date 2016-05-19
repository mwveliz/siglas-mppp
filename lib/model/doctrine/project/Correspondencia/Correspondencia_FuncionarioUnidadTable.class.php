<?php

class Correspondencia_FuncionarioUnidadTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_FuncionarioUnidad');
    }
    
    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        if(sfContext::getInstance()->getUser()->getAttribute('pae_funcionario_unidad_id'))
            $funcionario_unidad_id= sfContext::getInstance()->getUser()->getAttribute('pae_funcionario_unidad_id');
        else
            $funcionario_unidad_id= sfContext::getInstance()->getUser()->getAttribute('funcionario_unidad_id');

        $q = Doctrine_Query::create()
                ->select('cfu.id, concat(f.primer_nombre, \' \', f.primer_apellido) as persona, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre, f.sexo as sexo')
                ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = cfu.id_update LIMIT 1) as user_update')
                ->addSelect('(SELECT un.nombre FROM Organigrama_Unidad un WHERE un.id = cfu.dependencia_unidad_id LIMIT 1) as unombre')
                ->from('Correspondencia_FuncionarioUnidad cfu')
                ->innerjoin('cfu.Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->where('cfu.autorizada_unidad_id = ?', $funcionario_unidad_id)
                ->andWhere('cfu.status = ?', 'A')
                ->andWhere('cfu.deleted_at is null')
                ->orderBy('f.primer_nombre, f.primer_apellido');

            return $q;
    }

    public function grupoUnidad($unidad_id) 
    {
            $q = Doctrine_Query::create()
                ->select('cfu.id, concat(f.primer_nombre, \' \', f.primer_apellido) as persona, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre, f.sexo as sexo')
                ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = cfu.id_update LIMIT 1) as user_update')
                ->addSelect('(SELECT un.nombre FROM Organigrama_Unidad un WHERE un.id = cfu.dependencia_unidad_id LIMIT 1) as unombre')
                ->from('Correspondencia_FuncionarioUnidad cfu')
                ->innerjoin('cfu.Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->where('cfu.autorizada_unidad_id = ?', $unidad_id)
                ->andWhere('c.unidad_funcional_id = cfu.dependencia_unidad_id')
                ->andWhere('cfu.deleted_at is null')
                ->andWhere('cfu.status = ?', 'A')
                ->andWhere('fc.status = ?', 'A')
                ->orderBy('f.primer_nombre, f.primer_apellido')
                ->execute();

            return $q;
    }
    
    public function grupoUnidadHistorico($unidad_id) 
    {
            $q = Doctrine_Query::create()
                ->select('f.*, f.id as id, concat(f.primer_nombre, \' \', f.primer_apellido) as persona')
                ->from('Funcionarios_Funcionario f')
                ->andWhere("f.id IN
                            (SELECT DISTINCT (cfu.funcionario_id) as unico
                            FROM Correspondencia_FuncionarioUnidad cfu 
                            WHERE cfu.autorizada_unidad_id = ".$unidad_id.")")
                ->orderBy('f.id asc')
                ->execute();

            return $q;
    }
    
    public function funcionarioHistorico($funcionario_id, $unidad_id) 
    {
            $q = Doctrine_Query::create()
                ->select('cfu.*')
                ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = cfu.id_update LIMIT 1) as user_update')
                ->from('Correspondencia_FuncionarioUnidad cfu')
                ->where('cfu.funcionario_id = ?', $funcionario_id)
                ->andWhere('cfu.autorizada_unidad_id = ?', $unidad_id)
                ->orderBy('cfu.id desc')
                ->execute();

            return $q;
    }
    
    public function funcionarioAutorizado($funcionario_id,$para='redactar')
    {
        $q = Doctrine_Query::create()
            ->select('cfu.*')
            ->from('Correspondencia_FuncionarioUnidad cfu')
            ->Where('cfu.funcionario_id = ?', $funcionario_id)
            ->andWhere('cfu.status = ?', 'A');
            //->useResultCache(true, 604800, 'correspondencia_grupo_funcionario_id_'.sfContext::getInstance()->getUser()->getAttribute('funcionario_id'));

        switch ($para) {
            case 'redactar' :
                $q->andWhere('cfu.redactar = ?', 't');
                break;
            case 'leer' :
                $q->andWhere('cfu.leer = ?', 't');
                break;
            case 'recibir' :
                $q->andWhere('cfu.recibir = ?', 't');
                break;
            case 'firmar' :
                $q->andWhere('cfu.firmar = ?', 't');
                break;
        }
            
        return $q->execute();
    }
    
    public function esperaValidacionGrupo($grupo_id, $funcionario_id){
        $q = Doctrine_Query::create()
                ->update('Correspondencia_FuncionarioUnidad cfu')
                ->set('permitido', 'FALSE')
                ->set('permitido_funcionario', '?', $funcionario_id.'#G')
                ->where('cfu.id = ?', $grupo_id)
                ->andWhere('cfu.status = ?', 'A');
        $q->execute();
    }
    
    public function esperaValidacionUnidad($usuario_mover_id, $nueva_unidad_id, $funcionario_ejecutor_id){
        $q = Doctrine_Query::create()
                ->update('Correspondencia_FuncionarioUnidad cfu')
                ->set('permitido', 'FALSE')
                ->set('permitido_funcionario', '?', $funcionario_ejecutor_id.'#U')
                ->where('cfu.funcionario_id = ?', $usuario_mover_id)
                ->andWhere('cfu.status = ?', 'A');
        $q->execute();
    }
    
    public function adminFuncionarioGrupoCount($funcionario_id){
        $q = Doctrine_Query::create()
                ->select('COUNT(cfu.id) as stat')
                ->from('Correspondencia_FuncionarioUnidad cfu')
                ->where('cfu.funcionario_id = ?', $funcionario_id)
                ->andWhere('cfu.administrar = ?', TRUE)
                ->andWhere('cfu.status = ?', 'A')
                ->execute(array(), Doctrine::HYDRATE_NONE);

            return $q;
    }
    
    public function adminFuncionarioGrupo($funcionario_id){
        $q = Doctrine_Query::create()
                ->select('cfu.autorizada_unidad_id as unidad_id')
                ->from('Correspondencia_FuncionarioUnidad cfu')
                ->where('cfu.funcionario_id = ?', $funcionario_id)
                ->andWhere('cfu.administrar = ?', TRUE)
                ->andWhere('cfu.status = ?', 'A')
                ->execute(array(), Doctrine::HYDRATE_NONE);

            return $q;
    }
    
    //funcionarios por unidad para reporte de permisos de grupo de super usuario sin hidratacion
    public function allFuncionarioGrupo($unidad_id){
        $q = Doctrine_Query::create()
                ->select('cfu.id, cfu.redactar, cfu.leer, cfu.recibir, cfu.firmar, cfu.administrar')
                ->from('Correspondencia_FuncionarioUnidad cfu')
                ->where('cfu.autorizada_unidad_id = ?', $unidad_id)
                ->andWhere('cfu.status = ?', 'A')
                ->execute(array(), Doctrine::HYDRATE_NONE);

            return $q;
    }
}