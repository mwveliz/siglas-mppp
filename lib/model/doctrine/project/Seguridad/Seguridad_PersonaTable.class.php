<?php


class Seguridad_PersonaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Seguridad_Persona');
    }
    
    public function getDataWhere($string){
        $q = Doctrine_Query::create()
                ->select('n.id, n.primer_nombre,n.segundo_nombre, n.primer_apellido, n.segundo_apellido')
                ->from('Seguridad_Persona n')
                ->where('n.primer_nombre ILIKE ?', '%'.$string.'%')
                ->orWhere('n.segundo_nombre ILIKE ?', '%'.$string.'%')
                ->orWhere('n.primer_apellido ILIKE ?', '%'.$string.'%')
                ->orWhere('n.segundo_apellido ILIKE ?', '%'.$string.'%')
                ->execute()
                ->getData();
        return $q;
    }
    
    public function personasPreingreso($preingreso_id){
        $q = Doctrine_Query::create()
                ->select('p.*, i.status as status, i.f_ingreso as f_ingreso, i.f_egreso as f_egreso')
                ->addSelect('(SELECT ur.nombre FROM Acceso_Usuario ur WHERE ur.id = i.registrador_id LIMIT 1) as registrador')
                ->addSelect('(SELECT ud.nombre FROM Acceso_Usuario ud WHERE ud.id = i.despachador_id LIMIT 1) as despachador')
                ->from('Seguridad_Persona p')
                ->innerJoin('p.Seguridad_Ingreso i')
                ->where('i.preingreso_id = ?', $preingreso_id)
                ->execute();
        return $q;
    }
}