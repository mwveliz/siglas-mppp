<?php

/**
 * Correspondencia_RedireccionAutomatica form base class.
 *
 * @method Correspondencia_RedireccionAutomatica getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_RedireccionAutomaticaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'instruccion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Instruccion'), 'add_empty' => false)),
      'servicio_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Servicio'), 'add_empty' => false)),
      'unidad_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => false)),
      'cargo_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Cargo'), 'add_empty' => false)),
      'observacion'    => new sfWidgetFormTextarea(),
      'id_update'      => new sfWidgetFormInputText(),
      'ip_update'      => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'instruccion_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Instruccion'))),
      'servicio_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Servicio'))),
      'unidad_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'))),
      'cargo_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Cargo'))),
      'observacion'    => new sfValidatorString(),
      'id_update'      => new sfValidatorInteger(),
      'ip_update'      => new sfValidatorString(array('max_length' => 50)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_redireccion_automatica[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_RedireccionAutomatica';
  }

}
