<?php

/**
 * Rrhh_Vacaciones filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRrhh_VacacionesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'configuraciones_vacaciones_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_Configuraciones'), 'add_empty' => true)),
      'funcionario_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'f_cumplimiento'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'periodo_vacacional'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'anios_laborales'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dias_disfrute_establecidos'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dias_disfrute_adicionales'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dias_disfrute_totales'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dias_disfrute_pendientes'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pagadas'                       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'f_abono'                       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'monto_abonado_concepto'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'configuraciones_vacaciones_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rrhh_Configuraciones'), 'column' => 'id')),
      'funcionario_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'f_cumplimiento'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'periodo_vacacional'            => new sfValidatorPass(array('required' => false)),
      'anios_laborales'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dias_disfrute_establecidos'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dias_disfrute_adicionales'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dias_disfrute_totales'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dias_disfrute_pendientes'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pagadas'                       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'f_abono'                       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'monto_abonado_concepto'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'status'                        => new sfValidatorPass(array('required' => false)),
      'id_update'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'                     => new sfValidatorPass(array('required' => false)),
      'created_at'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('rrhh_vacaciones_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rrhh_Vacaciones';
  }

  public function getFields()
  {
    return array(
      'id'                            => 'Number',
      'configuraciones_vacaciones_id' => 'ForeignKey',
      'funcionario_id'                => 'ForeignKey',
      'f_cumplimiento'                => 'Date',
      'periodo_vacacional'            => 'Text',
      'anios_laborales'               => 'Number',
      'dias_disfrute_establecidos'    => 'Number',
      'dias_disfrute_adicionales'     => 'Number',
      'dias_disfrute_totales'         => 'Number',
      'dias_disfrute_pendientes'      => 'Number',
      'pagadas'                       => 'Boolean',
      'f_abono'                       => 'Date',
      'monto_abonado_concepto'        => 'Number',
      'status'                        => 'Text',
      'id_update'                     => 'Number',
      'ip_update'                     => 'Text',
      'created_at'                    => 'Date',
      'updated_at'                    => 'Date',
    );
  }
}
