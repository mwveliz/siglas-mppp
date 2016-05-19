<?php


class Public_AmigoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_Amigo');
    }
    public function buscarAmigo($usuario_id)
    {
        $q = Doctrine_Query::create()
            ->select('a.id,f.id as funcionario_id,f.primer_nombre as primer_nombre,f.primer_apellido as primer_apellido,f.ci as ci')
            ->addSelect('(SELECT u.ultimo_status FROM Acceso_Usuario u WHERE u.usuario_enlace_id=f.id) AS ultimo_status')
            ->from('Public_Amigo a')
            ->innerJoin('a.Funcionarios_FuncionarioAmigo f')
            ->where('a.funcionario_id = ?',$usuario_id)
            ->orderBy('f.primer_nombre');
        
        return $q->execute();
    }
    
    public function verificarAmigo($usuario_id)
    {
        $q = Doctrine_Query::create()
             ->select('a.funcionario_amigo_id')
             ->from('Public_Amigo a')
             ->where('a.funcionario_id = ?',$usuario_id);
        
        return $q->execute();
    }
}