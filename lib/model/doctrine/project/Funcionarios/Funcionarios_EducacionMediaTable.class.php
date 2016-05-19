<?php


class Funcionarios_EducacionMediaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_EducacionMedia');
    }
    
    public function datosFuncionarioEducacionMedia($funcionario_id)
    {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Funcionarios_EducacionMedia c')
            ->where('c.funcionario_id = ?', $funcionario_id)
            ->andWhereIn('c.status', array('A','V'))
            ->orderBy('c.id DESC');

        return $q->execute();
    } 
    
}