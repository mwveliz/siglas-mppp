<?php


class Comunicaciones_FuncionarioTareaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Comunicaciones_FuncionarioTarea');
    }
}