<?php

/**
 * Correspondencia_Receptor form.
 *
 * @package    sigla-(institution)
 * @subpackage form
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Correspondencia_ReceptorForm extends BaseCorrespondencia_ReceptorForm
{
  public function configure()
  {
    $this->setValidators(array(
      'id'                         => new sfValidatorInteger(array('required' => false)),
      'correspondencia_id'         => new sfValidatorInteger(array('required' => false)),
      'unidad_id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'),'required' => true)),
      'funcionario_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'),'required' => true)),
      'copia'                      => new sfValidatorString(array('max_length' => 1,'required' => true)),
      'privado'                      => new sfValidatorString(array('max_length' => 1,'required' => true)),
    ));      
  }
}
