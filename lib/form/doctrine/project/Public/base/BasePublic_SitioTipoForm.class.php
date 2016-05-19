<?php

/**
 * Public_SitioTipo form base class.
 *
 * @method Public_SitioTipo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePublic_SitioTipoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'nombre'     => new sfWidgetFormInputText(),
      'icono'      => new sfWidgetFormInputText(),
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
      'icono'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'status'     => new sfValidatorString(array('max_length' => 1)),
      'id_update'  => new sfValidatorInteger(),
      'id_create'  => new sfValidatorInteger(),
      'ip_update'  => new sfValidatorString(array('max_length' => 50)),
      'ip_create'  => new sfValidatorString(array('max_length' => 50)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('public_sitio_tipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_SitioTipo';
  }

}
