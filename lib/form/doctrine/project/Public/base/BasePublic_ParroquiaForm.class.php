<?php

/**
 * Public_Parroquia form base class.
 *
 * @method Public_Parroquia getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePublic_ParroquiaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'nombre'       => new sfWidgetFormInputText(),
      'municipio_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Municipio'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'nombre'       => new sfValidatorString(array('max_length' => 255)),
      'municipio_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Municipio'))),
    ));

    $this->widgetSchema->setNameFormat('public_parroquia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_Parroquia';
  }

}
