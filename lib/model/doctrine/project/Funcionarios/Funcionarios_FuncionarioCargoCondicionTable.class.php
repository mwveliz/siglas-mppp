<?php


class Funcionarios_FuncionarioCargoCondicionTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_FuncionarioCargoCondicion');
    }
    
    public function ordenado($tipo=null)
    {
        if($tipo==null){
            return $this->createQuery('fcc')
                        ->orderBy('fcc.nombre asc')
                        ->execute();
        } else {
            return $this->createQuery('fcc')
                        ->where('fcc.tipo = ?',$tipo)
                        ->orderBy('fcc.nombre asc')
                        ->execute();
        }
    }
}