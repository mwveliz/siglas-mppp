<?php


class Funcionarios_FuncionarioEnfermedadTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_FuncionarioEnfermedad');
    }
}