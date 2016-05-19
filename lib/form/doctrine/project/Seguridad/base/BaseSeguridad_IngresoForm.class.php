<?php

/**
 * Seguridad_Ingreso form base class.
 *
 * @method Seguridad_Ingreso getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeguridad_IngresoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'persona_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Persona'), 'add_empty' => false)),
      'preingreso_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Preingreso'), 'add_empty' => true)),
      'imagen'           => new sfWidgetFormTextarea(),
      'unidad_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => false)),
      'funcionario_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'llave_ingreso_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_LlaveIngreso'), 'add_empty' => true)),
      'f_ingreso'        => new sfWidgetFormDateTime(),
      'f_egreso'         => new sfWidgetFormDateTime(),
      'motivo_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Motivo'), 'add_empty' => false)),
      'motivo_visita'    => new sfWidgetFormTextarea(),
      'registrador_id'   => new sfWidgetFormInputText(),
      'despachador_id'   => new sfWidgetFormInputText(),
      'status'           => new sfWidgetFormInputText(),
      'id_update'        => new sfWidgetFormInputText(),
      'ip_update'        => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'persona_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Persona'))),
      'preingreso_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Preingreso'), 'required' => false)),
      'imagen'           => new sfValidatorString(array('required' => false)),
      'unidad_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'))),
      'funcionario_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'required' => false)),
      'llave_ingreso_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_LlaveIngreso'), 'required' => false)),
      'f_ingreso'        => new sfValidatorDateTime(),
      'f_egreso'         => new sfValidatorDateTime(array('required' => false)),
      'motivo_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Motivo'))),
      'motivo_visita'    => new sfValidatorString(array('required' => false)),
      'registrador_id'   => new sfValidatorInteger(array('required' => false)),
      'despachador_id'   => new sfValidatorInteger(array('required' => false)),
      'status'           => new sfValidatorString(array('max_length' => 1)),
      'id_update'        => new sfValidatorInteger(),
      'ip_update'        => new sfValidatorString(array('max_length' => 50)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('seguridad_ingreso[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seguridad_Ingreso';
  }

}
