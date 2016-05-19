<?php


class Public_CarreraUniversitariaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_CarreraUniversitaria');
    }
}