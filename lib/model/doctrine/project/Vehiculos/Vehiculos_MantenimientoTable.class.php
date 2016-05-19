<?php


class Vehiculos_MantenimientoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Vehiculos_Mantenimiento');
    }
    
    public function innerList()
    {
        $q = Doctrine_Query::create()
            ->select('vm.*, vmt.nombre as nombre, vmt.icono as icono')
            ->addSelect('(SELECT ur.nombre FROM Acceso_Usuario ur WHERE ur.id = vm.id_create LIMIT 1) as registrador')
            ->from('Vehiculos_Mantenimiento vm')
            ->innerJoin('vm.Vehiculos_MantenimientoTipo vmt')
            ->where('vm.vehiculo_id = ?', sfContext::getInstance()->getUser()->getAttribute('vehiculo_id'))
            ->andWhereIn('vm.status', array('A', 'C'))
            ->orderBy('vm.id desc');

        return $q;
    }
    
    public function servicioPorVehiculo($vehiculo_id)
    {
        $q = Doctrine_Query::create()
            ->select('vm.*, vmt.nombre as nombre, vmt.icono as icono, vv.kilometraje_actual as kilometraje_actual')
            ->from('Vehiculos_Mantenimiento vm')
            ->innerJoin('vm.Vehiculos_MantenimientoTipo vmt')
            ->innerJoin('vm.Vehiculos_Vehiculo vv')
            ->where('vm.vehiculo_id = ?', $vehiculo_id)
            ->andWhereIn('vm.status', array('A', 'C'));

        return $q->execute();
    }
}