<?php

/**
 * Seguridad_IngresoEquipo form base class.
 *
 * @method Seguridad_IngresoEquipo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeguridad_IngresoEquipoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'equipo_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Equipo'), 'add_empty' => false)),
      'ingreso_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Ingreso'), 'add_empty' => false)),
      'f_egreso'   => new sfWidgetFormDateTime(),
      'id_create'  => new sfWidgetFormInputText(),
      'id_update'  => new sfWidgetFormInputText(),
      'ip_update'  => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'equipo_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Equipo'))),
      'ingreso_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Ingreso'))),
      'f_egreso'   => new sfValidatorDateTime(array('required' => false)),
      'id_create'  => new sfValidatorInteger(),
      'id_update'  => new sfValidatorInteger(),
      'ip_update'  => new sfValidatorString(array('max_length' => 50)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('seguridad_ingreso_equipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seguridad_IngresoEquipo';
  }

}
