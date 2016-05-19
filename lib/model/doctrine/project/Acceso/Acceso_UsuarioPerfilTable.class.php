<?php


class Acceso_UsuarioPerfilTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Acceso_UsuarioPerfil');
    }

    public function buscarPerfiles($usuario_id)
    {
        $q = Doctrine_Query::create()
            ->select('p.*')
            ->from('Acceso_Perfil p')
            ->innerJoin('p.Acceso_UsuarioPerfil up')
            ->where('up.usuario_id = ?',$usuario_id)
            ->andWhere('up.status = ?','A');

        return $q->execute();
    }
    
    public function usuariosPerfiles()
    {
        $q = Doctrine_Query::create()
            ->select('u.id, u.usuario_enlace_id, u.nombre as usuario, p.id as perfil_id, p.nombre as perfil')
            ->from('Acceso_Usuario u')
            ->innerJoin('u.Acceso_UsuarioPerfil up')
            ->innerJoin('up.Acceso_Perfil p')
            ->where('p.status = ?','A')
            ->andWhere('up.status = ?','A')
            ->orderBy('p.nombre, u.nombre');

        return $q->execute();
    }
}