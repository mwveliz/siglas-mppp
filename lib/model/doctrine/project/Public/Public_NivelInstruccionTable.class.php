<?php


class Public_NivelInstruccionTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_NivelInstruccion');
    }
}