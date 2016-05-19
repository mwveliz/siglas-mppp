<?php

/**
 * Archivo_UnidadCorrelativos form base class.
 *
 * @method Archivo_UnidadCorrelativos getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArchivo_UnidadCorrelativosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                        => new sfWidgetFormInputHidden(),
      'unidad_id'                 => new sfWidgetFormInputText(),
      'secuencia_caja'            => new sfWidgetFormInputText(),
      'secuencia_expediente'      => new sfWidgetFormInputText(),
      'secuencia_anexo_documento' => new sfWidgetFormInputText(),
      'id_update'                 => new sfWidgetFormInputText(),
      'created_at'                => new sfWidgetFormDateTime(),
      'updated_at'                => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'unidad_id'                 => new sfValidatorInteger(array('required' => false)),
      'secuencia_caja'            => new sfValidatorInteger(),
      'secuencia_expediente'      => new sfValidatorInteger(),
      'secuencia_anexo_documento' => new sfValidatorInteger(),
      'id_update'                 => new sfValidatorInteger(),
      'created_at'                => new sfValidatorDateTime(),
      'updated_at'                => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('archivo_unidad_correlativos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_UnidadCorrelativos';
  }

}
