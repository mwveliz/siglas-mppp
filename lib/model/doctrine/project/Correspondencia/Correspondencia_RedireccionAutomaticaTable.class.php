<?php


class Correspondencia_RedireccionAutomaticaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_RedireccionAutomatica');
    }
}