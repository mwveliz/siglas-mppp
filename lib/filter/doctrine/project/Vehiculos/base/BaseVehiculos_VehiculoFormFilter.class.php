<?php

/**
 * Vehiculos_Vehiculo filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVehiculos_VehiculoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tipo_uso_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_TipoUso'), 'add_empty' => true)),
      'tipo_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_Tipo'), 'add_empty' => true)),
      'placa'               => new sfWidgetFormFilterInput(),
      'ano'                 => new sfWidgetFormFilterInput(),
      'marca'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'modelo'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'serial_carroceria'   => new sfWidgetFormFilterInput(),
      'serial_motor'        => new sfWidgetFormFilterInput(),
      'color'               => new sfWidgetFormFilterInput(),
      'kilometraje_inicial' => new sfWidgetFormFilterInput(),
      'kilometraje_actual'  => new sfWidgetFormFilterInput(),
      'vel_max'             => new sfWidgetFormFilterInput(),
      'status'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_create'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_create'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'tipo_uso_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Vehiculos_TipoUso'), 'column' => 'id')),
      'tipo_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Vehiculos_Tipo'), 'column' => 'id')),
      'placa'               => new sfValidatorPass(array('required' => false)),
      'ano'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'marca'               => new sfValidatorPass(array('required' => false)),
      'modelo'              => new sfValidatorPass(array('required' => false)),
      'serial_carroceria'   => new sfValidatorPass(array('required' => false)),
      'serial_motor'        => new sfValidatorPass(array('required' => false)),
      'color'               => new sfValidatorPass(array('required' => false)),
      'kilometraje_inicial' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'kilometraje_actual'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'vel_max'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'              => new sfValidatorPass(array('required' => false)),
      'id_update'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_create'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'           => new sfValidatorPass(array('required' => false)),
      'ip_create'           => new sfValidatorPass(array('required' => false)),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('vehiculos_vehiculo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vehiculos_Vehiculo';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'tipo_uso_id'         => 'ForeignKey',
      'tipo_id'             => 'ForeignKey',
      'placa'               => 'Text',
      'ano'                 => 'Number',
      'marca'               => 'Text',
      'modelo'              => 'Text',
      'serial_carroceria'   => 'Text',
      'serial_motor'        => 'Text',
      'color'               => 'Text',
      'kilometraje_inicial' => 'Number',
      'kilometraje_actual'  => 'Number',
      'vel_max'             => 'Number',
      'status'              => 'Text',
      'id_update'           => 'Number',
      'id_create'           => 'Number',
      'ip_update'           => 'Text',
      'ip_create'           => 'Text',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
