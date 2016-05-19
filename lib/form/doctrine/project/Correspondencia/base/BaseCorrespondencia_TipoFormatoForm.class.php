<?php

/**
 * Correspondencia_TipoFormato form base class.
 *
 * @method Correspondencia_TipoFormato getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_TipoFormatoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'nombre'      => new sfWidgetFormInputText(),
      'descripcion' => new sfWidgetFormTextarea(),
      'privado'     => new sfWidgetFormInputText(),
      'principal'   => new sfWidgetFormInputCheckbox(),
      'tipo'        => new sfWidgetFormInputText(),
      'classe'      => new sfWidgetFormInputText(),
      'parametros'  => new sfWidgetFormTextarea(),
      'id_update'   => new sfWidgetFormInputText(),
      'status'      => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'nombre'      => new sfValidatorString(array('max_length' => 255)),
      'descripcion' => new sfValidatorString(array('required' => false)),
      'privado'     => new sfValidatorString(array('max_length' => 1)),
      'principal'   => new sfValidatorBoolean(),
      'tipo'        => new sfValidatorString(array('max_length' => 1)),
      'classe'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'parametros'  => new sfValidatorString(),
      'id_update'   => new sfValidatorInteger(),
      'status'      => new sfValidatorString(array('max_length' => 1)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_tipo_formato[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_TipoFormato';
  }

}
