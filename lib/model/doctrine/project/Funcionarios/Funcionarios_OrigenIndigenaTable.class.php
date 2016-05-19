<?php


class Funcionarios_OrigenIndigenaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_OrigenIndigena');
    }
}