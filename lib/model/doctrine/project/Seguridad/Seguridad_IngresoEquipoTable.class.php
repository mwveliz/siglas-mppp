<?php


class Seguridad_IngresoEquipoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Seguridad_IngresoEquipo');
    }
    
    public function equiposDeIngreso($ingreso_id) {

        $q = Doctrine_Query::create()
            ->select('ie.*, e.serial as serial, m.descripcion as marca, t.descripcion as tipo')
            ->from('Seguridad_IngresoEquipo ie')
            ->innerJoin('ie.Seguridad_Equipo e')
            ->innerJoin('e.Seguridad_Tipo t')
            ->innerJoin('e.Seguridad_Marca m')
            ->where('ie.ingreso_id = ?',$ingreso_id)
            ->orderBy('e.serial desc')
            ->execute();

        return $q;
    }
}