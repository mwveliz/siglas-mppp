<?php

/**
 * Vehiculos_Vehiculo form base class.
 *
 * @method Vehiculos_Vehiculo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVehiculos_VehiculoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'tipo_uso_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_TipoUso'), 'add_empty' => false)),
      'tipo_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_Tipo'), 'add_empty' => false)),
      'placa'               => new sfWidgetFormInputText(),
      'ano'                 => new sfWidgetFormInputText(),
      'marca'               => new sfWidgetFormInputText(),
      'modelo'              => new sfWidgetFormInputText(),
      'serial_carroceria'   => new sfWidgetFormInputText(),
      'serial_motor'        => new sfWidgetFormInputText(),
      'color'               => new sfWidgetFormInputText(),
      'kilometraje_inicial' => new sfWidgetFormInputText(),
      'kilometraje_actual'  => new sfWidgetFormInputText(),
      'vel_max'             => new sfWidgetFormInputText(),
      'status'              => new sfWidgetFormInputText(),
      'id_update'           => new sfWidgetFormInputText(),
      'id_create'           => new sfWidgetFormInputText(),
      'ip_update'           => new sfWidgetFormInputText(),
      'ip_create'           => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'tipo_uso_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_TipoUso'))),
      'tipo_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_Tipo'))),
      'placa'               => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ano'                 => new sfValidatorInteger(array('required' => false)),
      'marca'               => new sfValidatorString(array('max_length' => 50)),
      'modelo'              => new sfValidatorString(array('max_length' => 50)),
      'serial_carroceria'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'serial_motor'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'color'               => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'kilometraje_inicial' => new sfValidatorInteger(array('required' => false)),
      'kilometraje_actual'  => new sfValidatorInteger(array('required' => false)),
      'vel_max'             => new sfValidatorInteger(array('required' => false)),
      'status'              => new sfValidatorString(array('max_length' => 1)),
      'id_update'           => new sfValidatorInteger(),
      'id_create'           => new sfValidatorInteger(),
      'ip_update'           => new sfValidatorString(array('max_length' => 50)),
      'ip_create'           => new sfValidatorString(array('max_length' => 50)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('vehiculos_vehiculo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vehiculos_Vehiculo';
  }

}
