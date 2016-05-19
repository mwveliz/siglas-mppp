<?php


class Public_ParentescoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_Parentesco');
    }
}