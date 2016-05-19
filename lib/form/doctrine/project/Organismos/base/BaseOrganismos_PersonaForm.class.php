<?php

/**
 * Organismos_Persona form base class.
 *
 * @method Organismos_Persona getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrganismos_PersonaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'organismo_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'), 'add_empty' => false)),
      'ci'               => new sfWidgetFormInputText(),
      'nombre_simple'    => new sfWidgetFormInputText(),
      'primer_nombre'    => new sfWidgetFormInputText(),
      'segundo_nombre'   => new sfWidgetFormInputText(),
      'primer_apellido'  => new sfWidgetFormInputText(),
      'segundo_apellido' => new sfWidgetFormInputText(),
      'email_principal'  => new sfWidgetFormInputText(),
      'email_secundario' => new sfWidgetFormInputText(),
      'sexo'             => new sfWidgetFormInputText(),
      'privado'          => new sfWidgetFormInputCheckbox(),
      'status'           => new sfWidgetFormInputText(),
      'id_update'        => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'organismo_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'))),
      'ci'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nombre_simple'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'primer_nombre'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'segundo_nombre'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'primer_apellido'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'segundo_apellido' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email_principal'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email_secundario' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'sexo'             => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'privado'          => new sfValidatorBoolean(array('required' => false)),
      'status'           => new sfValidatorString(array('max_length' => 1)),
      'id_update'        => new sfValidatorInteger(),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('organismos_persona[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organismos_Persona';
  }

}
