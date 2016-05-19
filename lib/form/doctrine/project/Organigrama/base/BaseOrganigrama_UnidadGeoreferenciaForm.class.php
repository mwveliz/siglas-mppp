<?php

/**
 * Organigrama_UnidadGeoreferencia form base class.
 *
 * @method Organigrama_UnidadGeoreferencia getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrganigrama_UnidadGeoreferenciaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'unidad_id'   => new sfWidgetFormInputHidden(),
      'coordenadas' => new sfWidgetFormInputText(),
      'id_update'   => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'unidad_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'unidad_id', 'required' => false)),
      'coordenadas' => new sfValidatorNumber(),
      'id_update'   => new sfValidatorInteger(),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('organigrama_unidad_georeferencia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organigrama_UnidadGeoreferencia';
  }

}
