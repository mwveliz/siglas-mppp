<?php

/**
 * Public_CarreraUniversitaria form base class.
 *
 * @method Public_CarreraUniversitaria getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePublic_CarreraUniversitariaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'organismo_educativo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'), 'add_empty' => false)),
      'area_conocimiento_id'   => new sfWidgetFormInputText(),
      'nombre'                 => new sfWidgetFormInputText(),
      'status'                 => new sfWidgetFormInputText(),
      'id_update'              => new sfWidgetFormInputText(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'organismo_educativo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'))),
      'area_conocimiento_id'   => new sfValidatorInteger(array('required' => false)),
      'nombre'                 => new sfValidatorString(array('max_length' => 255)),
      'status'                 => new sfValidatorString(array('max_length' => 1)),
      'id_update'              => new sfValidatorInteger(),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('public_carrera_universitaria[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_CarreraUniversitaria';
  }

}
