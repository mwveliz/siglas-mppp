<?php

/**
 * Funcionarios_FuncionarioCargo form base class.
 *
 * @method Funcionarios_FuncionarioCargo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_FuncionarioCargoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                             => new sfWidgetFormInputHidden(),
      'cargo_id'                       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Cargo'), 'add_empty' => false)),
      'funcionario_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'f_ingreso'                      => new sfWidgetFormDate(),
      'observaciones'                  => new sfWidgetFormTextarea(),
      'funcionario_cargo_condicion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioCargoCondicion'), 'add_empty' => false)),
      'f_retiro'                       => new sfWidgetFormDate(),
      'motivo_retiro'                  => new sfWidgetFormTextarea(),
      'status'                         => new sfWidgetFormInputText(),
      'id_update'                      => new sfWidgetFormInputText(),
      'created_at'                     => new sfWidgetFormDateTime(),
      'updated_at'                     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'cargo_id'                       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Cargo'))),
      'funcionario_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'f_ingreso'                      => new sfValidatorDate(),
      'observaciones'                  => new sfValidatorString(array('required' => false)),
      'funcionario_cargo_condicion_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioCargoCondicion'))),
      'f_retiro'                       => new sfValidatorDate(array('required' => false)),
      'motivo_retiro'                  => new sfValidatorString(array('required' => false)),
      'status'                         => new sfValidatorString(array('max_length' => 1)),
      'id_update'                      => new sfValidatorInteger(),
      'created_at'                     => new sfValidatorDateTime(),
      'updated_at'                     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_funcionario_cargo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_FuncionarioCargo';
  }

}
