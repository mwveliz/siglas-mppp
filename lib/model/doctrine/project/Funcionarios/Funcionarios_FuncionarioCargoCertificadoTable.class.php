<?php


class Funcionarios_FuncionarioCargoCertificadoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_FuncionarioCargoCertificado');
    }
    
    public function innerList()
    {
        $q = Doctrine_Query::create()
            ->select('fcc.*')
            ->addSelect('(SELECT uc.nombre FROM Acceso_Usuario uc WHERE uc.id = fcc.id_create LIMIT 1) as user_create')
            ->addSelect('(SELECT uu.nombre FROM Acceso_Usuario uu WHERE uu.id = fcc.id_update LIMIT 1) as user_update')
            ->from('Funcionarios_FuncionarioCargoCertificado fcc')
            ->where('fcc.funcionario_cargo_id = ?', sfContext::getInstance()->getUser()->getAttribute('certificados_funcionario_cargo_id'))
            ->orderBy('fcc.id desc');

        return $q;
    }
}