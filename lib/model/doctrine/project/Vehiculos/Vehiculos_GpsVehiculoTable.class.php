<?php


class Vehiculos_GpsVehiculoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Vehiculos_GpsVehiculo');
    }
    
    public function innerList()
    {
        $q = Doctrine_Query::create()
            ->select('vgv.*, vg.marca as marca, vg.modelo as modelo, co.nombre as operador')
            ->addSelect('(SELECT ur.nombre FROM Acceso_Usuario ur WHERE ur.id = vgv.id_create LIMIT 1) as asignador')
            ->from('Vehiculos_GpsVehiculo vgv')
            ->innerJoin('vgv.Vehiculos_Gps vg')
            ->innerJoin('vgv.Comunicaciones_Operador co')
            ->where('vgv.vehiculo_id = ?', sfContext::getInstance()->getUser()->getAttribute('vehiculo_id'))
            ->andWhereIn('vgv.status', array('A'));

        return $q;
    }
    
    public function gpsPorVehiculo($vehiculo_id)
    {
        $q = Doctrine_Query::create()
            ->select('vgv.id, vg.marca as marca, vg.modelo as modelo, co.nombre as operador')
            ->from('Vehiculos_GpsVehiculo vgv')
            ->innerJoin('vgv.Vehiculos_Gps vg')
            ->innerJoin('vgv.Comunicaciones_Operador co')
            ->where('vgv.vehiculo_id = ?', $vehiculo_id)
            ->andWhereIn('vgv.status', array('A'));

        return $q->execute();
    }
    
    public function rastreables()
    {
        $q = Doctrine_Query::create()
            ->select('vv.*, vgv.id as gps_vehiculo_id, vgv.sim as sim')
            ->from('Vehiculos_Vehiculo vv')
            ->innerJoin('vv.Vehiculos_GpsVehiculo vgv')
            ->where('vv.status = ?', 'A')
            ->andWhere('vgv.status = ?', 'A');

        return $q->execute();
    }
}