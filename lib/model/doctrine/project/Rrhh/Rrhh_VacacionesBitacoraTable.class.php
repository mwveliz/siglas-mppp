<?php


class Rrhh_VacacionesBitacoraTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Rrhh_VacacionesBitacora');
    }
}