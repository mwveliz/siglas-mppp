<?php


class Comunicaciones_MetodoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Comunicaciones_Metodo');
    }
}