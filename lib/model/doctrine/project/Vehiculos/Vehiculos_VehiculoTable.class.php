<?php


class Vehiculos_VehiculoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Vehiculos_Vehiculo');
    }
    
    public function innerList() {

        $q = Doctrine_Query::create()
            ->select('v.*,
                      vm.kilometraje, vm.fecha, vt.nombre as tipo_nombre, vtp.nombre as tipo_uso_nombre')
            ->addSelect('(SELECT ur.nombre FROM Acceso_Usuario ur WHERE ur.id = v.id_create LIMIT 1) as registrador')
//            ->addSelect('(SELECT (f.primer_nombre | "" | f.primer_apellido) AS nombre FROM Funcionarios.Funcionario f WHERE f.id = vc.funcionario_id LIMIT 1) as conductor_nombre')
            ->from('Vehiculos_Vehiculo v')
//            ->innerJoin('vc.Vehiculos_Condicion vcc')
            ->leftJoin('v.Vehiculos_Mantenimiento vm')
            ->innerJoin('v.Vehiculos_Tipo vt')
            ->innerJoin('v.Vehiculos_TipoUso vtp')
//            ->innerJoin('vm.Vehiculos_MantenimientoTipo vmt')
            ->where('v.status = ?','A')
            ->orderBy('v.id asc');
        
//        if (!sfContext::getInstance()->getUser()->hasCredential(array('Administrador','Root','Seguridad y Recepción'),false)) {
//            
//            $session_cargos = sfContext::getInstance()->getUser()->getAttribute('session_cargos');
//            foreach ($session_cargos as $session_cargo) {
//                $unidad_ids[] = $session_cargo['unidad_id'];
//            }
//            
//            $q->andWhereIn('u.id', $unidad_ids);   
//        }
//echo $q; exit;
        return $q;
    }
    
    public function VehiculoPorGpsVehiculoId($gps_vehiculo_id)
    {
        $q = Doctrine_Query::create()
            ->select('vv.*, vgv.id')
            ->from('Vehiculos_Vehiculo vv')
            ->innerJoin('vv.Vehiculos_GpsVehiculo vgv')
            ->where('vgv.id = ?', $gps_vehiculo_id)
            ->andWhereIn('vgv.status', array('A'));

        return $q->execute();
    }
}