<?php


class Funcionarios_EducacionUniversitariaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_EducacionUniversitaria');
    }
    
    public function datosFuncionarioEducacionUniversitaria($funcionario_id)
    {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Funcionarios_EducacionUniversitaria c')
            ->where('c.funcionario_id = ?', $funcionario_id)
            ->andWhereIn('c.status', array('A','V'))
            ->orderBy('c.id DESC');

        return $q->execute();
    }       
    
}