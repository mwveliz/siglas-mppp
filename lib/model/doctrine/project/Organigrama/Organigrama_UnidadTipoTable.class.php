<?php


class Organigrama_UnidadTipoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Organigrama_UnidadTipo');
    }
    
    public function todasOrdenadas()
    {
        $q = Doctrine_Core::getTable('Organigrama_UnidadTipo')
            ->createQuery('ut')
            ->orderby('ut.nombre');

        return $q;
    }
}