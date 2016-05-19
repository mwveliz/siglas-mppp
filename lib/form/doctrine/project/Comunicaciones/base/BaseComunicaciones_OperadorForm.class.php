<?php

/**
 * Comunicaciones_Operador form base class.
 *
 * @method Comunicaciones_Operador getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseComunicaciones_OperadorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'nombre'     => new sfWidgetFormInputText(),
      'apn'        => new sfWidgetFormInputText(),
      'status'     => new sfWidgetFormInputText(),
      'id_update'  => new sfWidgetFormInputText(),
      'id_create'  => new sfWidgetFormInputText(),
      'ip_update'  => new sfWidgetFormInputText(),
      'ip_create'  => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'nombre'     => new sfValidatorString(array('max_length' => 50)),
      'apn'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'status'     => new sfValidatorString(array('max_length' => 1)),
      'id_update'  => new sfValidatorInteger(array('required' => false)),
      'id_create'  => new sfValidatorInteger(array('required' => false)),
      'ip_update'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ip_create'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('comunicaciones_operador[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comunicaciones_Operador';
  }

}
