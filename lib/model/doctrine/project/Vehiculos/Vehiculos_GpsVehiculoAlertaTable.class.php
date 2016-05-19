<?php


class Vehiculos_GpsVehiculoAlertaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Vehiculos_GpsVehiculoAlerta');
    }
}