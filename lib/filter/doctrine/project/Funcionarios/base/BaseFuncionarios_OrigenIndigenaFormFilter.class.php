<?php

/**
 * Funcionarios_OrigenIndigena filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_OrigenIndigenaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'funcionario_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'etnia_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Etnia'), 'add_empty' => true)),
      'estado_etnia_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nacimiento'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'f_validado'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_validado'     => new sfWidgetFormFilterInput(),
      'status'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'funcionario_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'etnia_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Public_Etnia'), 'column' => 'id')),
      'estado_etnia_id' => new sfValidatorPass(array('required' => false)),
      'nacimiento'      => new sfValidatorPass(array('required' => false)),
      'f_validado'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'id_validado'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'          => new sfValidatorPass(array('required' => false)),
      'id_update'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'       => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_origen_indigena_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_OrigenIndigena';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'funcionario_id'  => 'ForeignKey',
      'etnia_id'        => 'ForeignKey',
      'estado_etnia_id' => 'Text',
      'nacimiento'      => 'Text',
      'f_validado'      => 'Date',
      'id_validado'     => 'Number',
      'status'          => 'Text',
      'id_update'       => 'Number',
      'ip_update'       => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
