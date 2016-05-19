<?php


class Funcionarios_FotoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_Foto');
    }
}