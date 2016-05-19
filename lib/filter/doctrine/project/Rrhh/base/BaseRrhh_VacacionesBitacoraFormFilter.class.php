<?php

/**
 * Rrhh_VacacionesBitacora filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRrhh_VacacionesBitacoraFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'vacaciones_disfrutadas_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_VacacionesDisfrutadas'), 'add_empty' => true)),
      'correspondencia_bitacora_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'reposos_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_Reposos'), 'add_empty' => true)),
      'f_retorno_real'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'dias_agregados_disfrute'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'vacaciones_disfrutadas_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rrhh_VacacionesDisfrutadas'), 'column' => 'id')),
      'correspondencia_bitacora_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tipo'                        => new sfValidatorPass(array('required' => false)),
      'reposos_id'                  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rrhh_Reposos'), 'column' => 'id')),
      'f_retorno_real'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'dias_agregados_disfrute'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'                      => new sfValidatorPass(array('required' => false)),
      'id_update'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'                   => new sfValidatorPass(array('required' => false)),
      'created_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('rrhh_vacaciones_bitacora_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rrhh_VacacionesBitacora';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'vacaciones_disfrutadas_id'   => 'ForeignKey',
      'correspondencia_bitacora_id' => 'Number',
      'tipo'                        => 'Text',
      'reposos_id'                  => 'ForeignKey',
      'f_retorno_real'              => 'Date',
      'dias_agregados_disfrute'     => 'Number',
      'status'                      => 'Text',
      'id_update'                   => 'Number',
      'ip_update'                   => 'Text',
      'created_at'                  => 'Date',
      'updated_at'                  => 'Date',
    );
  }
}
