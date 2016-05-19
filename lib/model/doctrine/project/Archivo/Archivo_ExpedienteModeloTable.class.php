<?php


class Archivo_ExpedienteModeloTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_ExpedienteModelo');
    }
}