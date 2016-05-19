<?php

/**
 * Correspondencia_FuncionarioUnidad filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_FuncionarioUnidadFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'autorizada_unidad_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => true)),
      'funcionario_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'dependencia_unidad_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'redactar'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'leer'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'firmar'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'recibir'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'permitido'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'permitido_funcionario' => new sfWidgetFormFilterInput(),
      'administrar'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'status'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'deleted_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_update'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'autorizada_unidad_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Unidad'), 'column' => 'id')),
      'funcionario_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'dependencia_unidad_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'redactar'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'leer'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'firmar'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'recibir'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'permitido'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'permitido_funcionario' => new sfValidatorPass(array('required' => false)),
      'administrar'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'status'                => new sfValidatorPass(array('required' => false)),
      'deleted_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'id_update'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_funcionario_unidad_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_FuncionarioUnidad';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'autorizada_unidad_id'  => 'ForeignKey',
      'funcionario_id'        => 'ForeignKey',
      'dependencia_unidad_id' => 'Number',
      'redactar'              => 'Boolean',
      'leer'                  => 'Boolean',
      'firmar'                => 'Boolean',
      'recibir'               => 'Boolean',
      'permitido'             => 'Boolean',
      'permitido_funcionario' => 'Text',
      'administrar'           => 'Boolean',
      'status'                => 'Text',
      'deleted_at'            => 'Date',
      'id_update'             => 'Number',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
