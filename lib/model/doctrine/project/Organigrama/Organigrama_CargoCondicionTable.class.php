<?php


class Organigrama_CargoCondicionTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Organigrama_CargoCondicion');
    }
    
    public function ordenado()
    {
        return $this->createQuery('c')
                    ->orderBy('c.nombre asc')->execute();
    }
}