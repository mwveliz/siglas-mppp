<?php


class Funcionarios_IdiomaManejadoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_IdiomaManejado');
    }
    
    public function datosIdiomaFuncionario($funcionario_id)
    {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Funcionarios_IdiomaManejado c')
            ->where('c.funcionario_id = ?', $funcionario_id)
            ->andWhereIn('c.status', array('A','V'));

        return $q->execute();
    }
}