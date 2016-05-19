<?php


class Public_ParroquiaTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_Parroquia');
    }
}