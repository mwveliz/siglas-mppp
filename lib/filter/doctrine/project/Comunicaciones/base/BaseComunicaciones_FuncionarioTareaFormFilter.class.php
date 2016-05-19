<?php

/**
 * Comunicaciones_FuncionarioTarea filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseComunicaciones_FuncionarioTareaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'padre_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Comunicaciones_FuncionarioTarea'), 'add_empty' => true)),
      'funcionario_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'tarea_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Comunicaciones_Tarea'), 'add_empty' => true)),
      'resultado'             => new sfWidgetFormFilterInput(),
      'resultado_descripcion' => new sfWidgetFormFilterInput(),
      'status'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'padre_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Comunicaciones_FuncionarioTarea'), 'column' => 'id')),
      'funcionario_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'tarea_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Comunicaciones_Tarea'), 'column' => 'id')),
      'resultado'             => new sfValidatorPass(array('required' => false)),
      'resultado_descripcion' => new sfValidatorPass(array('required' => false)),
      'status'                => new sfValidatorPass(array('required' => false)),
      'id_update'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'             => new sfValidatorPass(array('required' => false)),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('comunicaciones_funcionario_tarea_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comunicaciones_FuncionarioTarea';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'padre_id'              => 'ForeignKey',
      'funcionario_id'        => 'ForeignKey',
      'tarea_id'              => 'ForeignKey',
      'resultado'             => 'Text',
      'resultado_descripcion' => 'Text',
      'status'                => 'Text',
      'id_update'             => 'Number',
      'ip_update'             => 'Text',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
