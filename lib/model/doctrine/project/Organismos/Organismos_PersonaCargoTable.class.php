<?php


class Organismos_PersonaCargoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Organismos_PersonaCargo');
    }
    
    public function getNombres($string,$persona_id=null) {

        if($persona_id!=null) {
            $q = Doctrine_Query::create()
                    ->select('pc.id, pc.nombre')
                    ->from('Organismos_PersonaCargo pc')
                    ->where('pc.nombre ilike ?', '%' . $string . '%')
                    ->andWhere('pc.persona_id = ?', $persona_id)
                    ->orderBy('pc.nombre ASC')
                    ->execute()
                    ->getData();
        } else {
            $q = Doctrine_Query::create()
                    ->select('pc.id, pc.nombre')
                    ->from('Organismos_PersonaCargo pc')
                    ->where('pc.nombre ilike ?', '%' . $string . '%')
                    ->orderBy('pc.nombre ASC')
                    ->execute()
                    ->getData();
        }
            
        return $q;
    }
    
    public function countCargosPorPersona($persona_id) {
        $q = Doctrine_Query::create()
                ->select('COUNT(c.id) as cargos')
                ->from('Organismos_PersonaCargo c')
                ->where('c.persona_id = ?',$persona_id)
                ->andWhere('c.status = ?','A')
                ->useResultCache(true, 18748800, 'organismos_count_cargos_'.$persona_id)
                ->execute();
        
        return $q;
    }
    
    public function getNombrePersonaPorCargo($cargo_id){
        $q = Doctrine_Query::create()
                ->select('oc.nombre_simple, oc.id')
                ->from('Organismos_Persona oc')
                ->innerJoin('oc.Organismos_PersonaCargo c')
                ->where('c.id = ?',$cargo_id)
                ->andWhere('c.status = ?','A')
                ->execute();
        
        return $q;
    }
}