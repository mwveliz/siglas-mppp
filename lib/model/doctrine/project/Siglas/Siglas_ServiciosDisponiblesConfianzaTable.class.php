<?php


class Siglas_ServiciosDisponiblesConfianzaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Siglas_ServiciosDisponiblesConfianza');
    }
}