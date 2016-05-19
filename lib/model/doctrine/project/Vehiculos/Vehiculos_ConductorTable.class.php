<?php


class Vehiculos_ConductorTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Vehiculos_Conductor');
    }
    
    public function innerList()
    {
        $q = Doctrine_Query::create()
            ->select('vc.*, concat(ff.primer_nombre, \' \', ff.primer_apellido) as nombre_completo, oct.nombre as cargo_nombre, oc.id as cargo_id')
            ->from('Vehiculos_Conductor vc')
            ->innerJoin('vc.Funcionarios_Funcionario ff')
            ->innerJoin('ff.Funcionarios_FuncionarioCargo fc')
            ->innerJoin('fc.Organigrama_Cargo oc')
            ->innerJoin('oc.Organigrama_CargoTipo oct')
            ->WhereIn('vc.status', array('A'));

        return $q;
    }
}