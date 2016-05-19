<?php

/**
 * Correspondencia_VistobuenoConfig form base class.
 *
 * @method Correspondencia_VistobuenoConfig getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_VistobuenoConfigForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'funcionario_unidad_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_FuncionarioUnidad'), 'add_empty' => false)),
      'funcionario_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'orden'                 => new sfWidgetFormInputText(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
      'id_update'             => new sfWidgetFormInputText(),
      'funcionario_cargo_id'  => new sfWidgetFormInputText(),
      'status'                => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'funcionario_unidad_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_FuncionarioUnidad'))),
      'funcionario_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'orden'                 => new sfValidatorInteger(),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
      'id_update'             => new sfValidatorInteger(),
      'funcionario_cargo_id'  => new sfValidatorInteger(),
      'status'                => new sfValidatorString(array('max_length' => 1)),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_vistobueno_config[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_VistobuenoConfig';
  }

}
