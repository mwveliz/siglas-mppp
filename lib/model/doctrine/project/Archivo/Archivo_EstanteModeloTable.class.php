<?php


class Archivo_EstanteModeloTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_EstanteModelo');
    }
}