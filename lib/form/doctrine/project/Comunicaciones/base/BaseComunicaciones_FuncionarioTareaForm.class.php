<?php

/**
 * Comunicaciones_FuncionarioTarea form base class.
 *
 * @method Comunicaciones_FuncionarioTarea getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseComunicaciones_FuncionarioTareaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'padre_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Comunicaciones_FuncionarioTarea'), 'add_empty' => true)),
      'funcionario_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'tarea_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Comunicaciones_Tarea'), 'add_empty' => false)),
      'resultado'             => new sfWidgetFormInputText(),
      'resultado_descripcion' => new sfWidgetFormTextarea(),
      'status'                => new sfWidgetFormInputText(),
      'id_update'             => new sfWidgetFormInputText(),
      'ip_update'             => new sfWidgetFormInputText(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'padre_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Comunicaciones_FuncionarioTarea'), 'required' => false)),
      'funcionario_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'tarea_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Comunicaciones_Tarea'))),
      'resultado'             => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'resultado_descripcion' => new sfValidatorString(array('required' => false)),
      'status'                => new sfValidatorString(array('max_length' => 1)),
      'id_update'             => new sfValidatorInteger(),
      'ip_update'             => new sfValidatorString(array('max_length' => 30)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('comunicaciones_funcionario_tarea[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comunicaciones_FuncionarioTarea';
  }

}
