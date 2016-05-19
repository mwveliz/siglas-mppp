<?php

/**
 * Inventario_Inventario form base class.
 *
 * @method Inventario_Inventario getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInventario_InventarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'almacen_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Inventario_Almacen'), 'add_empty' => false)),
      'articulo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Inventario_Articulo'), 'add_empty' => false)),
      'articulo_ingreso_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Inventario_ArticuloIngreso'), 'add_empty' => false)),
      'cantidad_inicial'    => new sfWidgetFormInputText(),
      'cantidad_actual'     => new sfWidgetFormInputText(),
      'status'              => new sfWidgetFormInputText(),
      'id_update'           => new sfWidgetFormInputText(),
      'ip_update'           => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'almacen_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Inventario_Almacen'))),
      'articulo_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Inventario_Articulo'))),
      'articulo_ingreso_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Inventario_ArticuloIngreso'))),
      'cantidad_inicial'    => new sfValidatorNumber(),
      'cantidad_actual'     => new sfValidatorNumber(),
      'status'              => new sfValidatorString(array('max_length' => 1)),
      'id_update'           => new sfValidatorInteger(),
      'ip_update'           => new sfValidatorString(array('max_length' => 50)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('inventario_inventario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Inventario_Inventario';
  }

}
