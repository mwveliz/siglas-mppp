<?php

/**
 * Comunicaciones_NotificacionHistorico filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseComunicaciones_NotificacionHistoricoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'funcionario_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'aplicacion_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_Aplicacion'), 'add_empty' => true)),
      'forma_entrega'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'metodo_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Comunicaciones_Metodo'), 'add_empty' => true)),
      'f_entrega'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'parametros'     => new sfWidgetFormFilterInput(),
      'mensaje'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'id_update'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'funcionario_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'aplicacion_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Acceso_Aplicacion'), 'column' => 'id')),
      'forma_entrega'  => new sfValidatorPass(array('required' => false)),
      'metodo_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Comunicaciones_Metodo'), 'column' => 'id')),
      'f_entrega'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'parametros'     => new sfValidatorPass(array('required' => false)),
      'mensaje'        => new sfValidatorPass(array('required' => false)),
      'status'         => new sfValidatorPass(array('required' => false)),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'id_update'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('comunicaciones_notificacion_historico_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comunicaciones_NotificacionHistorico';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'funcionario_id' => 'Number',
      'aplicacion_id'  => 'ForeignKey',
      'forma_entrega'  => 'Text',
      'metodo_id'      => 'ForeignKey',
      'f_entrega'      => 'Date',
      'parametros'     => 'Text',
      'mensaje'        => 'Text',
      'status'         => 'Text',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
      'id_update'      => 'Number',
      'ip_update'      => 'Text',
    );
  }
}
