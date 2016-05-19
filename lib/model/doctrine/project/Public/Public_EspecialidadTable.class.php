<?php


class Public_EspecialidadTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_Especialidad');
    }
}