<?php


class Correspondencia_FuncionarioCorrelativoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_FuncionarioCorrelativo');
    }
}