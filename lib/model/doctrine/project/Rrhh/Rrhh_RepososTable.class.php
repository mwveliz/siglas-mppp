<?php


class Rrhh_RepososTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Rrhh_Reposos');
    }
    
    public function innerListPersonal() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('r.*')
            ->from('Rrhh_Reposos r')
            ->where('r.funcionario_id = ?', sfContext::getInstance()->getUser()->getAttribute('funcionario_id'))
            ->andWhereNotIn('r.status', array('E'))
            ->orderBy('r.id');

        return $q;
    }
    
    public function activos($funcionario_id)
    {
        $q = Doctrine_Query::create()
            ->select('p.*')
            ->from('Rrhh_Reposos p')
            ->where('p.funcionario_id = ?', $funcionario_id)
            ->andWhereNotIn('p.status', array('E'))
            ->orderBy('p.id')
            ->execute();

        return $q;
    }
    
    public function repososPersonal($funcionario_id) // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('r.*')
            ->from('Rrhh_Reposos r')
            ->where('r.funcionario_id = ?', $funcionario_id)
            ->andWhereNotIn('r.status', array('E'))
            ->orderBy('r.id desc')
            ->execute();

        return $q;
    }
}