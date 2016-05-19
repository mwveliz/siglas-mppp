<?php


class Inventario_AlmacenTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Inventario_Almacen');
    }
}