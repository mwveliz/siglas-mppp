<?php


class Siglas_ActualizacionSqlTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Siglas_ActualizacionSql');
    }
}