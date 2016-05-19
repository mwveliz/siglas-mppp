<?php


class Inventario_ArticuloIngresoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Inventario_ArticuloIngreso');
    }
    
    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('ai.*')
            ->from('Inventario_ArticuloIngreso ai')
            ->orderBy('ai.f_ingreso desc');

        return $q;
    }
}