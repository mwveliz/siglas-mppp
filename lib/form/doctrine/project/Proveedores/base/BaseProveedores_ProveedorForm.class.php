<?php

/**
 * Proveedores_Proveedor form base class.
 *
 * @method Proveedores_Proveedor getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProveedores_ProveedorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'tipo_empresa_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedores_TipoEmpresa'), 'add_empty' => false)),
      'rif'             => new sfWidgetFormInputText(),
      'razon_social'    => new sfWidgetFormInputText(),
      'status'          => new sfWidgetFormInputText(),
      'id_update'       => new sfWidgetFormInputText(),
      'ip_update'       => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'tipo_empresa_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedores_TipoEmpresa'))),
      'rif'             => new sfValidatorString(array('max_length' => 50)),
      'razon_social'    => new sfValidatorString(array('max_length' => 255)),
      'status'          => new sfValidatorString(array('max_length' => 1)),
      'id_update'       => new sfValidatorInteger(),
      'ip_update'       => new sfValidatorString(array('max_length' => 50)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('proveedores_proveedor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Proveedores_Proveedor';
  }

}
