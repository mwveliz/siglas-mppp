<?php


class Extenciones_MaterialClasificacionTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Extenciones_MaterialClasificacion');
    }
}