<?php


class Public_NivelAcademicoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_NivelAcademico');
    }
}