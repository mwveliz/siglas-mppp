<?php


class Siglas_ServidorConfianzaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Siglas_ServidorConfianza');
    }
    
    public function innerList()
    {
            $q = Doctrine_Query::create()
                ->select('sc.*')
                ->from('Siglas_ServidorConfianza sc')
                ->innerJoin('sc.Organismos_Organismo o')
                ->whereIn('sc.status',array('A','I'))
                ->orderBy('o.nombre ASC');

            return $q;
    }
    
    public function organismosConfianzaEn($organismos_ids)
    {
            $q = Doctrine_Query::create()
                ->select('sc.*')
                ->from('Siglas_ServidorConfianza sc')
                ->whereIn('sc.organismo_id',$organismos_ids)
                ->execute();

            return $q;
    }
    
    public function organismosConfianzaNoCertificados($ids_yml)
    {
            $q = Doctrine_Query::create()
                ->select('sc.*')
                ->from('Siglas_ServidorConfianza sc')
                ->whereIn('sc.status',array('A','I'))
                ->andWhereNotIn('sc.id_yml',$ids_yml)
                ->execute();

            return $q;
    }
    
}