<?php


class Archivo_UnidadCorrelativosTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_UnidadCorrelativos');
    }
}