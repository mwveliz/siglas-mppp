<?php

/**
 * Archivo_Estante form base class.
 *
 * @method Archivo_Estante getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArchivo_EstanteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                        => new sfWidgetFormInputHidden(),
      'estante_modelo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_EstanteModelo'), 'add_empty' => false)),
      'unidad_duena_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_UnidadDuena'), 'add_empty' => false)),
      'unidad_fisica_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_UnidadFisica'), 'add_empty' => false)),
      'identificador'             => new sfWidgetFormInputText(),
      'tramos'                    => new sfWidgetFormInputText(),
      'alto_tramos'               => new sfWidgetFormInputText(),
      'ancho_tramos'              => new sfWidgetFormInputText(),
      'largo_tramos'              => new sfWidgetFormInputText(),
      'porcentaje_ocupado'        => new sfWidgetFormInputText(),
      'detalles_ubicacion_fisica' => new sfWidgetFormTextarea(),
      'id_update'                 => new sfWidgetFormInputText(),
      'created_at'                => new sfWidgetFormDateTime(),
      'updated_at'                => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'estante_modelo_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_EstanteModelo'))),
      'unidad_duena_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_UnidadDuena'))),
      'unidad_fisica_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_UnidadFisica'))),
      'identificador'             => new sfValidatorString(array('max_length' => 255)),
      'tramos'                    => new sfValidatorInteger(),
      'alto_tramos'               => new sfValidatorInteger(),
      'ancho_tramos'              => new sfValidatorInteger(),
      'largo_tramos'              => new sfValidatorInteger(),
      'porcentaje_ocupado'        => new sfValidatorInteger(),
      'detalles_ubicacion_fisica' => new sfValidatorString(array('required' => false)),
      'id_update'                 => new sfValidatorInteger(),
      'created_at'                => new sfValidatorDateTime(),
      'updated_at'                => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('archivo_estante[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_Estante';
  }

}
