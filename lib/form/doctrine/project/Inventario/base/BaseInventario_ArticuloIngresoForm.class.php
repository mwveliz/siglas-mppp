<?php

/**
 * Inventario_ArticuloIngreso form base class.
 *
 * @method Inventario_ArticuloIngreso getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInventario_ArticuloIngresoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'proveedor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedores_Proveedor'), 'add_empty' => false)),
      'f_ingreso'    => new sfWidgetFormDate(),
      'status'       => new sfWidgetFormInputText(),
      'id_update'    => new sfWidgetFormInputText(),
      'ip_update'    => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'proveedor_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedores_Proveedor'))),
      'f_ingreso'    => new sfValidatorDate(),
      'status'       => new sfValidatorString(array('max_length' => 1)),
      'id_update'    => new sfValidatorInteger(),
      'ip_update'    => new sfValidatorString(array('max_length' => 50)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('inventario_articulo_ingreso[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Inventario_ArticuloIngreso';
  }

}
