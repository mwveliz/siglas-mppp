<?php


class Organigrama_CargoTipoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Organigrama_CargoTipo');
    }
    
    public function ordenado()
    {
        return $this->createQuery('c')
                    ->orderBy('c.nombre asc')->execute();
    }
    
    public function filtrarCondicion($condicion_id)
    {
        $q = Doctrine_Query::create()
            ->select('ct.*')
            ->from('Organigrama_CargoTipo ct')
            ->where('ct.cargo_condicion_id = ?',$condicion_id)
            ->orderby('ct.nombre');

        return $q->execute();
    }
}

