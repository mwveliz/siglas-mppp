<?php


class Correspondencia_UltimaVistaTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_UltimaVista');
    }
}