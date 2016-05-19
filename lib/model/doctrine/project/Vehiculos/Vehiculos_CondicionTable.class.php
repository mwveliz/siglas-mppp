<?php


class Vehiculos_CondicionTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Vehiculos_Condicion');
    }
}