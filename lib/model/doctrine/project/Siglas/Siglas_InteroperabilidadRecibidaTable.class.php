<?php


class Siglas_InteroperabilidadRecibidaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Siglas_InteroperabilidadRecibida');
    }
}