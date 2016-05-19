<?php


class Public_TipoEducacionAdicionalTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_TipoEducacionAdicional');
    }
}