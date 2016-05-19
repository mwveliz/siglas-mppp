<?php

/**
 * Siglas_InteroperabilidadEnviada form base class.
 *
 * @method Siglas_InteroperabilidadEnviada getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSiglas_InteroperabilidadEnviadaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                            => new sfWidgetFormInputHidden(),
      'servidor_confianza_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_ServidorConfianza'), 'add_empty' => false)),
      'servidor_certificado_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_ServidorCertificado'), 'add_empty' => false)),
      'interoperabilidad_recibida_id' => new sfWidgetFormInputText(),
      'tipo'                          => new sfWidgetFormTextarea(),
      'parametros'                    => new sfWidgetFormTextarea(),
      'firma'                         => new sfWidgetFormTextarea(),
      'cadena'                        => new sfWidgetFormTextarea(),
      'paquete'                       => new sfWidgetFormInputText(),
      'partes'                        => new sfWidgetFormInputText(),
      'parte'                         => new sfWidgetFormInputText(),
      'status'                        => new sfWidgetFormInputText(),
      'id_create'                     => new sfWidgetFormInputText(),
      'ip_create'                     => new sfWidgetFormInputText(),
      'created_at'                    => new sfWidgetFormDateTime(),
      'updated_at'                    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'servidor_confianza_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_ServidorConfianza'))),
      'servidor_certificado_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_ServidorCertificado'))),
      'interoperabilidad_recibida_id' => new sfValidatorInteger(array('required' => false)),
      'tipo'                          => new sfValidatorString(),
      'parametros'                    => new sfValidatorString(array('required' => false)),
      'firma'                         => new sfValidatorString(),
      'cadena'                        => new sfValidatorString(),
      'paquete'                       => new sfValidatorInteger(),
      'partes'                        => new sfValidatorInteger(),
      'parte'                         => new sfValidatorInteger(),
      'status'                        => new sfValidatorString(array('max_length' => 1)),
      'id_create'                     => new sfValidatorInteger(),
      'ip_create'                     => new sfValidatorString(array('max_length' => 30)),
      'created_at'                    => new sfValidatorDateTime(),
      'updated_at'                    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('siglas_interoperabilidad_enviada[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Siglas_InteroperabilidadEnviada';
  }

}
