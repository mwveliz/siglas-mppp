<?php


class Funcionarios_EducacionAdicionalTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_EducacionAdicional');
    }
    
    public function datosFuncionarioEducacionAdicional($funcionario_id)
    {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Funcionarios_EducacionAdicional c')
            ->where('c.funcionario_id = ?', $funcionario_id)
            ->andWhereIn('c.status', array('A','V'))
            ->orderBy('c.f_ingreso DESC');
        return $q->execute();
    } 
}