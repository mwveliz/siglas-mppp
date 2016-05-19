<?php


class Archivo_CajaModeloTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_CajaModelo');
    }
}