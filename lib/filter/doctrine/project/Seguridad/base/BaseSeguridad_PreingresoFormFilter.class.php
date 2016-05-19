<?php

/**
 * Seguridad_Preingreso filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSeguridad_PreingresoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'unidad_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => true)),
      'funcionario_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'f_ingreso_posible_inicio' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'f_ingreso_posible_final'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'motivo_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Motivo'), 'add_empty' => true)),
      'motivo_visita'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_create'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'indices'                  => new sfWidgetFormFilterInput(),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'unidad_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Unidad'), 'column' => 'id')),
      'funcionario_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'f_ingreso_posible_inicio' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'f_ingreso_posible_final'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'motivo_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Seguridad_Motivo'), 'column' => 'id')),
      'motivo_visita'            => new sfValidatorPass(array('required' => false)),
      'status'                   => new sfValidatorPass(array('required' => false)),
      'id_create'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_update'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'                => new sfValidatorPass(array('required' => false)),
      'indices'                  => new sfValidatorPass(array('required' => false)),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('seguridad_preingreso_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seguridad_Preingreso';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'unidad_id'                => 'ForeignKey',
      'funcionario_id'           => 'ForeignKey',
      'f_ingreso_posible_inicio' => 'Date',
      'f_ingreso_posible_final'  => 'Date',
      'motivo_id'                => 'ForeignKey',
      'motivo_visita'            => 'Text',
      'status'                   => 'Text',
      'id_create'                => 'Number',
      'id_update'                => 'Number',
      'ip_update'                => 'Text',
      'indices'                  => 'Text',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
    );
  }
}
