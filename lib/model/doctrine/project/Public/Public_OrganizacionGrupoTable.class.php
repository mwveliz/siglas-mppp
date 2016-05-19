<?php


class Public_OrganizacionGrupoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_OrganizacionGrupo');
    }
}