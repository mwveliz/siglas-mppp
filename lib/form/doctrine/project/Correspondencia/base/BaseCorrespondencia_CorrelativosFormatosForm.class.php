<?php

/**
 * Correspondencia_CorrelativosFormatos form base class.
 *
 * @method Correspondencia_CorrelativosFormatos getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_CorrelativosFormatosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'tipo_formato_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_TipoFormato'), 'add_empty' => false)),
      'unidad_correlativo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_UnidadCorrelativo'), 'add_empty' => false)),
      'id_update'             => new sfWidgetFormInputText(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'tipo_formato_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_TipoFormato'))),
      'unidad_correlativo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_UnidadCorrelativo'))),
      'id_update'             => new sfValidatorInteger(array('required' => false)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_correlativos_formatos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_CorrelativosFormatos';
  }

}
