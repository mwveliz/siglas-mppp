<?php

/**
 * Acceso_Modulo form base class.
 *
 * @method Acceso_Modulo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAcceso_ModuloForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'nombre'      => new sfWidgetFormInputText(),
      'descripcion' => new sfWidgetFormTextarea(),
      'vinculo'     => new sfWidgetFormInputText(),
      'imagen'      => new sfWidgetFormInputText(),
      'orden'       => new sfWidgetFormInputText(),
      'status'      => new sfWidgetFormInputText(),
      'id_update'   => new sfWidgetFormInputText(),
      'aplicacion'  => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'nombre'      => new sfValidatorString(array('max_length' => 255)),
      'descripcion' => new sfValidatorString(),
      'vinculo'     => new sfValidatorString(array('max_length' => 255)),
      'imagen'      => new sfValidatorString(array('max_length' => 255)),
      'orden'       => new sfValidatorInteger(),
      'status'      => new sfValidatorString(array('max_length' => 1)),
      'id_update'   => new sfValidatorInteger(),
      'aplicacion'  => new sfValidatorString(array('max_length' => 255)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('acceso_modulo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Acceso_Modulo';
  }

}
