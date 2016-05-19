<?php

/**
 * Organigrama_Cargo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sigla-(institution)
 * @subpackage model
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Organigrama_Cargo extends BaseOrganigrama_Cargo
{
    public function save(Doctrine_Connection $conn = null)
    {
        if($this->isNew()){
            if(!$this->getStatus())
                $this->setStatus('V');
        }

        if(!$this->getUnidadFuncionalId())
            $this->setUnidadFuncionalId(sfContext::getInstance()->getUser()->getAttribute('unidad_funcional_id'));

        return parent::save($conn);
    }

    public function __toString()
    {
        return $this->getCodigoNomina().' - '.
               $this->getOrganigramaCargoCondicion().' - '.
               $this->getOrganigramaCargoTipo().' - '.
               $this->getOrganigramaCargoGrado();
    }
}
