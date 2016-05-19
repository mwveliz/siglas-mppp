<?php

/**
 * Siglas_ServiciosPublicadosConfianza filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSiglas_ServiciosPublicadosConfianzaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'servicios_publicados_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_ServiciosPublicados'), 'add_empty' => true)),
      'servidor_confianza_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_ServidorConfianza'), 'add_empty' => true)),
      'notificacion'                 => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'parametros_salida_permitidos' => new sfWidgetFormFilterInput(),
      'puerta'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'so'                           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'agente'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pc'                           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_create'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_create'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'servicios_publicados_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Siglas_ServiciosPublicados'), 'column' => 'id')),
      'servidor_confianza_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Siglas_ServidorConfianza'), 'column' => 'id')),
      'notificacion'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'parametros_salida_permitidos' => new sfValidatorPass(array('required' => false)),
      'puerta'                       => new sfValidatorPass(array('required' => false)),
      'so'                           => new sfValidatorPass(array('required' => false)),
      'agente'                       => new sfValidatorPass(array('required' => false)),
      'pc'                           => new sfValidatorPass(array('required' => false)),
      'status'                       => new sfValidatorPass(array('required' => false)),
      'id_create'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_update'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_create'                    => new sfValidatorPass(array('required' => false)),
      'ip_update'                    => new sfValidatorPass(array('required' => false)),
      'created_at'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('siglas_servicios_publicados_confianza_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Siglas_ServiciosPublicadosConfianza';
  }

  public function getFields()
  {
    return array(
      'id'                           => 'Number',
      'servicios_publicados_id'      => 'ForeignKey',
      'servidor_confianza_id'        => 'ForeignKey',
      'notificacion'                 => 'Boolean',
      'parametros_salida_permitidos' => 'Text',
      'puerta'                       => 'Text',
      'so'                           => 'Text',
      'agente'                       => 'Text',
      'pc'                           => 'Text',
      'status'                       => 'Text',
      'id_create'                    => 'Number',
      'id_update'                    => 'Number',
      'ip_create'                    => 'Text',
      'ip_update'                    => 'Text',
      'created_at'                   => 'Date',
      'updated_at'                   => 'Date',
    );
  }
}
