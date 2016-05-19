<?php

/**
 * Funcionarios_Residencia filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_ResidenciaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'funcionario_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'estado_id'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'municipio_id'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parroquia_id'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dir_av_calle_esq'     => new sfWidgetFormFilterInput(),
      'dir_edf_casa'         => new sfWidgetFormFilterInput(),
      'dir_piso'             => new sfWidgetFormFilterInput(),
      'dir_apt_nombre'       => new sfWidgetFormFilterInput(),
      'dir_urbanizacion'     => new sfWidgetFormFilterInput(),
      'dir_ciudad'           => new sfWidgetFormFilterInput(),
      'dir_punto_referencia' => new sfWidgetFormFilterInput(),
      'telf_uno'             => new sfWidgetFormFilterInput(),
      'telf_dos'             => new sfWidgetFormFilterInput(),
      'f_validado'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_validado'          => new sfWidgetFormFilterInput(),
      'status'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'proteccion'           => new sfWidgetFormFilterInput(),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'funcionario_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'estado_id'            => new sfValidatorPass(array('required' => false)),
      'municipio_id'         => new sfValidatorPass(array('required' => false)),
      'parroquia_id'         => new sfValidatorPass(array('required' => false)),
      'dir_av_calle_esq'     => new sfValidatorPass(array('required' => false)),
      'dir_edf_casa'         => new sfValidatorPass(array('required' => false)),
      'dir_piso'             => new sfValidatorPass(array('required' => false)),
      'dir_apt_nombre'       => new sfValidatorPass(array('required' => false)),
      'dir_urbanizacion'     => new sfValidatorPass(array('required' => false)),
      'dir_ciudad'           => new sfValidatorPass(array('required' => false)),
      'dir_punto_referencia' => new sfValidatorPass(array('required' => false)),
      'telf_uno'             => new sfValidatorPass(array('required' => false)),
      'telf_dos'             => new sfValidatorPass(array('required' => false)),
      'f_validado'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'id_validado'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'               => new sfValidatorPass(array('required' => false)),
      'id_update'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'            => new sfValidatorPass(array('required' => false)),
      'proteccion'           => new sfValidatorPass(array('required' => false)),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_residencia_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_Residencia';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'funcionario_id'       => 'ForeignKey',
      'estado_id'            => 'Text',
      'municipio_id'         => 'Text',
      'parroquia_id'         => 'Text',
      'dir_av_calle_esq'     => 'Text',
      'dir_edf_casa'         => 'Text',
      'dir_piso'             => 'Text',
      'dir_apt_nombre'       => 'Text',
      'dir_urbanizacion'     => 'Text',
      'dir_ciudad'           => 'Text',
      'dir_punto_referencia' => 'Text',
      'telf_uno'             => 'Text',
      'telf_dos'             => 'Text',
      'f_validado'           => 'Date',
      'id_validado'          => 'Number',
      'status'               => 'Text',
      'id_update'            => 'Number',
      'ip_update'            => 'Text',
      'proteccion'           => 'Text',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
