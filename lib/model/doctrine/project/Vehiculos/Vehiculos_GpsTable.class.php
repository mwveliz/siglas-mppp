<?php


class Vehiculos_GpsTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Vehiculos_Gps');
    }
}