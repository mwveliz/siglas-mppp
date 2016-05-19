<?php


class Rrhh_PermisosTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Rrhh_Permisos');
    }
    
    public function innerListPersonal() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('p.*')
            ->from('Rrhh_Permisos p')
            ->where('p.funcionario_id = ?', sfContext::getInstance()->getUser()->getAttribute('funcionario_id'))
            ->andWhereNotIn('p.status', array('E'))
            ->orderBy('p.id');

        return $q;
    }
    
    public function activos($funcionario_id)
    {
        $q = Doctrine_Query::create()
            ->select('p.*')
            ->from('Rrhh_Permisos p')
            ->where('p.funcionario_id = ?', $funcionario_id)
            ->andWhereNotIn('p.status', array('E'))
            ->orderBy('p.id')
            ->execute();

        return $q;
    }
    
    public function permisosPersonal($funcionario_id) // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('p.*')
            ->from('Rrhh_Permisos p')
            ->where('p.funcionario_id = ?', $funcionario_id)
            ->andWhereNotIn('p.status', array('E'))
            ->orderBy('p.id desc')
            ->execute();

        return $q;
    }
}