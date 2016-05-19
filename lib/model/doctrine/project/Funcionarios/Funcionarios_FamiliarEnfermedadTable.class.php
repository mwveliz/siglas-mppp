<?php


class Funcionarios_FamiliarEnfermedadTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_FamiliarEnfermedad');
    }
}