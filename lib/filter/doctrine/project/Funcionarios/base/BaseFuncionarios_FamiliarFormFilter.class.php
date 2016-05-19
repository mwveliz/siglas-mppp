<?php

/**
 * Funcionarios_Familiar filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_FamiliarFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'funcionario_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'parentesco_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Parentesco'), 'add_empty' => true)),
      'ci'                 => new sfWidgetFormFilterInput(),
      'primer_nombre'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'segundo_nombre'     => new sfWidgetFormFilterInput(),
      'primer_apellido'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'segundo_apellido'   => new sfWidgetFormFilterInput(),
      'f_nacimiento'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'nacionalidad'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sexo'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nivel_academico_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_NivelAcademico'), 'add_empty' => true)),
      'estudia'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'trabaja'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'dependencia'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'f_validado'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_validado'        => new sfWidgetFormFilterInput(),
      'status'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'proteccion'         => new sfWidgetFormFilterInput(),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'funcionario_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'parentesco_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Public_Parentesco'), 'column' => 'id')),
      'ci'                 => new sfValidatorPass(array('required' => false)),
      'primer_nombre'      => new sfValidatorPass(array('required' => false)),
      'segundo_nombre'     => new sfValidatorPass(array('required' => false)),
      'primer_apellido'    => new sfValidatorPass(array('required' => false)),
      'segundo_apellido'   => new sfValidatorPass(array('required' => false)),
      'f_nacimiento'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nacionalidad'       => new sfValidatorPass(array('required' => false)),
      'sexo'               => new sfValidatorPass(array('required' => false)),
      'nivel_academico_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Public_NivelAcademico'), 'column' => 'id')),
      'estudia'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'trabaja'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'dependencia'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'f_validado'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'id_validado'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'             => new sfValidatorPass(array('required' => false)),
      'id_update'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'          => new sfValidatorPass(array('required' => false)),
      'proteccion'         => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_familiar_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_Familiar';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'funcionario_id'     => 'ForeignKey',
      'parentesco_id'      => 'ForeignKey',
      'ci'                 => 'Text',
      'primer_nombre'      => 'Text',
      'segundo_nombre'     => 'Text',
      'primer_apellido'    => 'Text',
      'segundo_apellido'   => 'Text',
      'f_nacimiento'       => 'Date',
      'nacionalidad'       => 'Text',
      'sexo'               => 'Text',
      'nivel_academico_id' => 'ForeignKey',
      'estudia'            => 'Boolean',
      'trabaja'            => 'Boolean',
      'dependencia'        => 'Boolean',
      'f_validado'         => 'Date',
      'id_validado'        => 'Number',
      'status'             => 'Text',
      'id_update'          => 'Number',
      'ip_update'          => 'Text',
      'proteccion'         => 'Text',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
