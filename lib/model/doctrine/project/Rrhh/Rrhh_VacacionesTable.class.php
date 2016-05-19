<?php


class Rrhh_VacacionesTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Rrhh_Vacaciones');
    }
    
    public function innerListPersonal() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('v.*')
            ->addSelect('(SELECT COUNT(vd.id) AS solicitudes FROM Rrhh_VacacionesDisfrutadas vd WHERE vd.vacaciones_id = v.id LIMIT 1) as solicitudes')
            ->from('Rrhh_Vacaciones v')
            ->where('v.funcionario_id = ?', sfContext::getInstance()->getUser()->getAttribute('funcionario_id'))
            ->orderBy('v.f_cumplimiento desc');

        return $q;
    }
    
    public function innerListGlobal() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('f.*, u.nombre as unidad, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre, f.sexo as sexo')  
//            ->addSelect('(SELECT SUM(v2.dias_disfrute_pendientes) FROM Rrhh_Vacaciones v2 WHERE v2.funcionario_id = f.id) as dias_disfrute_pendientes')
            ->from('Funcionarios_Funcionario f')
            ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
            ->leftjoin('fc.Organigrama_Cargo c')
            ->innerjoin('c.Organigrama_UnidadFuncional u')
            ->leftjoin('c.Organigrama_CargoTipo ct')
            ->where('fc.status = ?', 'A')
            ->andWhere('u.id = ?', sfContext::getInstance()->getUser()->getAttribute('funcionario_unidad_id'))
            ->orderBy('u.nombre, f.primer_nombre, f.segundo_nombre, f.primer_apellido, f.segundo_apellido');
        
        return $q;
    }
    
    public function vacacionesPersonal($funcionario_id) // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('v.*')
            ->addSelect('(SELECT COUNT(vd.id) AS solicitudes FROM Rrhh_VacacionesDisfrutadas vd WHERE vd.vacaciones_id = v.id LIMIT 1) as solicitudes')
            ->from('Rrhh_Vacaciones v')
            ->where('v.funcionario_id = ?', $funcionario_id)
            ->orderBy('v.f_cumplimiento desc')
            ->execute();

        return $q;
    }
    
    public function ultimoPeriodo($funcionario_id)
    {
        $q = Doctrine_Query::create()
            ->select('v.id')
            ->from('Rrhh_Vacaciones v')
            ->where("v.funcionario_id = ?", $funcionario_id)
            ->orderBy('v.id DESC')
            ->limit(1)
            ->execute(array(), Doctrine::HYDRATE_NONE);

        return $q;
    }
}