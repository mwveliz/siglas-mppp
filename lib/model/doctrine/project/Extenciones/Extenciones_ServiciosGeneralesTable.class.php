<?php


class Extenciones_ServiciosGeneralesTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Extenciones_ServiciosGenerales');
    }
}