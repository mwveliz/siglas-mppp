<?php

/**
 * Siglas_InteroperabilidadEnviada filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSiglas_InteroperabilidadEnviadaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'servidor_confianza_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_ServidorConfianza'), 'add_empty' => true)),
      'servidor_certificado_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_ServidorCertificado'), 'add_empty' => true)),
      'interoperabilidad_recibida_id' => new sfWidgetFormFilterInput(),
      'tipo'                          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parametros'                    => new sfWidgetFormFilterInput(),
      'firma'                         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cadena'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'paquete'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'partes'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parte'                         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_create'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_create'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'servidor_confianza_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Siglas_ServidorConfianza'), 'column' => 'id')),
      'servidor_certificado_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Siglas_ServidorCertificado'), 'column' => 'id')),
      'interoperabilidad_recibida_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tipo'                          => new sfValidatorPass(array('required' => false)),
      'parametros'                    => new sfValidatorPass(array('required' => false)),
      'firma'                         => new sfValidatorPass(array('required' => false)),
      'cadena'                        => new sfValidatorPass(array('required' => false)),
      'paquete'                       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'partes'                        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'parte'                         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'                        => new sfValidatorPass(array('required' => false)),
      'id_create'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_create'                     => new sfValidatorPass(array('required' => false)),
      'created_at'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('siglas_interoperabilidad_enviada_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Siglas_InteroperabilidadEnviada';
  }

  public function getFields()
  {
    return array(
      'id'                            => 'Number',
      'servidor_confianza_id'         => 'ForeignKey',
      'servidor_certificado_id'       => 'ForeignKey',
      'interoperabilidad_recibida_id' => 'Number',
      'tipo'                          => 'Text',
      'parametros'                    => 'Text',
      'firma'                         => 'Text',
      'cadena'                        => 'Text',
      'paquete'                       => 'Number',
      'partes'                        => 'Number',
      'parte'                         => 'Number',
      'status'                        => 'Text',
      'id_create'                     => 'Number',
      'ip_create'                     => 'Text',
      'created_at'                    => 'Date',
      'updated_at'                    => 'Date',
    );
  }
}
