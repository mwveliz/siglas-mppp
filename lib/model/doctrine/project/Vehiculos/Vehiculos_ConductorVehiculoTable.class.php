<?php


class Vehiculos_ConductorVehiculoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Vehiculos_ConductorVehiculo');
    }
    
    public function innerList()
    {
        $q = Doctrine_Query::create()
            ->select('vcv.*, vcc.nombre as condicion, concat(ff.primer_nombre, \' \', ff.primer_apellido) as nombre, ffc.cargo_id')
            ->addSelect('(SELECT fc.cargo_id FROM Funcionarios_FuncionarioCargo fc WHERE fc.funcionario_id = vcv.funcionario_id LIMIT 1) as cargo_id')
            ->from('Vehiculos_ConductorVehiculo vcv')
            ->innerJoin('vcv.Vehiculos_Condicion vcc')
            ->innerJoin('vcv.Funcionarios_Funcionario ff')
            ->where('vcv.vehiculo_id = ?', sfContext::getInstance()->getUser()->getAttribute('vehiculo_id'));

        return $q;
    }
    
    public function conductorPorVehiculo($vehiculo_id)
    {
        $q = Doctrine_Query::create()
            ->select('vcv.*, vcc.nombre as condicion, ff.primer_nombre as nombre, ff.primer_apellido as apellido, ffc.cargo_id')
            ->addSelect('(SELECT fc.cargo_id FROM Funcionarios_FuncionarioCargo fc WHERE fc.funcionario_id = vcv.funcionario_id LIMIT 1) as cargo_id')
            ->from('Vehiculos_ConductorVehiculo vcv')
            ->innerJoin('vcv.Vehiculos_Condicion vcc')
            ->innerJoin('vcv.Funcionarios_Funcionario ff')
            ->where('vcv.vehiculo_id = ?', $vehiculo_id)
            ->andWhereIn('vcv.status', array('A'));

        return $q->execute();
    }
    
    public function conductoresAct()
    {
        $q = Doctrine_Query::create()
            ->select('vc.*, concat(ff.primer_nombre, \' \', ff.primer_apellido) as nombre')
            ->from('Vehiculos_Conductor vc')
            ->innerJoin('vc.Funcionarios_Funcionario ff')
            ->andWhereIn('vc.status', array('A'));

        return $q->execute();
    }
}