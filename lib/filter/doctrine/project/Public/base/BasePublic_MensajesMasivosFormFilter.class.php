<?php

/**
 * Public_MensajesMasivos filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePublic_MensajesMasivosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'variables'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'destinatarios' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prioridad'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'total'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'procesados'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cola'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'modem_emisor'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'variables'     => new sfValidatorPass(array('required' => false)),
      'destinatarios' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'prioridad'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'procesados'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cola'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'        => new sfValidatorPass(array('required' => false)),
      'modem_emisor'  => new sfValidatorPass(array('required' => false)),
      'id_update'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('public_mensajes_masivos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_MensajesMasivos';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'variables'     => 'Text',
      'mensajes_id'   => 'Number',
      'destinatarios' => 'Number',
      'prioridad'     => 'Number',
      'total'         => 'Number',
      'procesados'    => 'Number',
      'cola'          => 'Number',
      'status'        => 'Text',
      'modem_emisor'  => 'Text',
      'id_update'     => 'Number',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
