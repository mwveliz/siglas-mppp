<?php


class Funcionarios_CuidadoFamiliarTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_CuidadoFamiliar');
    }
}