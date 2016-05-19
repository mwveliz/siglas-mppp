<?php


class Public_DocumentosTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_Documentos');
    }
}