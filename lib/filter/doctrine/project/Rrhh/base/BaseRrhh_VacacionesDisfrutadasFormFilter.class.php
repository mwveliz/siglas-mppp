<?php

/**
 * Rrhh_VacacionesDisfrutadas filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRrhh_VacacionesDisfrutadasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'vacaciones_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_Vacaciones'), 'add_empty' => true)),
      'correspondencia_solicitud_id' => new sfWidgetFormFilterInput(),
      'f_inicio_disfrute'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'f_fin_disfrute'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'f_retorno_disfrute'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'dias_solicitados'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dias_disfrute_habiles'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dias_disfrute_fin_semana'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dias_disfrute_no_laborales'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dias_disfrute_continuo'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'observaciones_descritas'      => new sfWidgetFormFilterInput(),
      'observaciones_automaticas'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dias_disfrute_ejecutados'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dias_pendientes'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'vacaciones_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rrhh_Vacaciones'), 'column' => 'id')),
      'correspondencia_solicitud_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'f_inicio_disfrute'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'f_fin_disfrute'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'f_retorno_disfrute'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'dias_solicitados'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dias_disfrute_habiles'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dias_disfrute_fin_semana'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dias_disfrute_no_laborales'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dias_disfrute_continuo'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'observaciones_descritas'      => new sfValidatorPass(array('required' => false)),
      'observaciones_automaticas'    => new sfValidatorPass(array('required' => false)),
      'dias_disfrute_ejecutados'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dias_pendientes'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'                       => new sfValidatorPass(array('required' => false)),
      'id_update'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'                    => new sfValidatorPass(array('required' => false)),
      'created_at'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('rrhh_vacaciones_disfrutadas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rrhh_VacacionesDisfrutadas';
  }

  public function getFields()
  {
    return array(
      'id'                           => 'Number',
      'vacaciones_id'                => 'ForeignKey',
      'correspondencia_solicitud_id' => 'Number',
      'f_inicio_disfrute'            => 'Date',
      'f_fin_disfrute'               => 'Date',
      'f_retorno_disfrute'           => 'Date',
      'dias_solicitados'             => 'Number',
      'dias_disfrute_habiles'        => 'Number',
      'dias_disfrute_fin_semana'     => 'Number',
      'dias_disfrute_no_laborales'   => 'Number',
      'dias_disfrute_continuo'       => 'Number',
      'observaciones_descritas'      => 'Text',
      'observaciones_automaticas'    => 'Text',
      'dias_disfrute_ejecutados'     => 'Number',
      'dias_pendientes'              => 'Number',
      'status'                       => 'Text',
      'id_update'                    => 'Number',
      'ip_update'                    => 'Text',
      'created_at'                   => 'Date',
      'updated_at'                   => 'Date',
    );
  }
}
