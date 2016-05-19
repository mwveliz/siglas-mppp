<?php


class Inventario_UnidadMedidaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Inventario_UnidadMedida');
    }
}