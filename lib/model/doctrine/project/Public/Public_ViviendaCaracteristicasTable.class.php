<?php


class Public_ViviendaCaracteristicasTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_ViviendaCaracteristicas');
    }
}