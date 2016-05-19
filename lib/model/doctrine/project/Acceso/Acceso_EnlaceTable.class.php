<?php


class Acceso_EnlaceTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Acceso_Enlace');
    }
}