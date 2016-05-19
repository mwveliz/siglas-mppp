<?php

/**
 * Seguridad_CarnetDiseno form base class.
 *
 * @method Seguridad_CarnetDiseno getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeguridad_CarnetDisenoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'carnet_tipo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_CarnetTipo'), 'add_empty' => false)),
      'indices'        => new sfWidgetFormTextarea(),
      'imagen_fondo'   => new sfWidgetFormTextarea(),
      'parametros'     => new sfWidgetFormTextarea(),
      'status'         => new sfWidgetFormInputText(),
      'id_create'      => new sfWidgetFormInputText(),
      'id_update'      => new sfWidgetFormInputText(),
      'ip_update'      => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'carnet_tipo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_CarnetTipo'))),
      'indices'        => new sfValidatorString(),
      'imagen_fondo'   => new sfValidatorString(),
      'parametros'     => new sfValidatorString(),
      'status'         => new sfValidatorString(array('max_length' => 1)),
      'id_create'      => new sfValidatorInteger(),
      'id_update'      => new sfValidatorInteger(array('required' => false)),
      'ip_update'      => new sfValidatorString(array('max_length' => 50)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('seguridad_carnet_diseno[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seguridad_CarnetDiseno';
  }

}
