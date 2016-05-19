<?php

/**
 * Archivo_CompartirFuncionario form base class.
 *
 * @method Archivo_CompartirFuncionario getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArchivo_CompartirFuncionarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'compartir_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Compartir'), 'add_empty' => false)),
      'funcionario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'updated_at'     => new sfWidgetFormDateTime(),
      'id_update'      => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'compartir_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Compartir'))),
      'funcionario_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'updated_at'     => new sfValidatorDateTime(),
      'id_update'      => new sfValidatorInteger(),
      'created_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('archivo_compartir_funcionario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_CompartirFuncionario';
  }

}
