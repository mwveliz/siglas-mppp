<?php


class Seguridad_TipoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Seguridad_Tipo');
    }
}