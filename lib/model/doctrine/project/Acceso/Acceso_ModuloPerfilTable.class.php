<?php


class Acceso_ModuloPerfilTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Acceso_ModuloPerfil');
    }

    public function buscarModuloPerfil($perfiles_ids)
    {
            $q = Doctrine_Query::create()
                ->select('mp.perfil_id, p.nombre as pnombre, m.nombre as mnombre, m.vinculo as vinculo, m.aplicacion as aplicacion, m.imagen as imagen')
                ->from('Acceso_ModuloPerfil mp')
                ->innerjoin('mp.Acceso_Perfil p')
                ->innerjoin('mp.Acceso_Modulo m')
                ->where('m.status = ?', 'A')
                ->andWhere('mp.status = ?', 'A')
                ->andWhereIn('p.id', $perfiles_ids)
                ->orderBy('p.nombre, m.nombre');

            return $q->execute();
    }
}