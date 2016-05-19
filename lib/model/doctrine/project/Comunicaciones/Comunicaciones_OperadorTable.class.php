<?php


class Comunicaciones_OperadorTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Comunicaciones_Operador');
    }
}