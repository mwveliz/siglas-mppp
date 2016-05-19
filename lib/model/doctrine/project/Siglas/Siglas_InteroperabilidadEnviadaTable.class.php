<?php


class Siglas_InteroperabilidadEnviadaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Siglas_InteroperabilidadEnviada');
    }
}