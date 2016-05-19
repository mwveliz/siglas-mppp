<?php

/**
 * Vehiculos_ConductorVehiculo form base class.
 *
 * @method Vehiculos_ConductorVehiculo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVehiculos_ConductorVehiculoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'vehiculo_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_Vehiculo'), 'add_empty' => false)),
      'funcionario_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'condicion_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_Condicion'), 'add_empty' => false)),
      'f_asignacion'     => new sfWidgetFormDateTime(),
      'f_desincorporado' => new sfWidgetFormDateTime(),
      'status'           => new sfWidgetFormInputText(),
      'id_update'        => new sfWidgetFormInputText(),
      'id_create'        => new sfWidgetFormInputText(),
      'ip_update'        => new sfWidgetFormInputText(),
      'ip_create'        => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'vehiculo_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_Vehiculo'))),
      'funcionario_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'condicion_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_Condicion'))),
      'f_asignacion'     => new sfValidatorDateTime(),
      'f_desincorporado' => new sfValidatorDateTime(array('required' => false)),
      'status'           => new sfValidatorString(array('max_length' => 1)),
      'id_update'        => new sfValidatorInteger(),
      'id_create'        => new sfValidatorInteger(),
      'ip_update'        => new sfValidatorString(array('max_length' => 50)),
      'ip_create'        => new sfValidatorString(array('max_length' => 50)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('vehiculos_conductor_vehiculo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vehiculos_ConductorVehiculo';
  }

}
