<?php


class Funcionarios_ResidenciaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_Residencia');
    }
    
    public function datosFuncionarioResidencia($funcionario_id)
    {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Funcionarios_Residencia c')
            ->where('c.funcionario_id = ?', $funcionario_id)
            ->andWhereIn('c.status', array('A','V'))
            ->orderBy('c.id DESC');

        return $q->execute();
    }     
}