<?php

/**
 * Rrhh_Permisos filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRrhh_PermisosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'configuraciones_permisos_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_Configuraciones'), 'add_empty' => true)),
      'funcionario_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'correspondencia_solicitud_id'   => new sfWidgetFormFilterInput(),
      'tipo_permiso'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'f_inicio_permiso'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'f_fin_permiso'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'f_retorno_permiso'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'dias_solicitados'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dias_permiso_habiles'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dias_permiso_fin_semana'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dias_permiso_no_laborales'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dias_permiso_continuo'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'observaciones_descritas'        => new sfWidgetFormFilterInput(),
      'observaciones_automaticas'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'correspondencia_cancelacion_id' => new sfWidgetFormFilterInput(),
      'motivo_cancelacion'             => new sfWidgetFormFilterInput(),
      'dias_permiso_ejecutados'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'                         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'clasificacion'                  => new sfWidgetFormFilterInput(),
      'created_at'                     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'configuraciones_permisos_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rrhh_Configuraciones'), 'column' => 'id')),
      'funcionario_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'correspondencia_solicitud_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tipo_permiso'                   => new sfValidatorPass(array('required' => false)),
      'f_inicio_permiso'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'f_fin_permiso'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'f_retorno_permiso'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'dias_solicitados'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'dias_permiso_habiles'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'dias_permiso_fin_semana'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dias_permiso_no_laborales'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dias_permiso_continuo'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'observaciones_descritas'        => new sfValidatorPass(array('required' => false)),
      'observaciones_automaticas'      => new sfValidatorPass(array('required' => false)),
      'correspondencia_cancelacion_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'motivo_cancelacion'             => new sfValidatorPass(array('required' => false)),
      'dias_permiso_ejecutados'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'status'                         => new sfValidatorPass(array('required' => false)),
      'id_update'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'                      => new sfValidatorPass(array('required' => false)),
      'clasificacion'                  => new sfValidatorPass(array('required' => false)),
      'created_at'                     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('rrhh_permisos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rrhh_Permisos';
  }

  public function getFields()
  {
    return array(
      'id'                             => 'Number',
      'configuraciones_permisos_id'    => 'ForeignKey',
      'funcionario_id'                 => 'ForeignKey',
      'correspondencia_solicitud_id'   => 'Number',
      'tipo_permiso'                   => 'Text',
      'f_inicio_permiso'               => 'Date',
      'f_fin_permiso'                  => 'Date',
      'f_retorno_permiso'              => 'Date',
      'dias_solicitados'               => 'Number',
      'dias_permiso_habiles'           => 'Number',
      'dias_permiso_fin_semana'        => 'Number',
      'dias_permiso_no_laborales'      => 'Number',
      'dias_permiso_continuo'          => 'Number',
      'observaciones_descritas'        => 'Text',
      'observaciones_automaticas'      => 'Text',
      'correspondencia_cancelacion_id' => 'Number',
      'motivo_cancelacion'             => 'Text',
      'dias_permiso_ejecutados'        => 'Number',
      'status'                         => 'Text',
      'id_update'                      => 'Number',
      'ip_update'                      => 'Text',
      'clasificacion'                  => 'Text',
      'created_at'                     => 'Date',
      'updated_at'                     => 'Date',
    );
  }
}
