<?php

/**
 * Archivo_FuncionarioUnidad form base class.
 *
 * @method Archivo_FuncionarioUnidad getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArchivo_FuncionarioUnidadForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'autorizada_unidad_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad_ForAutorizadaUnidad'), 'add_empty' => false)),
      'funcionario_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'dependencia_unidad_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad_ForDependenciaUnidad'), 'add_empty' => false)),
      'leer'                  => new sfWidgetFormInputCheckbox(),
      'archivar'              => new sfWidgetFormInputCheckbox(),
      'prestar'               => new sfWidgetFormInputCheckbox(),
      'anular'                => new sfWidgetFormInputCheckbox(),
      'administrar'           => new sfWidgetFormInputCheckbox(),
      'status'                => new sfWidgetFormInputText(),
      'permitido'             => new sfWidgetFormInputCheckbox(),
      'permitido_funcionario' => new sfWidgetFormInputText(),
      'deleted_at'            => new sfWidgetFormDateTime(),
      'id_update'             => new sfWidgetFormInputText(),
      'ip_update'             => new sfWidgetFormTextarea(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'autorizada_unidad_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad_ForAutorizadaUnidad'))),
      'funcionario_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'dependencia_unidad_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad_ForDependenciaUnidad'))),
      'leer'                  => new sfValidatorBoolean(array('required' => false)),
      'archivar'              => new sfValidatorBoolean(array('required' => false)),
      'prestar'               => new sfValidatorBoolean(array('required' => false)),
      'anular'                => new sfValidatorBoolean(array('required' => false)),
      'administrar'           => new sfValidatorBoolean(array('required' => false)),
      'status'                => new sfValidatorString(array('max_length' => 1)),
      'permitido'             => new sfValidatorBoolean(array('required' => false)),
      'permitido_funcionario' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'deleted_at'            => new sfValidatorDateTime(array('required' => false)),
      'id_update'             => new sfValidatorInteger(),
      'ip_update'             => new sfValidatorString(),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('archivo_funcionario_unidad[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_FuncionarioUnidad';
  }

}
