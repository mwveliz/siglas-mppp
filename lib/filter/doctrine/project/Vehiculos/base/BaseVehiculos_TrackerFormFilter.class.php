<?php

/**
 * Vehiculos_Tracker filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVehiculos_TrackerFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gps_vehiculo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_GpsVehiculo'), 'add_empty' => true)),
      'f_recibido'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'latitud'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'longitud'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'velocidad'       => new sfWidgetFormFilterInput(),
      'enlace'          => new sfWidgetFormFilterInput(),
      'fuente'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'puerta'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'acc'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'id_update'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_create'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_create'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'gps_vehiculo_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Vehiculos_GpsVehiculo'), 'column' => 'id')),
      'f_recibido'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'latitud'         => new sfValidatorPass(array('required' => false)),
      'longitud'        => new sfValidatorPass(array('required' => false)),
      'velocidad'       => new sfValidatorPass(array('required' => false)),
      'enlace'          => new sfValidatorPass(array('required' => false)),
      'fuente'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'puerta'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'acc'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'id_update'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_create'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'       => new sfValidatorPass(array('required' => false)),
      'ip_create'       => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('vehiculos_tracker_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vehiculos_Tracker';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'gps_vehiculo_id' => 'ForeignKey',
      'f_recibido'      => 'Date',
      'latitud'         => 'Text',
      'longitud'        => 'Text',
      'velocidad'       => 'Text',
      'enlace'          => 'Text',
      'fuente'          => 'Boolean',
      'puerta'          => 'Boolean',
      'acc'             => 'Boolean',
      'id_update'       => 'Number',
      'id_create'       => 'Number',
      'ip_update'       => 'Text',
      'ip_create'       => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
