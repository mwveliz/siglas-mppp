<?php


class Vehiculos_TrackerTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Vehiculos_Tracker');
    }
    
    public function track($gps_vehiculo_ids)
    {
        $q = Doctrine_Query::create()
            ->select('MAX(t.id) as id')
            ->from('Vehiculos_Tracker t')
            ->andWhereIn('t.gps_vehiculo_id', $gps_vehiculo_ids)
            ->groupBy('t.gps_vehiculo_id');

//        $q ->execute(array(), Doctrine::HYDRATE_NONE);
        return $q ->execute();
    }
    
    public function recorrido($ids, $desde, $hasta)
    {
        $q = Doctrine_Query::create()
            ->select('t.*')
            ->from('Vehiculos_Tracker t')
            ->whereIn('t.gps_vehiculo_id', $ids)
            ->andWhere('t.f_recibido BETWEEN ? AND ?', array($desde, $hasta))
            ->orderBy('t.id asc');
        
        return $q ->execute();
    }
    
    public function alerta($ids, $desde, $hasta)
    {
        $q = Doctrine_Query::create()
            ->select('a.*')
            ->from('Vehiculos_GpsVehiculoAlerta a')
            ->whereIn('a.gps_vehiculo_id', $ids)
            ->andWhere('a.fecha_gps BETWEEN ? AND ?', array($desde, $hasta))
            ->orderBy('a.id asc');
        
        return $q ->execute();
    }
}