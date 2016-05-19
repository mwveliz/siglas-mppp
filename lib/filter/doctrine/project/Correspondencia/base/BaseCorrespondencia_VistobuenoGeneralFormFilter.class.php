<?php

/**
 * Correspondencia_VistobuenoGeneral filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_VistobuenoGeneralFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'vistobueno_general_config_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_VistobuenoGeneralConfig'), 'add_empty' => true)),
      'funcionario_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'funcionario_cargo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Cargo'), 'add_empty' => true)),
      'orden'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_create'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_create'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'vistobueno_general_config_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Correspondencia_VistobuenoGeneralConfig'), 'column' => 'id')),
      'funcionario_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'funcionario_cargo_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Cargo'), 'column' => 'id')),
      'orden'                        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'                       => new sfValidatorPass(array('required' => false)),
      'id_update'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_create'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'                    => new sfValidatorPass(array('required' => false)),
      'ip_create'                    => new sfValidatorPass(array('required' => false)),
      'created_at'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_vistobueno_general_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_VistobuenoGeneral';
  }

  public function getFields()
  {
    return array(
      'id'                           => 'Number',
      'vistobueno_general_config_id' => 'ForeignKey',
      'funcionario_id'               => 'ForeignKey',
      'funcionario_cargo_id'         => 'ForeignKey',
      'orden'                        => 'Number',
      'status'                       => 'Text',
      'id_update'                    => 'Number',
      'id_create'                    => 'Number',
      'ip_update'                    => 'Text',
      'ip_create'                    => 'Text',
      'created_at'                   => 'Date',
      'updated_at'                   => 'Date',
    );
  }
}
