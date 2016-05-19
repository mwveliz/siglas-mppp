<?php

/**
 * Funcionarios_EducacionMedia filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_EducacionMediaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'funcionario_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'pais_id'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'organismo_educativo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'), 'add_empty' => true)),
      'especialidad_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Especialidad'), 'add_empty' => true)),
      'nivel_academico_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_NivelAcademico'), 'add_empty' => true)),
      'f_ingreso'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'f_graduado'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'estudiando_actualmente' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'f_validado'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_validado'            => new sfWidgetFormFilterInput(),
      'status'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'proteccion'             => new sfWidgetFormFilterInput(),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'funcionario_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'pais_id'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'organismo_educativo_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organismos_Organismo'), 'column' => 'id')),
      'especialidad_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Public_Especialidad'), 'column' => 'id')),
      'nivel_academico_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Public_NivelAcademico'), 'column' => 'id')),
      'f_ingreso'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'f_graduado'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'estudiando_actualmente' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'f_validado'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'id_validado'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'                 => new sfValidatorPass(array('required' => false)),
      'id_update'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'              => new sfValidatorPass(array('required' => false)),
      'proteccion'             => new sfValidatorPass(array('required' => false)),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_educacion_media_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_EducacionMedia';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'funcionario_id'         => 'ForeignKey',
      'pais_id'                => 'Number',
      'organismo_educativo_id' => 'ForeignKey',
      'especialidad_id'        => 'ForeignKey',
      'nivel_academico_id'     => 'ForeignKey',
      'f_ingreso'              => 'Date',
      'f_graduado'             => 'Date',
      'estudiando_actualmente' => 'Boolean',
      'f_validado'             => 'Date',
      'id_validado'            => 'Number',
      'status'                 => 'Text',
      'id_update'              => 'Number',
      'ip_update'              => 'Text',
      'proteccion'             => 'Text',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
