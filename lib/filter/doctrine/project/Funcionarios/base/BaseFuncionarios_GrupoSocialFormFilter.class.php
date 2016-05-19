<?php

/**
 * Funcionarios_GrupoSocial filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_GrupoSocialFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'funcionario_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'tipo_grupo_social_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_TipoGrupoSocial'), 'add_empty' => true)),
      'nombre'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'          => new sfWidgetFormFilterInput(),
      'f_validado'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_validado'          => new sfWidgetFormFilterInput(),
      'status'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'funcionario_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'tipo_grupo_social_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Public_TipoGrupoSocial'), 'column' => 'id')),
      'nombre'               => new sfValidatorPass(array('required' => false)),
      'descripcion'          => new sfValidatorPass(array('required' => false)),
      'f_validado'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'id_validado'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'               => new sfValidatorPass(array('required' => false)),
      'id_update'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'            => new sfValidatorPass(array('required' => false)),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_grupo_social_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_GrupoSocial';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'funcionario_id'       => 'ForeignKey',
      'tipo_grupo_social_id' => 'ForeignKey',
      'nombre'               => 'Text',
      'descripcion'          => 'Text',
      'f_validado'           => 'Date',
      'id_validado'          => 'Number',
      'status'               => 'Text',
      'id_update'            => 'Number',
      'ip_update'            => 'Text',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
