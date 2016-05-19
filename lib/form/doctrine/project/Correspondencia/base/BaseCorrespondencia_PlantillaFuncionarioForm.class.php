<?php

/**
 * Correspondencia_PlantillaFuncionario form base class.
 *
 * @method Correspondencia_PlantillaFuncionario getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_PlantillaFuncionarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'plantilla_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Plantilla'), 'add_empty' => false)),
      'funcionario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'id_update'      => new sfWidgetFormInputText(),
      'ip_update'      => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'plantilla_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Plantilla'))),
      'funcionario_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'id_update'      => new sfValidatorInteger(),
      'ip_update'      => new sfValidatorString(array('max_length' => 50)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_plantilla_funcionario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_PlantillaFuncionario';
  }

}
