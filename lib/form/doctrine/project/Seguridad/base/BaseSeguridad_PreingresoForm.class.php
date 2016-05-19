<?php

/**
 * Seguridad_Preingreso form base class.
 *
 * @method Seguridad_Preingreso getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeguridad_PreingresoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'unidad_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => false)),
      'funcionario_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'f_ingreso_posible_inicio' => new sfWidgetFormDateTime(),
      'f_ingreso_posible_final'  => new sfWidgetFormDateTime(),
      'motivo_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Motivo'), 'add_empty' => false)),
      'motivo_visita'            => new sfWidgetFormTextarea(),
      'status'                   => new sfWidgetFormInputText(),
      'id_create'                => new sfWidgetFormInputText(),
      'id_update'                => new sfWidgetFormInputText(),
      'ip_update'                => new sfWidgetFormInputText(),
      'indices'                  => new sfWidgetFormTextarea(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'unidad_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'))),
      'funcionario_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'required' => false)),
      'f_ingreso_posible_inicio' => new sfValidatorDateTime(),
      'f_ingreso_posible_final'  => new sfValidatorDateTime(),
      'motivo_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Motivo'))),
      'motivo_visita'            => new sfValidatorString(),
      'status'                   => new sfValidatorString(array('max_length' => 1)),
      'id_create'                => new sfValidatorInteger(),
      'id_update'                => new sfValidatorInteger(),
      'ip_update'                => new sfValidatorString(array('max_length' => 50)),
      'indices'                  => new sfValidatorString(array('required' => false)),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('seguridad_preingreso[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seguridad_Preingreso';
  }

}
