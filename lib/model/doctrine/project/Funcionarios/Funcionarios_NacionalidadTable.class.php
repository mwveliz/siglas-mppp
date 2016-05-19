<?php


class Funcionarios_NacionalidadTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_Nacionalidad');
    }
}