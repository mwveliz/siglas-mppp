<?php


class Vehiculos_MantenimientoTipoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Vehiculos_MantenimientoTipo');
    }
}