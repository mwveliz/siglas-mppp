<?php


class Vehiculos_TipoUsoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Vehiculos_TipoUso');
    }
}