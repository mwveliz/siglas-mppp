<?php


class Public_IdiomaTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_Idioma');
    }
}