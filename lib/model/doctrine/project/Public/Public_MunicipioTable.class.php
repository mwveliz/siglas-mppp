<?php


class Public_MunicipioTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_Municipio');
    }
}