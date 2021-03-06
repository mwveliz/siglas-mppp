<?php

/**
 * Funcionarios_FuncionarioCargo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sigla-(institution)
 * @subpackage model
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Funcionarios_FuncionarioCargo extends BaseFuncionarios_FuncionarioCargo
{
    public function save(Doctrine_Connection $conn = null)
    {
        if($this->isNew())
            $this->setStatus('A');
        else if($this->getStatus()=='C' || $this->getStatus()=='A') //coletilla
            $this->setStatus('A');
        else
            $this->setStatus('D');

        if(sfContext::getInstance()->getUser()->getAttribute('pae_funcionario_id'))
            $this->setFuncionarioId(sfContext::getInstance()->getUser()->getAttribute('pae_funcionario_id'));

        return parent::save($conn);
    }
    public function postSave($event)
    {
        $cacheDriver = $this->getTable()->getAttribute(Doctrine_Core::ATTR_RESULT_CACHE);
        $cacheDriver->delete('cache_funcionario_activo');
    }
    
    public function postDelete($event)
    {
        $cacheDriver = $this->getTable()->getAttribute(Doctrine_Core::ATTR_RESULT_CACHE);
        $cacheDriver->delete('cache_funcionario_activo');
    }
}
