<?php

/**
 * Archivo_ExpedienteCuerpoDocumental form base class.
 *
 * @method Archivo_ExpedienteCuerpoDocumental getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArchivo_ExpedienteCuerpoDocumentalForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'expediente_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Expediente'), 'add_empty' => false)),
      'cuerpo_documental_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_CuerpoDocumental'), 'add_empty' => false)),
      'id_update'            => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'expediente_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Expediente'))),
      'cuerpo_documental_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_CuerpoDocumental'))),
      'id_update'            => new sfValidatorInteger(),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('archivo_expediente_cuerpo_documental[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_ExpedienteCuerpoDocumental';
  }

}
