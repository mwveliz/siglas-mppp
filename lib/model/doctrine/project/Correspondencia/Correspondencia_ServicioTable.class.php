<?php


class Correspondencia_ServicioTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_Servicio');
    }
}