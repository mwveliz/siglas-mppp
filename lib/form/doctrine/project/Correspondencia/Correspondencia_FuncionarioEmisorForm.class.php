<?php

/**
 * Correspondencia_FuncionarioEmisor form.
 *
 * @package    sigla-(institution)
 * @subpackage form
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Correspondencia_FuncionarioEmisorForm extends BaseCorrespondencia_FuncionarioEmisorForm
{
  public function configure()
  {
     $this->setValidators(array(
      'id'                 => new sfValidatorInteger(array('required' => false)),
      'correspondencia_id' => new sfValidatorInteger(array('required' => false)),
      'funcionario_id'     => new sfValidatorInteger(array('required' => true),
                                                     array('required' => 'Campo Obligatorio, Si el combo no muestra ningun firmante es porque ya a agregado todos los posibles')),
     ));

    $this->widgetSchema['funcionario_id'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine::getTable('Correspondencia_FuncionarioEmisor')->comboCorrepondenciaFuncionarioEmisor(),
      'multiple' => false, 'expanded' => false
    ));
  }
}
