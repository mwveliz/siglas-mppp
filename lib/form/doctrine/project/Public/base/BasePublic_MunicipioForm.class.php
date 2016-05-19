<?php

/**
 * Public_Municipio form base class.
 *
 * @method Public_Municipio getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePublic_MunicipioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'nombre'    => new sfWidgetFormInputText(),
      'estado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Estado'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'nombre'    => new sfValidatorString(array('max_length' => 255)),
      'estado_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Estado'))),
    ));

    $this->widgetSchema->setNameFormat('public_municipio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_Municipio';
  }

}
