<?php


class Rrhh_ConfiguracionesTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Rrhh_Configuraciones');
    }
}