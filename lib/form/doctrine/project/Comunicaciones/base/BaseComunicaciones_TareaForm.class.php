<?php

/**
 * Comunicaciones_Tarea form base class.
 *
 * @method Comunicaciones_Tarea getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseComunicaciones_TareaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'funcionario_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'descripcion'         => new sfWidgetFormTextarea(),
      'f_tentativa_inicial' => new sfWidgetFormDate(),
      'f_tentativa_final'   => new sfWidgetFormDate(),
      'prioridad'           => new sfWidgetFormInputText(),
      'parametros'          => new sfWidgetFormTextarea(),
      'status'              => new sfWidgetFormInputText(),
      'id_update'           => new sfWidgetFormInputText(),
      'ip_update'           => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'funcionario_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'descripcion'         => new sfValidatorString(),
      'f_tentativa_inicial' => new sfValidatorDate(array('required' => false)),
      'f_tentativa_final'   => new sfValidatorDate(array('required' => false)),
      'prioridad'           => new sfValidatorInteger(),
      'parametros'          => new sfValidatorString(),
      'status'              => new sfValidatorString(array('max_length' => 1)),
      'id_update'           => new sfValidatorInteger(),
      'ip_update'           => new sfValidatorString(array('max_length' => 30)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('comunicaciones_tarea[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comunicaciones_Tarea';
  }

}
