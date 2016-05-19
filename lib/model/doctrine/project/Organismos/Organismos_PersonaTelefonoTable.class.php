<?php


class Organismos_PersonaTelefonoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Organismos_PersonaTelefono');
    }
}