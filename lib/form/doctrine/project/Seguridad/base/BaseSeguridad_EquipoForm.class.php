<?php

/**
 * Seguridad_Equipo form base class.
 *
 * @method Seguridad_Equipo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeguridad_EquipoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'tipo_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Tipo'), 'add_empty' => false)),
      'marca_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Marca'), 'add_empty' => false)),
      'serial'     => new sfWidgetFormTextarea(),
      'id_update'  => new sfWidgetFormInputText(),
      'ip_update'  => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'tipo_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Tipo'))),
      'marca_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Marca'))),
      'serial'     => new sfValidatorString(),
      'id_update'  => new sfValidatorInteger(),
      'ip_update'  => new sfValidatorString(array('max_length' => 50)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('seguridad_equipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seguridad_Equipo';
  }

}
