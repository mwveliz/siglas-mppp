<?php

/**
 * Public_MensajesMasivos form base class.
 *
 * @method Public_MensajesMasivos getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePublic_MensajesMasivosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'variables'     => new sfWidgetFormTextarea(),
      'mensajes_id'   => new sfWidgetFormInputHidden(),
      'destinatarios' => new sfWidgetFormInputText(),
      'prioridad'     => new sfWidgetFormInputText(),
      'total'         => new sfWidgetFormInputText(),
      'procesados'    => new sfWidgetFormInputText(),
      'cola'          => new sfWidgetFormInputText(),
      'status'        => new sfWidgetFormInputText(),
      'modem_emisor'  => new sfWidgetFormTextarea(),
      'id_update'     => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'variables'     => new sfValidatorString(),
      'mensajes_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'mensajes_id', 'required' => false)),
      'destinatarios' => new sfValidatorInteger(),
      'prioridad'     => new sfValidatorInteger(),
      'total'         => new sfValidatorInteger(),
      'procesados'    => new sfValidatorInteger(),
      'cola'          => new sfValidatorInteger(),
      'status'        => new sfValidatorString(array('max_length' => 1)),
      'modem_emisor'  => new sfValidatorString(),
      'id_update'     => new sfValidatorInteger(),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('public_mensajes_masivos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_MensajesMasivos';
  }

}
