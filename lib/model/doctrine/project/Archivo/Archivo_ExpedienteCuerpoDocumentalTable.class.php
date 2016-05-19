<?php


class Archivo_ExpedienteCuerpoDocumentalTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_ExpedienteCuerpoDocumental');
    }
}