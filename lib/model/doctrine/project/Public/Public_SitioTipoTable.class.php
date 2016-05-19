<?php


class Public_SitioTipoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_SitioTipo');
    }
}