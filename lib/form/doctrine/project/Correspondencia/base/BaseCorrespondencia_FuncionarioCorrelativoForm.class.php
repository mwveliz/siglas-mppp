<?php

/**
 * Correspondencia_FuncionarioCorrelativo form base class.
 *
 * @method Correspondencia_FuncionarioCorrelativo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_FuncionarioCorrelativoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'funcionario_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'ultimo_correlativo' => new sfWidgetFormInputText(),
      'nomenclador'        => new sfWidgetFormInputText(),
      'secuencia'          => new sfWidgetFormInputText(),
      'status'             => new sfWidgetFormInputText(),
      'id_update'          => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'funcionario_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'ultimo_correlativo' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nomenclador'        => new sfValidatorString(array('max_length' => 100)),
      'secuencia'          => new sfValidatorInteger(),
      'status'             => new sfValidatorString(array('max_length' => 1)),
      'id_update'          => new sfValidatorInteger(),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_funcionario_correlativo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_FuncionarioCorrelativo';
  }

}
