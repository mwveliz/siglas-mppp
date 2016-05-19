<?php


class Organismos_OrganismoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Organismos_Organismo');
    }
    

    public function todosNoHidratados() {
        $organismos = Doctrine_Query::create()
                ->select('o.id, o.nombre, o.siglas')
                ->from('Organismos_Organismo o')
                ->where('o.status = ?','A')
                ->orderBy('o.nombre')
                ->execute(array(), Doctrine::HYDRATE_NONE);
        
        $organismos_array=array(); 
        foreach ($organismos as $organismo) {
            $organismos_array[$organismo[0]] = $organismo[1].' - '.$organismo[2];
        }  

        return $organismos_array;
    }

    public function getNombres($string) {
        $q = Doctrine_Query::create()
                ->select('o.id, concat(o.nombre, \' - \', o.siglas) as nombre')
                ->from('Organismos_Organismo o')
                ->where('o.status = ?','A')
                ->andWhere('o.nombre ilike ?', '%' . $string . '%')
                ->orWhere('o.siglas ilike ?', '%' . $string . '%')
                ->orderBy('o.nombre ASC')
                ->execute()
                ->getData();

        return $q;
    }

    public function getOrganismoEducativos(){
        $q = Doctrine_Query::CREATE()
                ->select('o.id','concat(o.nombre, \' - \', o.siglas) as nombre')
                ->from('Organismos_Organismo o')
                ->where('o.organismo_tipo_id = ?','9')
                ->andWhere('o.status = ?','A')
                ->orderBy('o.nombre ASC');
        return $q->execute();
    }
    public function getNombresSiglas($string) {
        $q = Doctrine_Query::create()
                ->select('o.id, concat(o.nombre, \' - \', o.siglas) as nombre')
                ->from('Organismos_Organismo o')
                ->where('o.status = ?','A')
                ->andWhere('o.nombre ilike ?', '%' . $string . '%')
                ->orWhere('o.siglas ilike ?', '%' . $string . '%')
                ->orderBy('o.nombre ASC')
                ->limit(10)
                ->useResultCache(true, 3600, 'organismos_string_'.$string);
                
        return $q->execute();
    }
    
    public function arrayTodosNoHidratados() {
        $organismos = Doctrine_Query::create()
                ->select('o.id, o.nombre, o.siglas')
                ->from('Organismos_Organismo o')
                ->where('o.status = ?','A')
                ->execute(array(), Doctrine::HYDRATE_NONE);

        return $organismos;
    }
    
    public function todosPorId($ids) {
        $organismos = Doctrine_Query::create()
                ->select('o.*')
                ->from('Organismos_Organismo o')
                ->where('o.status = ?','A')
                ->andWhereIn('o.id',$ids)
                ->orderBy('o.nombre')
                ->execute();

        return $organismos;
    }
}