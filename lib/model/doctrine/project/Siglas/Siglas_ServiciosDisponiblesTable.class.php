<?php


class Siglas_ServiciosDisponiblesTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Siglas_ServiciosDisponibles');
    }
    
    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('sd.*')
            ->from('Siglas_ServiciosDisponibles sd')
            ->orderBy('sd.funcion');

        return $q;
    }
}