<?php


class Archivo_FuncionarioUnidadTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_FuncionarioUnidad');
    }
    
    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
            $q = Doctrine_Query::create()
                ->select('afu.id, concat(f.primer_nombre, \' \', f.primer_apellido) as persona, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre, f.sexo as sexo')
                ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = afu.id_update LIMIT 1) as user_update')
                ->addSelect('(SELECT un.nombre FROM Organigrama_Unidad un WHERE un.id = afu.dependencia_unidad_id LIMIT 1) as unombre')
                ->from('Archivo_FuncionarioUnidad afu')
                ->innerjoin('afu.Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->where('afu.autorizada_unidad_id = ?', sfContext::getInstance()->getUser()->getAttribute('funcionario_unidad_id'))
                ->andWhere('afu.status = ?','A')
                ->andWhere('afu.deleted_at is null')
                ->orderBy('f.primer_nombre, f.primer_apellido');

            return $q;
    }
    
    public function funcionarioAutorizadoArchivar($funcionario_id)
    {
            $q = Doctrine_Query::create()
                ->select('afu.*')
                ->from('Archivo_FuncionarioUnidad afu')
                ->Where('afu.funcionario_id = ?', $funcionario_id)
                ->andWhere('afu.archivar = ?', 't')
                ->andWhere('afu.status = ?', 'A')
                ->execute();

            return $q;
    }
    
    public function funcionarioAutorizadoLeer($funcionario_id)
    {
            $q = Doctrine_Query::create()
                ->select('afu.*')
                ->from('Archivo_FuncionarioUnidad afu')
                ->Where('afu.funcionario_id = ?', $funcionario_id)
                ->andWhere('afu.leer = ?', 't')
                ->andWhere('afu.status = ?', 'A')
                ->execute();

            return $q;
    }
    
    public function funcionarioAutorizadoAnular($funcionario_id)
    {
            $q = Doctrine_Query::create()
                ->select('afu.*')
                ->from('Archivo_FuncionarioUnidad afu')
                ->Where('afu.funcionario_id = ?', $funcionario_id)
                ->andWhere('afu.anular = ?', 't')
                ->andWhere('afu.status = ?', 'A')
                ->execute();

            return $q;
    }
    
    public function esperaValidacionGrupo($grupo_id, $funcionario_id){
        $q = Doctrine_Query::create()
                ->update('Archivo_FuncionarioUnidad cfu')
                ->set('permitido', 'FALSE')
                ->set('permitido_funcionario', '?', $funcionario_id.'#G')
                ->where('cfu.id = ?', $grupo_id);
        $q->execute();
    }
    
    public function esperaValidacionUnidad($usuario_mover_id, $nueva_unidad_id, $funcionario_ejecutor_id){
        $q = Doctrine_Query::create()
                ->update('Archivo_FuncionarioUnidad cfu')
                ->set('permitido', 'FALSE')
                ->set('permitido_funcionario', '?', $funcionario_ejecutor_id.'#U')
                ->where('cfu.funcionario_id = ?', $usuario_mover_id);
        $q->execute();
    } 
    
    public function PermisosUnidadFuncionario($unidad_id, $funcionario_id){
        $q = Doctrine_Query::create()
                ->select('u.autorizada_unidad_id, u.archivar, u.leer, u.prestar, u.anular')
                ->from('Archivo_FuncionarioUnidad u')
                ->Where('u.autorizada_unidad_id = ?', $unidad_id)
                ->andWhere('u.funcionario_id = ?', $funcionario_id)
                ->andWhere('u.status = ?', 'A')
                ->execute();
        return $q;
    }
    
    public function grupoUnidad($unidad_id) 
    {
            $q = Doctrine_Query::create()
                ->select('afu.id, concat(f.primer_nombre, \' \', f.primer_apellido) as persona, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre, f.sexo as sexo')
                ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = afu.id_update LIMIT 1) as user_update')
                ->addSelect('(SELECT un.nombre FROM Organigrama_Unidad un WHERE un.id = afu.dependencia_unidad_id LIMIT 1) as unombre')
                ->from('Archivo_FuncionarioUnidad afu')
                ->innerjoin('afu.Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->where('afu.autorizada_unidad_id = ?', $unidad_id)
                ->andWhere('c.unidad_funcional_id = afu.dependencia_unidad_id')
                ->andWhere('afu.deleted_at is null')
                ->andWhere('afu.status = ?','A')
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
                            FROM Archivo_FuncionarioUnidad cfu 
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
                ->from('Archivo_FuncionarioUnidad cfu')
                ->where('cfu.funcionario_id = ?', $funcionario_id)
                ->andWhere('cfu.autorizada_unidad_id = ?', $unidad_id)
                ->orderBy('cfu.id desc')
                ->execute();

            return $q;
    }
    
    public function adminFuncionarioGrupoCount($funcionario_id){
        $q = Doctrine_Query::create()
                ->select('COUNT(afu.id) as stat')
                ->from('Archivo_FuncionarioUnidad afu')
                ->where('afu.funcionario_id = ?', $funcionario_id)
                ->andWhere('afu.administrar = ?', TRUE)
                ->andWhere('afu.status = ?','A')
                ->execute(array(), Doctrine::HYDRATE_NONE);

            return $q;
    }
    
    public function adminFuncionarioGrupo($funcionario_id){
        $q = Doctrine_Query::create()
                ->select('afu.autorizada_unidad_id as unidad_id')
                ->from('Archivo_FuncionarioUnidad afu')
                ->where('afu.funcionario_id = ?', $funcionario_id)
                ->andWhere('afu.administrar = ?', TRUE)
                ->andWhere('afu.status = ?','A')
                ->execute(array(), Doctrine::HYDRATE_NONE);

            return $q;
    }
    
    //funcionarios por unidad para reporte de permisos de grupo de super usuario sin hidratacion
    public function allFuncionarioGrupo($unidad_id){
        $q = Doctrine_Query::create()
                ->select('cfu.id, cfu.archivar, cfu.leer, cfu.prestar, cfu.anular, cfu.administrar')
                ->from('Archivo_FuncionarioUnidad cfu')
                ->where('cfu.autorizada_unidad_id = ?', $unidad_id)
                ->andWhere('cfu.status = ?', 'A')
                ->execute(array(), Doctrine::HYDRATE_NONE);

            return $q;
    }
}