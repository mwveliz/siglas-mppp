<?php


class Seguridad_CarnetTipoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Seguridad_CarnetTipo');
    }
}