<?php


class Siglas_ActualizacionSvnTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Siglas_ActualizacionSvn');
    }
    
    public function versionesDescargadas()
    {
        $q = Doctrine_Query::create()
            ->select('svn.*')
            ->from('Siglas_ActualizacionSvn svn')
            ->orderBy('svn.id DESC')
            ->execute();

        return $q;
    }
}