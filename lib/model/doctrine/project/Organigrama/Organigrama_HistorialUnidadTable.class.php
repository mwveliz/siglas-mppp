<?php


class Organigrama_HistorialUnidadTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Organigrama_HistorialUnidad');
    }
}