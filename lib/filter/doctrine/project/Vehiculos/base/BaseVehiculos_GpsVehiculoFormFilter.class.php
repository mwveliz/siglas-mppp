<?php

/**
 * Vehiculos_GpsVehiculo filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVehiculos_GpsVehiculoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'vehiculo_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_Vehiculo'), 'add_empty' => true)),
      'gps_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_Gps'), 'add_empty' => true)),
      'operador_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Comunicaciones_Operador'), 'add_empty' => true)),
      'icono'            => new sfWidgetFormFilterInput(),
      'color_icon'       => new sfWidgetFormFilterInput(),
      'status'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'clave'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'imei'             => new sfWidgetFormFilterInput(),
      'sim'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numero_uno'       => new sfWidgetFormFilterInput(),
      'numero_dos'       => new sfWidgetFormFilterInput(),
      'numero_tres'      => new sfWidgetFormFilterInput(),
      'numero_cuatro'    => new sfWidgetFormFilterInput(),
      'numero_cinco'     => new sfWidgetFormFilterInput(),
      'alerta_parametro' => new sfWidgetFormFilterInput(),
      'id_update'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_create'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_create'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'vehiculo_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Vehiculos_Vehiculo'), 'column' => 'id')),
      'gps_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Vehiculos_Gps'), 'column' => 'id')),
      'operador_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Comunicaciones_Operador'), 'column' => 'id')),
      'icono'            => new sfValidatorPass(array('required' => false)),
      'color_icon'       => new sfValidatorPass(array('required' => false)),
      'status'           => new sfValidatorPass(array('required' => false)),
      'clave'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'imei'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'sim'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'numero_uno'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'numero_dos'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'numero_tres'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'numero_cuatro'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'numero_cinco'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'alerta_parametro' => new sfValidatorPass(array('required' => false)),
      'id_update'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_create'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'        => new sfValidatorPass(array('required' => false)),
      'ip_create'        => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('vehiculos_gps_vehiculo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vehiculos_GpsVehiculo';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'vehiculo_id'      => 'ForeignKey',
      'gps_id'           => 'ForeignKey',
      'operador_id'      => 'ForeignKey',
      'icono'            => 'Text',
      'color_icon'       => 'Text',
      'status'           => 'Text',
      'clave'            => 'Number',
      'imei'             => 'Number',
      'sim'              => 'Number',
      'numero_uno'       => 'Number',
      'numero_dos'       => 'Number',
      'numero_tres'      => 'Number',
      'numero_cuatro'    => 'Number',
      'numero_cinco'     => 'Number',
      'alerta_parametro' => 'Text',
      'id_update'        => 'Number',
      'id_create'        => 'Number',
      'ip_update'        => 'Text',
      'ip_create'        => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
