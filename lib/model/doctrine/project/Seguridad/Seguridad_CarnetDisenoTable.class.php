<?php


class Seguridad_CarnetDisenoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Seguridad_CarnetDiseno');
    }
    
    public function innerList() {

        $q = Doctrine_Query::create()
            ->select('cd.*')
            ->addSelect('(SELECT ud.nombre FROM Acceso_Usuario ud WHERE ud.id = cd.id_update LIMIT 1) as disenador')
            ->from('Seguridad_CarnetDiseno cd')
            ->where('cd.status = ?', 'A')
            ->orderBy('cd.id desc');

        return $q;
    }
    
    public function disenoActivoCargoCondicion($cargo_condicion_id)
    {
        $q = Doctrine_Query::create()
            ->select('cd.*')
            ->from('Seguridad_CarnetDiseno cd')
            ->where('cd.indices ILIKE ?','%cargo_condicion_'.$cargo_condicion_id.': A%')
            ->andWhere('cd.status = ?', 'A')
            ->andWhere('cd.carnet_tipo_id = ?',1000);

        return $q->execute();
    }
}