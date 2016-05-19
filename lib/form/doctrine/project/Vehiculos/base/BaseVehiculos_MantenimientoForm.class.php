<?php

/**
 * Vehiculos_Mantenimiento form base class.
 *
 * @method Vehiculos_Mantenimiento getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVehiculos_MantenimientoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'vehiculo_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_Vehiculo'), 'add_empty' => false)),
      'mantenimiento_tipo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_MantenimientoTipo'), 'add_empty' => false)),
      'observacion'           => new sfWidgetFormTextarea(),
      'kilometraje'           => new sfWidgetFormInputText(),
      'fecha'                 => new sfWidgetFormDateTime(),
      'status'                => new sfWidgetFormInputText(),
      'id_update'             => new sfWidgetFormInputText(),
      'id_create'             => new sfWidgetFormInputText(),
      'ip_update'             => new sfWidgetFormInputText(),
      'ip_create'             => new sfWidgetFormInputText(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'vehiculo_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_Vehiculo'))),
      'mantenimiento_tipo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vehiculos_MantenimientoTipo'))),
      'observacion'           => new sfValidatorString(array('required' => false)),
      'kilometraje'           => new sfValidatorInteger(array('required' => false)),
      'fecha'                 => new sfValidatorDateTime(array('required' => false)),
      'status'                => new sfValidatorString(array('max_length' => 1)),
      'id_update'             => new sfValidatorInteger(),
      'id_create'             => new sfValidatorInteger(),
      'ip_update'             => new sfValidatorString(array('max_length' => 50)),
      'ip_create'             => new sfValidatorString(array('max_length' => 50)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('vehiculos_mantenimiento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vehiculos_Mantenimiento';
  }

}
