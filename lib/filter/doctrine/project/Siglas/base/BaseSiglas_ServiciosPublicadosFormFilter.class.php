<?php

/**
 * Siglas_ServiciosPublicados filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSiglas_ServiciosPublicadosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'funcion'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'crontab'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'recursos'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parametros_entrada' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parametros_salida'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'puerta'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'so'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'agente'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pc'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_create'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_create'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'funcion'            => new sfValidatorPass(array('required' => false)),
      'descripcion'        => new sfValidatorPass(array('required' => false)),
      'tipo'               => new sfValidatorPass(array('required' => false)),
      'crontab'            => new sfValidatorPass(array('required' => false)),
      'recursos'           => new sfValidatorPass(array('required' => false)),
      'url'                => new sfValidatorPass(array('required' => false)),
      'parametros_entrada' => new sfValidatorPass(array('required' => false)),
      'parametros_salida'  => new sfValidatorPass(array('required' => false)),
      'puerta'             => new sfValidatorPass(array('required' => false)),
      'so'                 => new sfValidatorPass(array('required' => false)),
      'agente'             => new sfValidatorPass(array('required' => false)),
      'pc'                 => new sfValidatorPass(array('required' => false)),
      'status'             => new sfValidatorPass(array('required' => false)),
      'id_create'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_update'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_create'          => new sfValidatorPass(array('required' => false)),
      'ip_update'          => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('siglas_servicios_publicados_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Siglas_ServiciosPublicados';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'funcion'            => 'Text',
      'descripcion'        => 'Text',
      'tipo'               => 'Text',
      'crontab'            => 'Text',
      'recursos'           => 'Text',
      'url'                => 'Text',
      'parametros_entrada' => 'Text',
      'parametros_salida'  => 'Text',
      'puerta'             => 'Text',
      'so'                 => 'Text',
      'agente'             => 'Text',
      'pc'                 => 'Text',
      'status'             => 'Text',
      'id_create'          => 'Number',
      'id_update'          => 'Number',
      'ip_create'          => 'Text',
      'ip_update'          => 'Text',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
