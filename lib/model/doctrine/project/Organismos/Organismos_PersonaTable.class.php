<?php


class Organismos_PersonaTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Organismos_Persona');
    }
    
    public function getNombres($string,$organismo_id=null) {
        if($organismo_id!=null) {
            $q = Doctrine_Query::create()
                    ->select('p.id, p.nombre_simple')
                    ->from('Organismos_Persona p')
                    ->where('p.nombre_simple ilike ?', '%' . $string . '%')
                    ->andWhere('p.organismo_id = ?', $organismo_id)
                    ->orderBy('p.nombre_simple ASC')
                    ->execute()
                    ->getData();
        } else {
            $q = Doctrine_Query::create()
                    ->select('p.id, p.nombre_simple')
                    ->from('Organismos_Persona p')
                    ->where('p.nombre_simple ilike ?', '%' . $string . '%')
                    ->orderBy('p.nombre_simple ASC')
                    ->execute()
                    ->getData();
        }
            
        return $q;
    }
    
    public function countPersonasPorOrganismo($organismo_id) {
        $q = Doctrine_Query::create()
                ->select('COUNT(p.id) as personas')
                ->from('Organismos_Persona p')
                ->where('p.organismo_id = ?',$organismo_id)
                ->andWhere('p.status = ?','A')
                //->useResultCache(true, 18748800, 'organismos_count_personas_'.$organismo_id)
                ->execute(array(), Doctrine::HYDRATE_NONE);
        
        return $q;
    }
}