<?php


class Organigrama_CargoGradoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Organigrama_CargoGrado');
    }
    
    public function cargoGradosDeTipos($tipo_id)
    {
        $q = Doctrine_Query::create()
            ->select('cg.id, cg.nombre')
            ->from('Organigrama_CargoGrado cg')
            ->innerJoin('cg.Organigrama_CargoGradoTipo cgt')
            ->where('cgt.cargo_tipo_id = ?', $tipo_id)
            ->orderBy('cg.nombre')
            ->execute();

        return $q;
    }
}