<?php

/**
 * Vehiculos_Tracker form base class.
 *
 * @method Vehiculos_Tracker getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVehiculos_TrackerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'gps_vehiculo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_GpsVehiculo'), 'add_empty' => false)),
      'f_recibido'      => new sfWidgetFormDateTime(),
      'latitud'         => new sfWidgetFormInputText(),
      'longitud'        => new sfWidgetFormInputText(),
      'velocidad'       => new sfWidgetFormInputText(),
      'enlace'          => new sfWidgetFormTextarea(),
      'fuente'          => new sfWidgetFormInputCheckbox(),
      'puerta'          => new sfWidgetFormInputCheckbox(),
      'acc'             => new sfWidgetFormInputCheckbox(),
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
      'f_recibido'      => new sfValidatorDateTime(),
      'latitud'         => new sfValidatorString(array('max_length' => 50)),
      'longitud'        => new sfValidatorString(array('max_length' => 50)),
      'velocidad'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'enlace'          => new sfValidatorString(array('required' => false)),
      'fuente'          => new sfValidatorBoolean(array('required' => false)),
      'puerta'          => new sfValidatorBoolean(array('required' => false)),
      'acc'             => new sfValidatorBoolean(array('required' => false)),
      'id_update'       => new sfValidatorInteger(),
      'id_create'       => new sfValidatorInteger(),
      'ip_update'       => new sfValidatorString(array('max_length' => 50)),
      'ip_create'       => new sfValidatorString(array('max_length' => 50)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('vehiculos_tracker[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vehiculos_Tracker';
  }

}
