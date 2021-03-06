<?php

/**
 * Correspondencia_AnexoFisico
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sigla-(institution)
 * @subpackage model
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Correspondencia_AnexoFisico extends BaseCorrespondencia_AnexoFisico
{
    public function save(Doctrine_Connection $conn = null)
    {
        return parent::save($conn);
    }
    
    public function postSave($event)
    {
        $cacheDriver = $this->getTable()->getAttribute(Doctrine_Core::ATTR_RESULT_CACHE);
        $cacheDriver->delete('correspondencia_AnexoFisico_correspondencia_id_'.$this->get('correspondencia_id'));
    }
    
    public function postDelete($event)
    {
        $cacheDriver = $this->getTable()->getAttribute(Doctrine_Core::ATTR_RESULT_CACHE);
        $cacheDriver->delete('correspondencia_AnexoFisico_correspondencia_id_'.$this->get('correspondencia_id'));
    }
}
