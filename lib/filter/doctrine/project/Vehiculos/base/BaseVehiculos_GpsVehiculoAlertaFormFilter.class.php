<?php

/**
 * Vehiculos_GpsVehiculoAlerta filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVehiculos_GpsVehiculoAlertaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gps_vehiculo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_GpsVehiculo'), 'add_empty' => true)),
      'comando'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sim'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'latitud'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'longitud'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'velocidad'       => new sfWidgetFormFilterInput(),
      'enlace'          => new sfWidgetFormFilterInput(),
      'status'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_gps'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fecha_gammu'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'id_update'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_create'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_create'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'gps_vehiculo_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Vehiculos_GpsVehiculo'), 'column' => 'id')),
      'comando'         => new sfValidatorPass(array('required' => false)),
      'sim'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'latitud'         => new sfValidatorPass(array('required' => false)),
      'longitud'        => new sfValidatorPass(array('required' => false)),
      'velocidad'       => new sfValidatorPass(array('required' => false)),
      'enlace'          => new sfValidatorPass(array('required' => false)),
      'status'          => new sfValidatorPass(array('required' => false)),
      'fecha_gps'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_gammu'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'id_update'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_create'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'       => new sfValidatorPass(array('required' => false)),
      'ip_create'       => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('vehiculos_gps_vehiculo_alerta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vehiculos_GpsVehiculoAlerta';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'gps_vehiculo_id' => 'ForeignKey',
      'comando'         => 'Text',
      'sim'             => 'Number',
      'latitud'         => 'Text',
      'longitud'        => 'Text',
      'velocidad'       => 'Text',
      'enlace'          => 'Text',
      'status'          => 'Text',
      'fecha_gps'       => 'Date',
      'fecha_gammu'     => 'Date',
      'id_update'       => 'Number',
      'id_create'       => 'Number',
      'ip_update'       => 'Text',
      'ip_create'       => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
