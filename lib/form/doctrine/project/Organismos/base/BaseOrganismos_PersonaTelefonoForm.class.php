<?php

/**
 * Organismos_PersonaTelefono form base class.
 *
 * @method Organismos_PersonaTelefono getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrganismos_PersonaTelefonoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'persona_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Persona'), 'add_empty' => false)),
      'telefono'   => new sfWidgetFormTextarea(),
      'tipo'       => new sfWidgetFormTextarea(),
      'id_update'  => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'persona_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Persona'))),
      'telefono'   => new sfValidatorString(),
      'tipo'       => new sfValidatorString(),
      'id_update'  => new sfValidatorInteger(),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('organismos_persona_telefono[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organismos_PersonaTelefono';
  }

}
