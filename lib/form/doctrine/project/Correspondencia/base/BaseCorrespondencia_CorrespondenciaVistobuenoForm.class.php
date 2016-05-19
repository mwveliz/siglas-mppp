<?php

/**
 * Correspondencia_CorrespondenciaVistobueno form base class.
 *
 * @method Correspondencia_CorrespondenciaVistobueno getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_CorrespondenciaVistobuenoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'correspondencia_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'), 'add_empty' => false)),
      'funcionario_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'orden'                => new sfWidgetFormInputText(),
      'status'               => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
      'id_update'            => new sfWidgetFormInputText(),
      'turno'                => new sfWidgetFormInputCheckbox(),
      'funcionario_cargo_id' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'correspondencia_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'))),
      'funcionario_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'orden'                => new sfValidatorInteger(),
      'status'               => new sfValidatorString(array('max_length' => 1)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
      'id_update'            => new sfValidatorInteger(),
      'turno'                => new sfValidatorBoolean(array('required' => false)),
      'funcionario_cargo_id' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_correspondencia_vistobueno[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_CorrespondenciaVistobueno';
  }

}
