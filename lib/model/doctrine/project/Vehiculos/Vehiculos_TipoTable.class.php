<?php


class Vehiculos_TipoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Vehiculos_Tipo');
    }
}