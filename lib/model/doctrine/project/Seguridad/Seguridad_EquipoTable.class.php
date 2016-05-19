<?php


class Seguridad_EquipoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Seguridad_Equipo');
    }
    
    public function equiposDePersona($persona_id) {

        $q = Doctrine_Query::create()
            ->select('e.id, e.serial, m.descripcion as marca, t.descripcion as tipo')
            ->from('Seguridad_Equipo e')
            ->innerJoin('e.Seguridad_Tipo t')
            ->innerJoin('e.Seguridad_Marca m')
            ->innerJoin('e.Seguridad_IngresoEquipo ie')
            ->innerJoin('ie.Seguridad_Ingreso i')
            ->where('i.persona_id = ?',$persona_id)
            ->groupBy('e.id, e.serial, m.descripcion, t.descripcion')
            ->orderBy('e.tipo_id')
            ->execute();

        return $q;
    }
}