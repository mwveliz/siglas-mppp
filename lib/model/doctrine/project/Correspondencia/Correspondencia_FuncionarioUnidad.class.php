<?php

/**
 * Correspondencia_FuncionarioUnidad
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sigla-(institution)
 * @subpackage model
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Correspondencia_FuncionarioUnidad extends BaseCorrespondencia_FuncionarioUnidad
{
    public function save(Doctrine_Connection $conn = null)
    {
        if($this->isNew())
        {
              if(sfContext::getInstance()->getUser()->getAttribute('pae_funcionario_unidad_id'))
                  $this->setAutorizadaUnidadId(sfContext::getInstance()->getUser()->getAttribute('pae_funcionario_unidad_id'));
              $this->setStatus('A');
              $this->setPermitido('true');
        }

        return parent::save($conn);
    }
    
    public function postSave($event)
    {
        $cacheDriver = $this->getTable()->getAttribute(Doctrine_Core::ATTR_RESULT_CACHE);
        $cacheDriver->delete('correspondencia_grupo_funcionario_id_'.$this->getFuncionarioId());
    }

    public function postDelete($event)
    {
        $cacheDriver = $this->getTable()->getAttribute(Doctrine_Core::ATTR_RESULT_CACHE);
        $cacheDriver->delete('correspondencia_grupo_funcionario_id_'.$this->getFuncionarioId());
    }
}