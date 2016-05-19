<?php


class Funcionarios_CuentaBancariaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_CuentaBancaria');
    }
}