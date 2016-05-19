<?php

/**
 * Siglas_ServidorConfianza form base class.
 *
 * @method Siglas_ServidorConfianza getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSiglas_ServidorConfianzaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'id_yml'       => new sfWidgetFormTextarea(),
      'organismo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'), 'add_empty' => false)),
      'dominio'      => new sfWidgetFormTextarea(),
      'contacto'     => new sfWidgetFormTextarea(),
      'io_basica'    => new sfWidgetFormTextarea(),
      'proteccion'   => new sfWidgetFormTextarea(),
      'puerta'       => new sfWidgetFormTextarea(),
      'so'           => new sfWidgetFormTextarea(),
      'agente'       => new sfWidgetFormTextarea(),
      'pc'           => new sfWidgetFormTextarea(),
      'status'       => new sfWidgetFormInputText(),
      'id_create'    => new sfWidgetFormInputText(),
      'id_update'    => new sfWidgetFormInputText(),
      'ip_create'    => new sfWidgetFormInputText(),
      'ip_update'    => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'id_yml'       => new sfValidatorString(),
      'organismo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'))),
      'dominio'      => new sfValidatorString(),
      'contacto'     => new sfValidatorString(),
      'io_basica'    => new sfValidatorString(),
      'proteccion'   => new sfValidatorString(array('required' => false)),
      'puerta'       => new sfValidatorString(),
      'so'           => new sfValidatorString(),
      'agente'       => new sfValidatorString(),
      'pc'           => new sfValidatorString(),
      'status'       => new sfValidatorString(array('max_length' => 1)),
      'id_create'    => new sfValidatorInteger(),
      'id_update'    => new sfValidatorInteger(),
      'ip_create'    => new sfValidatorString(array('max_length' => 30)),
      'ip_update'    => new sfValidatorString(array('max_length' => 30)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('siglas_servidor_confianza[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Siglas_ServidorConfianza';
  }

}
