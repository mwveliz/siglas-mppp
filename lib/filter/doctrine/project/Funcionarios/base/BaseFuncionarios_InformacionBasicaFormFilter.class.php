<?php

/**
 * Funcionarios_InformacionBasica filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_InformacionBasicaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'funcionario_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'f_nacimiento'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'estado_nacimiento_id'        => new sfWidgetFormFilterInput(),
      'sexo'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'edo_civil'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'licencia_conducir_uno_grado' => new sfWidgetFormFilterInput(),
      'licencia_conducir_dos_grado' => new sfWidgetFormFilterInput(),
      'f_validado'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_validado'                 => new sfWidgetFormFilterInput(),
      'status'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'proteccion'                  => new sfWidgetFormFilterInput(),
      'created_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'funcionario_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'f_nacimiento'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'estado_nacimiento_id'        => new sfValidatorPass(array('required' => false)),
      'sexo'                        => new sfValidatorPass(array('required' => false)),
      'edo_civil'                   => new sfValidatorPass(array('required' => false)),
      'licencia_conducir_uno_grado' => new sfValidatorPass(array('required' => false)),
      'licencia_conducir_dos_grado' => new sfValidatorPass(array('required' => false)),
      'f_validado'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'id_validado'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'                      => new sfValidatorPass(array('required' => false)),
      'id_update'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'                   => new sfValidatorPass(array('required' => false)),
      'proteccion'                  => new sfValidatorPass(array('required' => false)),
      'created_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_informacion_basica_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_InformacionBasica';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'funcionario_id'              => 'ForeignKey',
      'f_nacimiento'                => 'Date',
      'estado_nacimiento_id'        => 'Text',
      'sexo'                        => 'Text',
      'edo_civil'                   => 'Text',
      'licencia_conducir_uno_grado' => 'Text',
      'licencia_conducir_dos_grado' => 'Text',
      'f_validado'                  => 'Date',
      'id_validado'                 => 'Number',
      'status'                      => 'Text',
      'id_update'                   => 'Number',
      'ip_update'                   => 'Text',
      'proteccion'                  => 'Text',
      'created_at'                  => 'Date',
      'updated_at'                  => 'Date',
    );
  }
}
