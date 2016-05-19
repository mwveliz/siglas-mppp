<?php


class Organigrama_UnidadTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Organigrama_Unidad');
    }

    public function innerList()
    {
        $q = Doctrine_Core::getTable('Organigrama_Unidad')
            ->createQuery('u')
            ->where('u.status = ?', 'A')
            ->orderby('u.orden_automatico');

        return $q;
    }

    public function buscarUnidadNull()
    {
        $q = Doctrine_Query::create()
            ->select('u.*')
            ->from('Organigrama_Unidad u')
            ->where('u.status = ?', 'A')
            ->andWhere('u.padre_id is null')
            ->orderby('u.orden_preferencial, u.nombre');
            
//            ->useResultCache(true, 3600, 'cache_unidad_nulos');

        return $q->execute();
    }
    
    public function buscarUnidadInicial($unidad_inicial_ids)
    {
        $q = Doctrine_Query::create()
            ->select('u.*')
            ->from('Organigrama_Unidad u')
            ->where('u.status = ?', 'A')
            ->andWhereIn('u.id', $unidad_inicial_ids)
            ->orderby('u.orden_preferencial, u.nombre');
//            ->useResultCache(true, 3600, 'cache_unidad_inicial');

        return $q->execute();
    }

    public function buscarUnidadHijos($padre_id)
    {
        $q = Doctrine_Query::create()
            ->select('u.*')
            ->from('Organigrama_Unidad u')
            ->where('u.status = ?', 'A')
            ->andWhere('u.padre_id = ?',$padre_id)
            ->orderby('u.orden_preferencial, u.nombre');

//            ->useResultCache(true, 3600, 'cache_unidad_hijos_'.$padre_id);

        return $q->execute();
    }

    public function cadenaComboUnidad($cadena = NULL, $padre_id = 0,$tabular = 0, $unidad_inicial_ids = NULL)
    {
        $tabular_cadena = "";
        for($i=0;$i<$tabular;$i++)
            $tabular_cadena.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

        if($padre_id == 0) {
            if($unidad_inicial_ids==NULL)
                $p=$this->buscarUnidadNull();
            else
                $p=$this->buscarUnidadInicial($unidad_inicial_ids);
        }
        else
            $p=$this->buscarUnidadHijos($padre_id);

        $can=count($p);
        $opciones=array();
        for($i=0;$i<$can;$i++)
        {            
            $cadena.=$tabular_cadena.$p[$i]['nombre'].'.##.'.$p[$i]['id'].'&&'.$p[$i]['unidad_tipo_id'].'&&'.$p[$i]['dir_piso'].'.##.';

            $tabular++;
            $cadena=$this->cadenaComboUnidad($cadena, $p[$i]['id'],$tabular);
            $tabular--;
        }

        return $cadena;
    }

    public function combounidad($unidad_tipo = FALSE, $unidad_inicial_ids = NULL, $pisos = FALSE)
    {
        $cadena=$this->cadenaComboUnidad(NULL, NULL, NULL, $unidad_inicial_ids);

        $cadena_arreglo = explode( ".##.", $cadena);

        $opciones[''] = '';

        for($i=0;$i<count($cadena_arreglo)-1;$i+=2)
        {
            list($unidad_id,$unidad_tipo_id,$piso) = explode('&&', $cadena_arreglo[$i+1]);
            
            if($unidad_tipo == FALSE && $pisos == FALSE){
                $id = $unidad_id;
            } else if ($unidad_tipo == TRUE && $pisos == FALSE) {
                $id = $unidad_id.'&&'.$unidad_tipo_id;
            } else if ($unidad_tipo == FALSE && $pisos == TRUE) {
                $id = $unidad_id.'&&'.$piso;
            } else {
                $id = $cadena_arreglo[$i+1];
            }
            
            $opciones[$id]=$cadena_arreglo[$i];
        }

        //$opciones = array_unique($opciones);
        return $opciones;
    }

    public function unidadTipo() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('u.*')
            ->from('Organigrama_Unidad u')
            ->where('u.unidad_tipo_id = 7')
            ->orderBy('u.nombre');

        return $q;
    }
    
    public function unidades($unidades_ids) // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('u.*')
            ->from('Organigrama_Unidad u')
            ->whereIn('u.id',$unidades_ids)
            ->orderBy('u.nombre')
            ->execute();

        return $q;
    }
    
    public function getPisos() // 
    {
        $q = Doctrine_Query::create()
            ->select('DISTINCT u.dir_piso as id,u.dir_piso as nombre')
            ->from('Organigrama_Unidad u')
            ->orderBy('u.dir_piso')
            ->useResultCache(true, 3600, 'cache_unidad_pisos');

        return $q->execute();
    }
    
    public static function getUnidadByPiso()
    {
        $unidades = Doctrine_Query::create()
            ->select('u.id, u.dir_piso, u.nombre')
            ->from('Organigrama_Unidad u')
            ->orderBy('u.dir_piso')
            ->execute(array(), Doctrine::HYDRATE_NONE);
        $pisos = Doctrine_Query::create()
            ->select('DISTINCT u.dir_piso as id,u.dir_piso as nombre')
            ->from('Organigrama_Unidad u')
            ->orderBy('u.dir_piso')
            ->execute(array(), Doctrine::HYDRATE_NONE);
        
        $arr = array();$arr_unidad = array();
        
        foreach($pisos as $piso){
            foreach($unidades as $unidad){
                if($piso[0] == $unidad[1])
                    $arr_unidad = $arr_unidad + array($unidad[0] => $unidad[1].' - '.$unidad[2]);    
            }
            $arr += array($piso[0]=>$arr_unidad);
            $arr_unidad=array();
        }            
            
        //print_r($arr);exit();
        return $arr;
    }
    
    public function datosCargoUnidad($funcionario_cargo_id) {
        $q = Doctrine_Query::create()
            ->select('c.id as cargo_id, u.nombre as unidad_nombre, ct.nombre as cargo_nombre')
            ->from('Organigrama_Cargo c')
            ->innerJoin('c.Organigrama_UnidadFuncional u')
            ->innerJoin('c.Organigrama_CargoTipo ct')
            ->where('c.id = ?', $funcionario_cargo_id)
            ->orderBy('ct.nombre')
            ->execute();

        return $q;
    }
    
    public function traerPrincipales()
    {
        $q = Doctrine_Query::create()
            ->select('u.*')
            ->from('Organigrama_Unidad u')
            ->innerJoin('u.Organigrama_UnidadTipo ut')
            ->where('ut.principal = ?',TRUE)
            ->orderby('u.orden_automatico, u.nombre');

        return $q->execute();
    }
}
