<?php


class Rrhh_VacacionesDisfrutadasTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Rrhh_VacacionesDisfrutadas');
    }
}