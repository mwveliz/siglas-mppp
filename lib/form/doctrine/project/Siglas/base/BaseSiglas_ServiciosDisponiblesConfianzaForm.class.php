<?php

/**
 * Siglas_ServiciosDisponiblesConfianza form base class.
 *
 * @method Siglas_ServiciosDisponiblesConfianza getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSiglas_ServiciosDisponiblesConfianzaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'servicios_disponibles_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_ServiciosDisponibles'), 'add_empty' => false)),
      'ip_permitida'             => new sfWidgetFormInputText(),
      'detalles_maquina'         => new sfWidgetFormTextarea(),
      'puerta'                   => new sfWidgetFormTextarea(),
      'so'                       => new sfWidgetFormTextarea(),
      'agente'                   => new sfWidgetFormTextarea(),
      'pc'                       => new sfWidgetFormTextarea(),
      'status'                   => new sfWidgetFormInputText(),
      'id_create'                => new sfWidgetFormInputText(),
      'id_update'                => new sfWidgetFormInputText(),
      'ip_create'                => new sfWidgetFormInputText(),
      'ip_update'                => new sfWidgetFormInputText(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'servicios_disponibles_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_ServiciosDisponibles'))),
      'ip_permitida'             => new sfValidatorString(array('max_length' => 60)),
      'detalles_maquina'         => new sfValidatorString(),
      'puerta'                   => new sfValidatorString(),
      'so'                       => new sfValidatorString(),
      'agente'                   => new sfValidatorString(),
      'pc'                       => new sfValidatorString(),
      'status'                   => new sfValidatorString(array('max_length' => 1)),
      'id_create'                => new sfValidatorInteger(),
      'id_update'                => new sfValidatorInteger(),
      'ip_create'                => new sfValidatorString(array('max_length' => 30)),
      'ip_update'                => new sfValidatorString(array('max_length' => 30)),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('siglas_servicios_disponibles_confianza[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Siglas_ServiciosDisponiblesConfianza';
  }

}
