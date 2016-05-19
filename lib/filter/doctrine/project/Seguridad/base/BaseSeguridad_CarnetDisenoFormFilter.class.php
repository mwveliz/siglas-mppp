<?php

/**
 * Seguridad_CarnetDiseno filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSeguridad_CarnetDisenoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'carnet_tipo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_CarnetTipo'), 'add_empty' => true)),
      'indices'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'imagen_fondo'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parametros'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_create'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'      => new sfWidgetFormFilterInput(),
      'ip_update'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'carnet_tipo_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Seguridad_CarnetTipo'), 'column' => 'id')),
      'indices'        => new sfValidatorPass(array('required' => false)),
      'imagen_fondo'   => new sfValidatorPass(array('required' => false)),
      'parametros'     => new sfValidatorPass(array('required' => false)),
      'status'         => new sfValidatorPass(array('required' => false)),
      'id_create'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_update'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'      => new sfValidatorPass(array('required' => false)),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('seguridad_carnet_diseno_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seguridad_CarnetDiseno';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'carnet_tipo_id' => 'ForeignKey',
      'indices'        => 'Text',
      'imagen_fondo'   => 'Text',
      'parametros'     => 'Text',
      'status'         => 'Text',
      'id_create'      => 'Number',
      'id_update'      => 'Number',
      'ip_update'      => 'Text',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
