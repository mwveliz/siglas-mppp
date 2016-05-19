<?php

/**
 * Archivo_Clasificador form base class.
 *
 * @method Archivo_Clasificador getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArchivo_ClasificadorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'serie_documental_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_SerieDocumental'), 'add_empty' => false)),
      'nombre'              => new sfWidgetFormInputText(),
      'tipo_dato'           => new sfWidgetFormInputText(),
      'parametros'          => new sfWidgetFormTextarea(),
      'vacio'               => new sfWidgetFormInputCheckbox(),
      'orden'               => new sfWidgetFormInputText(),
      'id_update'           => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'serie_documental_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_SerieDocumental'))),
      'nombre'              => new sfValidatorString(array('max_length' => 255)),
      'tipo_dato'           => new sfValidatorString(array('max_length' => 255)),
      'parametros'          => new sfValidatorString(array('required' => false)),
      'vacio'               => new sfValidatorBoolean(),
      'orden'               => new sfValidatorInteger(),
      'id_update'           => new sfValidatorInteger(),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('archivo_clasificador[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_Clasificador';
  }

}
