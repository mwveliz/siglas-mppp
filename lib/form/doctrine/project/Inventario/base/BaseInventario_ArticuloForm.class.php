<?php

/**
 * Inventario_Articulo form base class.
 *
 * @method Inventario_Articulo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInventario_ArticuloForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'unidad_medida_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Inventario_UnidadMedida'), 'add_empty' => false)),
      'codigo'           => new sfWidgetFormInputText(),
      'nombre'           => new sfWidgetFormInputText(),
      'stop'             => new sfWidgetFormInputText(),
      'status'           => new sfWidgetFormInputText(),
      'id_update'        => new sfWidgetFormInputText(),
      'ip_update'        => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'unidad_medida_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Inventario_UnidadMedida'))),
      'codigo'           => new sfValidatorString(array('max_length' => 50)),
      'nombre'           => new sfValidatorString(array('max_length' => 255)),
      'stop'             => new sfValidatorNumber(),
      'status'           => new sfValidatorString(array('max_length' => 1)),
      'id_update'        => new sfValidatorInteger(),
      'ip_update'        => new sfValidatorString(array('max_length' => 50)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('inventario_articulo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Inventario_Articulo';
  }

}
