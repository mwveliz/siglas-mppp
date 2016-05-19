<?php


class Public_EnfermedadTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_Enfermedad');
    }
}