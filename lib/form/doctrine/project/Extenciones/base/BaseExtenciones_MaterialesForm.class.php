<?php

/**
 * Extenciones_Materiales form base class.
 *
 * @method Extenciones_Materiales getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseExtenciones_MaterialesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                        => new sfWidgetFormInputHidden(),
      'unidad_medida_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Extenciones_UnidadMedida'), 'add_empty' => false)),
      'nombre'                    => new sfWidgetFormInputText(),
      'stop'                      => new sfWidgetFormInputText(),
      'status'                    => new sfWidgetFormInputText(),
      'id_update'                 => new sfWidgetFormInputText(),
      'material_clasificacion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Extenciones_MaterialClasificacion'), 'add_empty' => false)),
      'created_at'                => new sfWidgetFormDateTime(),
      'updated_at'                => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'unidad_medida_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Extenciones_UnidadMedida'))),
      'nombre'                    => new sfValidatorString(array('max_length' => 255)),
      'stop'                      => new sfValidatorInteger(array('required' => false)),
      'status'                    => new sfValidatorString(array('max_length' => 1)),
      'id_update'                 => new sfValidatorInteger(),
      'material_clasificacion_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Extenciones_MaterialClasificacion'))),
      'created_at'                => new sfValidatorDateTime(),
      'updated_at'                => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('extenciones_materiales[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Extenciones_Materiales';
  }

}
