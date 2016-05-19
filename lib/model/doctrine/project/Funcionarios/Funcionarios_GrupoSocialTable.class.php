<?php


class Funcionarios_GrupoSocialTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_GrupoSocial');
    }
    
    public function datosGrupoFuncionario($funcionario_id)
    {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Funcionarios_GrupoSocial c')
            ->where('c.funcionario_id = ?', $funcionario_id)
            ->andWhereIn('c.status', array('A','V'));

        return $q->execute();
    }
}