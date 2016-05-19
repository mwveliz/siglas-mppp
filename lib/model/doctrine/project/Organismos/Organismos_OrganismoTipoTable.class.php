<?php


class Organismos_OrganismoTipoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Organismos_OrganismoTipo');
    }
}