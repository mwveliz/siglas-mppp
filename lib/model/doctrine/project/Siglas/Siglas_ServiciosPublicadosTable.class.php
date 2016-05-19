<?php


class Siglas_ServiciosPublicadosTable extends BaseDoctrineTable
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Siglas_ServiciosPublicados');
    }
    
    public function serviciosPublicados()
    {
        $q = Doctrine_Query::create()
            ->select('sp.*')
            ->from('Siglas_ServiciosPublicados sp')
            ->orderBy('sp.funcion DESC')
            ->execute();

        return $q;
    }
}