<?php

/**
 * Vehiculos_GpsVehiculo form base class.
 *
 * @method Vehiculos_GpsVehiculo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVehiculos_GpsVehiculoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'vehiculo_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_Vehiculo'), 'add_empty' => false)),
      'gps_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_Gps'), 'add_empty' => false)),
      'operador_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Comunicaciones_Operador'), 'add_empty' => false)),
      'icono'            => new sfWidgetFormInputText(),
      'color_icon'       => new sfWidgetFormInputText(),
      'status'           => new sfWidgetFormInputText(),
      'clave'            => new sfWidgetFormInputText(),
      'imei'             => new sfWidgetFormInputText(),
      'sim'              => new sfWidgetFormInputText(),
      'numero_uno'       => new sfWidgetFormInputText(),
      'numero_dos'       => new sfWidgetFormInputText(),
      'numero_tres'      => new sfWidgetFormInputText(),
      'numero_cuatro'    => new sfWidgetFormInputText(),
      'numero_cinco'     => new sfWidgetFormInputText(),
      'alerta_parametro' => new sfWidgetFormTextarea(),
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
      'gps_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_Gps'))),
      'operador_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Comunicaciones_Operador'))),
      'icono'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'color_icon'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'status'           => new sfValidatorString(array('max_length' => 1)),
      'clave'            => new sfValidatorNumber(),
      'imei'             => new sfValidatorNumber(array('required' => false)),
      'sim'              => new sfValidatorNumber(),
      'numero_uno'       => new sfValidatorNumber(array('required' => false)),
      'numero_dos'       => new sfValidatorNumber(array('required' => false)),
      'numero_tres'      => new sfValidatorNumber(array('required' => false)),
      'numero_cuatro'    => new sfValidatorNumber(array('required' => false)),
      'numero_cinco'     => new sfValidatorNumber(array('required' => false)),
      'alerta_parametro' => new sfValidatorString(array('required' => false)),
      'id_update'        => new sfValidatorInteger(),
      'id_create'        => new sfValidatorInteger(),
      'ip_update'        => new sfValidatorString(array('max_length' => 50)),
      'ip_create'        => new sfValidatorString(array('max_length' => 50)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('vehiculos_gps_vehiculo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vehiculos_GpsVehiculo';
  }

}
