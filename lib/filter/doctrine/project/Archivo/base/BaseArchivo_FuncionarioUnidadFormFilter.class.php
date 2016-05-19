<?php

/**
 * Archivo_FuncionarioUnidad filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArchivo_FuncionarioUnidadFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'autorizada_unidad_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad_ForAutorizadaUnidad'), 'add_empty' => true)),
      'funcionario_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'dependencia_unidad_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad_ForDependenciaUnidad'), 'add_empty' => true)),
      'leer'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'archivar'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'prestar'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'anular'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'administrar'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'status'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'permitido'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'permitido_funcionario' => new sfWidgetFormFilterInput(),
      'deleted_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_update'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'autorizada_unidad_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Unidad_ForAutorizadaUnidad'), 'column' => 'id')),
      'funcionario_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'dependencia_unidad_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Unidad_ForDependenciaUnidad'), 'column' => 'id')),
      'leer'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'archivar'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'prestar'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'anular'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'administrar'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'status'                => new sfValidatorPass(array('required' => false)),
      'permitido'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'permitido_funcionario' => new sfValidatorPass(array('required' => false)),
      'deleted_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'id_update'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'             => new sfValidatorPass(array('required' => false)),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('archivo_funcionario_unidad_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_FuncionarioUnidad';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'autorizada_unidad_id'  => 'ForeignKey',
      'funcionario_id'        => 'ForeignKey',
      'dependencia_unidad_id' => 'ForeignKey',
      'leer'                  => 'Boolean',
      'archivar'              => 'Boolean',
      'prestar'               => 'Boolean',
      'anular'                => 'Boolean',
      'administrar'           => 'Boolean',
      'status'                => 'Text',
      'permitido'             => 'Boolean',
      'permitido_funcionario' => 'Text',
      'deleted_at'            => 'Date',
      'id_update'             => 'Number',
      'ip_update'             => 'Text',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
