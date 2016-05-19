<?php

/**
 * Funcionarios_FuncionarioCargoCertificado filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_FuncionarioCargoCertificadoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'funcionario_cargo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioCargo'), 'add_empty' => true)),
      'certificado'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'detalles_tecnicos'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configuraciones'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'f_valido_desde'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'f_valido_hasta'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'status'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_create'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'            => new sfWidgetFormFilterInput(),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'funcionario_cargo_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_FuncionarioCargo'), 'column' => 'id')),
      'certificado'          => new sfValidatorPass(array('required' => false)),
      'detalles_tecnicos'    => new sfValidatorPass(array('required' => false)),
      'configuraciones'      => new sfValidatorPass(array('required' => false)),
      'f_valido_desde'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'f_valido_hasta'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'status'               => new sfValidatorPass(array('required' => false)),
      'id_update'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_create'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'            => new sfValidatorPass(array('required' => false)),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_funcionario_cargo_certificado_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_FuncionarioCargoCertificado';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'funcionario_cargo_id' => 'ForeignKey',
      'certificado'          => 'Text',
      'detalles_tecnicos'    => 'Text',
      'configuraciones'      => 'Text',
      'f_valido_desde'       => 'Date',
      'f_valido_hasta'       => 'Date',
      'status'               => 'Text',
      'id_update'            => 'Number',
      'id_create'            => 'Number',
      'ip_update'            => 'Text',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
