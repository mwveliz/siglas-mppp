<?php

/**
 * Archivo_Caja form base class.
 *
 * @method Archivo_Caja getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArchivo_CajaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'estante_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Estante'), 'add_empty' => false)),
      'caja_modelo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_CajaModelo'), 'add_empty' => false)),
      'correlativo'            => new sfWidgetFormInputText(),
      'unidad_correlativos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_UnidadCorrelativos'), 'add_empty' => true)),
      'tramo'                  => new sfWidgetFormInputText(),
      'porcentaje_ocupado'     => new sfWidgetFormInputText(),
      'id_update'              => new sfWidgetFormInputText(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'estante_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Estante'))),
      'caja_modelo_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_CajaModelo'))),
      'correlativo'            => new sfValidatorString(array('max_length' => 255)),
      'unidad_correlativos_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_UnidadCorrelativos'), 'required' => false)),
      'tramo'                  => new sfValidatorInteger(array('required' => false)),
      'porcentaje_ocupado'     => new sfValidatorInteger(),
      'id_update'              => new sfValidatorInteger(),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('archivo_caja[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_Caja';
  }

}
