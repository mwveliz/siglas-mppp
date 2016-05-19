<?php


class Vehiculos_ComandoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Vehiculos_Comando');
    }
}