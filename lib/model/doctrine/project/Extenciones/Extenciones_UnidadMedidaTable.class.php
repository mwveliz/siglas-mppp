<?php


class Extenciones_UnidadMedidaTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Extenciones_UnidadMedida');
    }
}