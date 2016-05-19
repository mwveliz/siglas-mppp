<?php


class Acceso_AuditoriaClaveTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Acceso_AuditoriaClave');
    }
}