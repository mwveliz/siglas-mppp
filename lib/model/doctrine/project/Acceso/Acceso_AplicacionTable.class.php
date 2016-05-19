<?php


class Acceso_AplicacionTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Acceso_Aplicacion');
    }
}