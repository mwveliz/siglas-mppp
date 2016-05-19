<?php


class Public_SitioTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_Sitio');
    }
    
    public function sitiosActivos()
    {
        $q = Doctrine_Query::create()
            ->select('s.*, ts.icono as icono, ts.nombre as tipo_nombre')
            ->from('Public_Sitio s')
            ->innerJoin('s.Public_SitioTipo ts')
            ->where('s.status = ?', 'A');

        return $q->execute();
    }
}