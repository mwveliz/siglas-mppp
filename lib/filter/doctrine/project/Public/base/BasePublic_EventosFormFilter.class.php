<?php

/**
 * Public_Eventos filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePublic_EventosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'unidad_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => true)),
      'cargo_id'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'funcionario_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'titulo'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'f_inicio'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'f_final'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'motivo_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Motivo'), 'add_empty' => true)),
      'funcionario_delegado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioDelegado'), 'add_empty' => true)),
      'dia'                     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'institucional'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'id_update'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_create'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'unidad_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Unidad'), 'column' => 'id')),
      'cargo_id'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'funcionario_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'titulo'                  => new sfValidatorPass(array('required' => false)),
      'f_inicio'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'f_final'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'motivo_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Seguridad_Motivo'), 'column' => 'id')),
      'funcionario_delegado_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_FuncionarioDelegado'), 'column' => 'id')),
      'dia'                     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'institucional'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'id_update'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'               => new sfValidatorPass(array('required' => false)),
      'ip_create'               => new sfValidatorPass(array('required' => false)),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('public_eventos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_Eventos';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'unidad_id'               => 'ForeignKey',
      'cargo_id'                => 'Number',
      'funcionario_id'          => 'ForeignKey',
      'titulo'                  => 'Text',
      'f_inicio'                => 'Date',
      'f_final'                 => 'Date',
      'motivo_id'               => 'ForeignKey',
      'funcionario_delegado_id' => 'ForeignKey',
      'dia'                     => 'Boolean',
      'institucional'           => 'Boolean',
      'id_update'               => 'Number',
      'ip_update'               => 'Text',
      'ip_create'               => 'Text',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
    );
  }
}
