<?php


class Correspondencia_TipoAnexoFisicoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_TipoAnexoFisico');
    }
    
    public function tiposActivos() {
        $q = Doctrine_Query::create()
            ->select('t.id, t.nombre')
            ->from('Correspondencia_TipoAnexoFisico t')
            ->orderBy('t.nombre')
            ->useResultCache(true, 3600, 'tipo_anexo_fisico_activos')
            ->execute();

        return $q;
    }
}