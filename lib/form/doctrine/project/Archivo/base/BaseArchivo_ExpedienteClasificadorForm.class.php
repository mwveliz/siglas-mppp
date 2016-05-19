<?php

/**
 * Archivo_ExpedienteClasificador form base class.
 *
 * @method Archivo_ExpedienteClasificador getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArchivo_ExpedienteClasificadorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'expediente_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Expediente'), 'add_empty' => false)),
      'clasificador_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Clasificador'), 'add_empty' => false)),
      'valor'           => new sfWidgetFormInputText(),
      'id_update'       => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'expediente_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Expediente'))),
      'clasificador_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Clasificador'))),
      'valor'           => new sfValidatorString(array('max_length' => 255)),
      'id_update'       => new sfValidatorInteger(),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('archivo_expediente_clasificador[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_ExpedienteClasificador';
  }

}
