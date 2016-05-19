<?php


class Acceso_UsuarioTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Acceso_Usuario');
    }
    
    public function usuariosDeFuncionarios($funcionarios_ids)
    {
        $q = Doctrine_Query::create()
            ->select('u.*')
            ->from('Acceso_Usuario u')
            ->whereIn('u.usuario_enlace_id', $funcionarios_ids)
            ->andWhere('u.enlace_id = ?', 1);

        return $q->execute();
    }
}