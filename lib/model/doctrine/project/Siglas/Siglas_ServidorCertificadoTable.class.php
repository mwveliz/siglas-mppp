<?php


class Siglas_ServidorCertificadoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Siglas_ServidorCertificado');
    }
}