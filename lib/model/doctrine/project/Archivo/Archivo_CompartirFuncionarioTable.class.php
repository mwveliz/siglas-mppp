<?php


class Archivo_CompartirFuncionarioTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_CompartirFuncionario');
    }
}