<?php

/**
 * Correspondencia_ReceptorOrganismo form base class.
 *
 * @method Correspondencia_ReceptorOrganismo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_ReceptorOrganismoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'correspondencia_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'), 'add_empty' => false)),
      'organismo_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'), 'add_empty' => false)),
      'persona_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Persona'), 'add_empty' => true)),
      'persona_cargo_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_PersonaCargo'), 'add_empty' => true)),
      'id_update'          => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'correspondencia_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'))),
      'organismo_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'))),
      'persona_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Persona'), 'required' => false)),
      'persona_cargo_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_PersonaCargo'), 'required' => false)),
      'id_update'          => new sfValidatorInteger(),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_receptor_organismo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_ReceptorOrganismo';
  }

}
