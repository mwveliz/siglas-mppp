<?php

/**
 * Siglas_ServiciosDisponibles form base class.
 *
 * @method Siglas_ServiciosDisponibles getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSiglas_ServiciosDisponiblesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'servidor_confianza_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_ServidorConfianza'), 'add_empty' => false)),
      'funcion'               => new sfWidgetFormInputText(),
      'descripcion'           => new sfWidgetFormTextarea(),
      'tipo'                  => new sfWidgetFormTextarea(),
      'crontab'               => new sfWidgetFormTextarea(),
      'recursos'              => new sfWidgetFormTextarea(),
      'parametros_entrada'    => new sfWidgetFormTextarea(),
      'parametros_salida'     => new sfWidgetFormTextarea(),
      'puerta'                => new sfWidgetFormTextarea(),
      'so'                    => new sfWidgetFormTextarea(),
      'agente'                => new sfWidgetFormTextarea(),
      'pc'                    => new sfWidgetFormTextarea(),
      'status'                => new sfWidgetFormInputText(),
      'id_create'             => new sfWidgetFormInputText(),
      'id_update'             => new sfWidgetFormInputText(),
      'ip_create'             => new sfWidgetFormInputText(),
      'ip_update'             => new sfWidgetFormInputText(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'servidor_confianza_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_ServidorConfianza'))),
      'funcion'               => new sfValidatorString(array('max_length' => 255)),
      'descripcion'           => new sfValidatorString(),
      'tipo'                  => new sfValidatorString(),
      'crontab'               => new sfValidatorString(),
      'recursos'              => new sfValidatorString(),
      'parametros_entrada'    => new sfValidatorString(),
      'parametros_salida'     => new sfValidatorString(),
      'puerta'                => new sfValidatorString(),
      'so'                    => new sfValidatorString(),
      'agente'                => new sfValidatorString(),
      'pc'                    => new sfValidatorString(),
      'status'                => new sfValidatorString(array('max_length' => 1)),
      'id_create'             => new sfValidatorInteger(),
      'id_update'             => new sfValidatorInteger(),
      'ip_create'             => new sfValidatorString(array('max_length' => 30)),
      'ip_update'             => new sfValidatorString(array('max_length' => 30)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('siglas_servicios_disponibles[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Siglas_ServiciosDisponibles';
  }

}
