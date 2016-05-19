<?php


class Inventario_ArticuloEgresoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Inventario_ArticuloEgreso');
    }
    
    public function innerListDespachoArticulos() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('ae.*')
            ->from('Inventario_ArticuloEgreso ae')
            ->where('ae.articulo_id = ?',sfContext::getInstance()->getUser()->getAttribute('articulo_id'))
            ->orderBy('ae.id desc');

        return $q;
    }
}