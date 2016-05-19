<?php


class Funcionarios_FuncionarioDiscapacidadTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_FuncionarioDiscapacidad');
    }
    
      public function datosDiscapacidadFuncionario($funcionario_id)
    {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Funcionarios_FuncionarioDiscapacidad c')
            ->where('c.funcionario_id = ?', $funcionario_id)
            ->andWhereIn('c.status', array('A','V'))
            ->orderBy('c.id DESC');

        return $q->execute();
    } 
    
}