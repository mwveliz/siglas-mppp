<?php


class Organigrama_UnidadGeoreferenciaTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Organigrama_UnidadGeoreferencia');
    }
}