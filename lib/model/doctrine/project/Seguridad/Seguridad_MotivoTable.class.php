<?php


class Seguridad_MotivoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Seguridad_Motivo');
    }
}