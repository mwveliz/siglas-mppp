<?php

/**
 * Organigrama_CargoGradoTipo form base class.
 *
 * @method Organigrama_CargoGradoTipo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrganigrama_CargoGradoTipoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'cargo_tipo_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoTipo'), 'add_empty' => true)),
      'cargo_grado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoGrado'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'cargo_tipo_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoTipo'), 'required' => false)),
      'cargo_grado_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoGrado'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('organigrama_cargo_grado_tipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organigrama_CargoGradoTipo';
  }

}
