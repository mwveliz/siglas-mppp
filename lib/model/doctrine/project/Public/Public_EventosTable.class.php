<?php


class Public_EventosTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_Eventos');
    }
    
    public function buscarEventos($id)
    {
        $start = date('Y-m-d H:m:s',strtotime('-1 month'));
        
        $q = Doctrine_Query::create()
            ->select('e.id, e.titulo, e.f_inicio, e.f_final,e.dia')
            ->from('Public_Eventos e')
            ->where('e.funcionario_id = ?', $id)
            ->andWhere('e.f_inicio >= ?', $start)
            ->execute(array(), Doctrine::HYDRATE_NONE); 
        
        return $q;
    }
    
    public function buscarEventosInvitado($id)
    {
        $start = date('Y-m-d H:m:s',strtotime('-1 month'));
        
        $q = Doctrine_Query::create()
            ->select('e.id, e.titulo, e.f_inicio, e.f_final,e.dia')
            ->from('Public_Eventos e, Public_EventosInvitados ei')
            ->where('ei.funcionario_invitado_id = ?',$id)
            ->andWhere('ei.aprobado = 1')
            ->andWhere('e.id = ei.evento_id')
            ->andWhere('e.f_inicio >= ?', $start)
            ->groupBy('e.id')
            ->execute(array(), Doctrine::HYDRATE_NONE); 
        
        return $q;
    }
    
    public function buscarInvitaciones($id)
    {
        $q = Doctrine_Query::create()
            ->select('ei.id as eiId, e.id as eId, e.titulo, e.f_inicio, e.f_final,f.id as fid, f.primer_nombre, f.primer_apellido')
            ->from('Public_Eventos e, Public_EventosInvitados ei, Funcionarios_Funcionario f')
            ->where('ei.funcionario_invitado_id = ?',$id)
            ->andWhere('e.id = ei.evento_id')
            ->andWhere('e.funcionario_id = f.id')
            ->andWhere('ei.aprobado = 0')
            ->execute(array(), Doctrine::HYDRATE_NONE); 
        
        return $q;
    }
}