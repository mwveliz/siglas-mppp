<?php


class Public_TipoCuentaTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_TipoCuenta');
    }
}