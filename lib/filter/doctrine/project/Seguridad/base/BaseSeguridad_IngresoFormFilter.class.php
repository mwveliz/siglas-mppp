<?php

/**
 * Seguridad_Ingreso filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSeguridad_IngresoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'persona_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Persona'), 'add_empty' => true)),
      'preingreso_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Preingreso'), 'add_empty' => true)),
      'imagen'           => new sfWidgetFormFilterInput(),
      'unidad_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => true)),
      'funcionario_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'llave_ingreso_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_LlaveIngreso'), 'add_empty' => true)),
      'f_ingreso'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'f_egreso'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'motivo_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Motivo'), 'add_empty' => true)),
      'motivo_visita'    => new sfWidgetFormFilterInput(),
      'registrador_id'   => new sfWidgetFormFilterInput(),
      'despachador_id'   => new sfWidgetFormFilterInput(),
      'status'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'persona_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Seguridad_Persona'), 'column' => 'id')),
      'preingreso_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Seguridad_Preingreso'), 'column' => 'id')),
      'imagen'           => new sfValidatorPass(array('required' => false)),
      'unidad_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Unidad'), 'column' => 'id')),
      'funcionario_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'llave_ingreso_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Seguridad_LlaveIngreso'), 'column' => 'id')),
      'f_ingreso'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'f_egreso'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'motivo_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Seguridad_Motivo'), 'column' => 'id')),
      'motivo_visita'    => new sfValidatorPass(array('required' => false)),
      'registrador_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'despachador_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'           => new sfValidatorPass(array('required' => false)),
      'id_update'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'        => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('seguridad_ingreso_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seguridad_Ingreso';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'persona_id'       => 'ForeignKey',
      'preingreso_id'    => 'ForeignKey',
      'imagen'           => 'Text',
      'unidad_id'        => 'ForeignKey',
      'funcionario_id'   => 'ForeignKey',
      'llave_ingreso_id' => 'ForeignKey',
      'f_ingreso'        => 'Date',
      'f_egreso'         => 'Date',
      'motivo_id'        => 'ForeignKey',
      'motivo_visita'    => 'Text',
      'registrador_id'   => 'Number',
      'despachador_id'   => 'Number',
      'status'           => 'Text',
      'id_update'        => 'Number',
      'ip_update'        => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
