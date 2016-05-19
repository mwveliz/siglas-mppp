<?php

/**
 * Correspondencia_FuncionarioUnidad form base class.
 *
 * @method Correspondencia_FuncionarioUnidad getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_FuncionarioUnidadForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'autorizada_unidad_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => false)),
      'funcionario_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'dependencia_unidad_id' => new sfWidgetFormInputText(),
      'redactar'              => new sfWidgetFormInputCheckbox(),
      'leer'                  => new sfWidgetFormInputCheckbox(),
      'firmar'                => new sfWidgetFormInputCheckbox(),
      'recibir'               => new sfWidgetFormInputCheckbox(),
      'permitido'             => new sfWidgetFormInputCheckbox(),
      'permitido_funcionario' => new sfWidgetFormInputText(),
      'administrar'           => new sfWidgetFormInputCheckbox(),
      'status'                => new sfWidgetFormInputText(),
      'deleted_at'            => new sfWidgetFormDateTime(),
      'id_update'             => new sfWidgetFormInputText(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'autorizada_unidad_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'))),
      'funcionario_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'dependencia_unidad_id' => new sfValidatorInteger(),
      'redactar'              => new sfValidatorBoolean(array('required' => false)),
      'leer'                  => new sfValidatorBoolean(array('required' => false)),
      'firmar'                => new sfValidatorBoolean(array('required' => false)),
      'recibir'               => new sfValidatorBoolean(array('required' => false)),
      'permitido'             => new sfValidatorBoolean(array('required' => false)),
      'permitido_funcionario' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'administrar'           => new sfValidatorBoolean(array('required' => false)),
      'status'                => new sfValidatorString(array('max_length' => 1)),
      'deleted_at'            => new sfValidatorDateTime(array('required' => false)),
      'id_update'             => new sfValidatorInteger(),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_funcionario_unidad[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_FuncionarioUnidad';
  }

}
