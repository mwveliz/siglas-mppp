<?php


class Acceso_PerfilTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Acceso_Perfil');
    }
    
    public function perfilesActivos()
    {
        $q = Doctrine_Query::create()
            ->select('p.*')
            ->from('Acceso_Perfil p')
            ->where('p.status = ?','A')
            ->orderBy('p.nombre');

        return $q->execute();
    }    
}