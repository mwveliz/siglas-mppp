<?php


class Siglas_ServiciosPublicadosConfianzaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Siglas_ServiciosPublicadosConfianza');
    }
    
    public function confianzaEnServicio($servicios_publicados_id, $servidor_confianza_id)
    {
        $q = Doctrine_Query::create()
            ->select('spc.*')
            ->from('Siglas_ServiciosPublicadosConfianza spc')
            ->where('spc.servicios_publicados_id = ?',$servicios_publicados_id)
            ->andWhere('spc.servidor_confianza_id = ?',$servidor_confianza_id)
            ->orderBy('spc.id DESC')
            ->limit(1)
            ->execute();

        return $q;
    }
}