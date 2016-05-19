<?php

/**
 * Seguridad_Persona form base class.
 *
 * @method Seguridad_Persona getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeguridad_PersonaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'nacionalidad'       => new sfWidgetFormInputText(),
      'ci'                 => new sfWidgetFormInputText(),
      'primer_nombre'      => new sfWidgetFormInputText(),
      'segundo_nombre'     => new sfWidgetFormInputText(),
      'primer_apellido'    => new sfWidgetFormInputText(),
      'segundo_apellido'   => new sfWidgetFormInputText(),
      'sexo'               => new sfWidgetFormInputText(),
      'f_nacimiento'       => new sfWidgetFormDate(),
      'correo_electronico' => new sfWidgetFormInputText(),
      'telefono'           => new sfWidgetFormInputText(),
      'id_update'          => new sfWidgetFormInputText(),
      'ip_update'          => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'nacionalidad'       => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'ci'                 => new sfValidatorNumber(array('required' => false)),
      'primer_nombre'      => new sfValidatorString(array('max_length' => 255)),
      'segundo_nombre'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'primer_apellido'    => new sfValidatorString(array('max_length' => 255)),
      'segundo_apellido'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'sexo'               => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'f_nacimiento'       => new sfValidatorDate(array('required' => false)),
      'correo_electronico' => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'telefono'           => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'id_update'          => new sfValidatorInteger(),
      'ip_update'          => new sfValidatorString(array('max_length' => 50)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('seguridad_persona[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seguridad_Persona';
  }

}
