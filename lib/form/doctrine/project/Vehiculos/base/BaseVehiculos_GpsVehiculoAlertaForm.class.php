<?php

/**
 * Vehiculos_GpsVehiculoAlerta form base class.
 *
 * @method Vehiculos_GpsVehiculoAlerta getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVehiculos_GpsVehiculoAlertaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'gps_vehiculo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_GpsVehiculo'), 'add_empty' => false)),
      'comando'         => new sfWidgetFormInputText(),
      'sim'             => new sfWidgetFormInputText(),
      'latitud'         => new sfWidgetFormInputText(),
      'longitud'        => new sfWidgetFormInputText(),
      'velocidad'       => new sfWidgetFormInputText(),
      'enlace'          => new sfWidgetFormTextarea(),
      'status'          => new sfWidgetFormInputText(),
      'fecha_gps'       => new sfWidgetFormDateTime(),
      'fecha_gammu'     => new sfWidgetFormDateTime(),
      'id_update'       => new sfWidgetFormInputText(),
      'id_create'       => new sfWidgetFormInputText(),
      'ip_update'       => new sfWidgetFormInputText(),
      'ip_create'       => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'gps_vehiculo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_GpsVehiculo'))),
      'comando'         => new sfValidatorString(array('max_length' => 50)),
      'sim'             => new sfValidatorNumber(),
      'latitud'         => new sfValidatorString(array('max_length' => 50)),
      'longitud'        => new sfValidatorString(array('max_length' => 50)),
      'velocidad'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'enlace'          => new sfValidatorString(array('required' => false)),
      'status'          => new sfValidatorString(array('max_length' => 1)),
      'fecha_gps'       => new sfValidatorDateTime(),
      'fecha_gammu'     => new sfValidatorDateTime(),
      'id_update'       => new sfValidatorInteger(),
      'id_create'       => new sfValidatorInteger(),
      'ip_update'       => new sfValidatorString(array('max_length' => 50)),
      'ip_create'       => new sfValidatorString(array('max_length' => 50)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('vehiculos_gps_vehiculo_alerta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vehiculos_GpsVehiculoAlerta';
  }

}
