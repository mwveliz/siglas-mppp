<?php


class Correspondencia_PlantillaFuncionarioTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_PlantillaFuncionario');
    }
}