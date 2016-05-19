<?php

/**
 * Archivo_CuerpoDocumental form base class.
 *
 * @method Archivo_CuerpoDocumental getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArchivo_CuerpoDocumentalForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'padre_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_CuerpoDocumental'), 'add_empty' => true)),
      'serie_documental_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_SerieDocumental'), 'add_empty' => false)),
      'nombre'              => new sfWidgetFormInputText(),
      'orden'               => new sfWidgetFormInputText(),
      'id_update'           => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'padre_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_CuerpoDocumental'), 'required' => false)),
      'serie_documental_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_SerieDocumental'))),
      'nombre'              => new sfValidatorString(array('max_length' => 255)),
      'orden'               => new sfValidatorInteger(array('required' => false)),
      'id_update'           => new sfValidatorInteger(),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('archivo_cuerpo_documental[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_CuerpoDocumental';
  }

}
