<?php


class Acceso_ModuloTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Acceso_Modulo');
    }
}