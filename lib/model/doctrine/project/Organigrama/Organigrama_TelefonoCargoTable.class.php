<?php


class Organigrama_TelefonoCargoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Organigrama_TelefonoCargo');
    }
}