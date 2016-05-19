<?php

/**
 * Funcionarios_OrigenIndigena form base class.
 *
 * @method Funcionarios_OrigenIndigena getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_OrigenIndigenaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'funcionario_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'etnia_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Etnia'), 'add_empty' => false)),
      'estado_etnia_id' => new sfWidgetFormInputText(),
      'nacimiento'      => new sfWidgetFormInputText(),
      'f_validado'      => new sfWidgetFormDateTime(),
      'id_validado'     => new sfWidgetFormInputText(),
      'status'          => new sfWidgetFormInputText(),
      'id_update'       => new sfWidgetFormInputText(),
      'ip_update'       => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'funcionario_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'etnia_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Etnia'))),
      'estado_etnia_id' => new sfValidatorString(array('max_length' => 2)),
      'nacimiento'      => new sfValidatorString(array('max_length' => 1)),
      'f_validado'      => new sfValidatorDateTime(array('required' => false)),
      'id_validado'     => new sfValidatorInteger(array('required' => false)),
      'status'          => new sfValidatorString(array('max_length' => 1)),
      'id_update'       => new sfValidatorInteger(),
      'ip_update'       => new sfValidatorString(array('max_length' => 40)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_origen_indigena[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_OrigenIndigena';
  }

}
