<?php

/**
 * Funcionarios_Funcionario filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_FuncionarioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ci'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'primer_nombre'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'segundo_nombre'         => new sfWidgetFormFilterInput(),
      'primer_apellido'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'segundo_apellido'       => new sfWidgetFormFilterInput(),
      'f_nacimiento'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'estado_nacimiento_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Estado'), 'add_empty' => true)),
      'sexo'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'edo_civil'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'telf_movil'             => new sfWidgetFormFilterInput(),
      'telf_fijo'              => new sfWidgetFormFilterInput(),
      'email_validado'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'email_institucional'    => new sfWidgetFormFilterInput(),
      'email_personal'         => new sfWidgetFormFilterInput(),
      'codigo_validador_email' => new sfWidgetFormFilterInput(),
      'codigo_validador_telf'  => new sfWidgetFormFilterInput(),
      'status'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'ci'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'primer_nombre'          => new sfValidatorPass(array('required' => false)),
      'segundo_nombre'         => new sfValidatorPass(array('required' => false)),
      'primer_apellido'        => new sfValidatorPass(array('required' => false)),
      'segundo_apellido'       => new sfValidatorPass(array('required' => false)),
      'f_nacimiento'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'estado_nacimiento_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Public_Estado'), 'column' => 'id')),
      'sexo'                   => new sfValidatorPass(array('required' => false)),
      'edo_civil'              => new sfValidatorPass(array('required' => false)),
      'telf_movil'             => new sfValidatorPass(array('required' => false)),
      'telf_fijo'              => new sfValidatorPass(array('required' => false)),
      'email_validado'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'email_institucional'    => new sfValidatorPass(array('required' => false)),
      'email_personal'         => new sfValidatorPass(array('required' => false)),
      'codigo_validador_email' => new sfValidatorPass(array('required' => false)),
      'codigo_validador_telf'  => new sfValidatorPass(array('required' => false)),
      'status'                 => new sfValidatorPass(array('required' => false)),
      'id_update'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_funcionario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_Funcionario';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'ci'                     => 'Number',
      'primer_nombre'          => 'Text',
      'segundo_nombre'         => 'Text',
      'primer_apellido'        => 'Text',
      'segundo_apellido'       => 'Text',
      'f_nacimiento'           => 'Date',
      'estado_nacimiento_id'   => 'ForeignKey',
      'sexo'                   => 'Text',
      'edo_civil'              => 'Text',
      'telf_movil'             => 'Text',
      'telf_fijo'              => 'Text',
      'email_validado'         => 'Boolean',
      'email_institucional'    => 'Text',
      'email_personal'         => 'Text',
      'codigo_validador_email' => 'Text',
      'codigo_validador_telf'  => 'Text',
      'status'                 => 'Text',
      'id_update'              => 'Number',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
