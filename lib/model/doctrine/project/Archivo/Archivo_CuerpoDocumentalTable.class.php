<?php


class Archivo_CuerpoDocumentalTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_CuerpoDocumental');
    }
    
    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('cd.*')
            ->from('Archivo_CuerpoDocumental cd')
            ->where('cd.serie_documental_id = ?', sfContext::getInstance()->getUser()->getAttribute('serie_documental_id'))
            ->orderBy('cd.orden, cd.nombre');

        return $q;
    }
    
    public function buscarCuerpoDocumentalNull()
    {
        $q = Doctrine_Query::create()
            ->select('cd.*')
            ->from('Archivo_CuerpoDocumental cd')
            ->where('cd.padre_id is null')
            ->andWhere('cd.serie_documental_id = ?',sfContext::getInstance()->getUser()->getAttribute('serie_documental_id'))
            ->orderby('cd.orden, cd.nombre')
            
            ->useResultCache(true, 3600, 'cache_cuerpo_documental_nulos');

        return $q->execute();
    }

    public function buscarCuerpoDocumentalHijos($padre_id)
    {
        $q = Doctrine_Query::create()
            ->select('cd.*')
            ->from('Archivo_CuerpoDocumental cd')
            ->where('cd.padre_id = ?',$padre_id)
            ->andWhere('cd.serie_documental_id = ?',sfContext::getInstance()->getUser()->getAttribute('serie_documental_id'))
            ->orderby('cd.orden, cd.nombre')

            ->useResultCache(true, 3600, 'cache_cuerpo_documental_hijos_'.$padre_id);

        return $q->execute();
    }

    public function cadenaComboCuerpoDocumental($cadena = '<- Seleccione ->.##.&&.##.', $padre_id = 0,$tabular = 0)
    {
        $tabular_cadena = "";
        for($i=0;$i<$tabular;$i++)
            $tabular_cadena.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

        if($padre_id == 0)
            $p=$this->buscarCuerpoDocumentalNull();
        else
            $p=$this->buscarCuerpoDocumentalHijos($padre_id);

        $can=count($p);
        $opciones=array();
        for($i=0;$i<$can;$i++)
        {
            $cadena.=$tabular_cadena.$p[$i]['nombre'].'.##.'.$p[$i]['id'].'.##.';

            $tabular++;
            $cadena=$this->cadenaComboCuerpoDocumental($cadena, $p[$i]['id'],$tabular);
            $tabular--;
        }

        return $cadena;
    }

    public function comboCuerpoDocumental($unidad_tipo = FALSE)
    {
        $cadena=$this->cadenaComboCuerpoDocumental();

        $cadena_arreglo = explode( ".##.", $cadena);

        $opciones = array();

        for($i=0;$i<count($cadena_arreglo)-1;$i+=2)
        {
            if($unidad_tipo == FALSE)
            {
                $ids = explode('&&', $cadena_arreglo[$i+1]);
                $id = $ids[0];
            }
            else
                $id = $cadena_arreglo[$i+1];
            
            $opciones[$id]=$cadena_arreglo[$i];
        }

        //$opciones = array_unique($opciones);
        return $opciones;
    }
    
    public function cuerposDeSerie($serie_id)
    {
            $q = Doctrine_Query::create()
                ->select('cd.*')
                ->from('Archivo_CuerpoDocumental cd')
                ->where('cd.serie_documental_id = ?', $serie_id)
                ->orderBy('cd.orden, cd.nombre');

            return $q->execute();
    }
}