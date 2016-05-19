<?php

/**
 * Correspondencia_Formato form base class.
 *
 * @method Correspondencia_Formato getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_FormatoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'correspondencia_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'), 'add_empty' => false)),
      'tipo_formato_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_TipoFormato'), 'add_empty' => false)),
      'contenido'          => new sfWidgetFormTextarea(),
      'campo_uno'          => new sfWidgetFormTextarea(),
      'campo_dos'          => new sfWidgetFormTextarea(),
      'campo_tres'         => new sfWidgetFormTextarea(),
      'campo_cuatro'       => new sfWidgetFormTextarea(),
      'campo_cinco'        => new sfWidgetFormTextarea(),
      'campo_seis'         => new sfWidgetFormTextarea(),
      'campo_siete'        => new sfWidgetFormTextarea(),
      'campo_ocho'         => new sfWidgetFormTextarea(),
      'campo_nueve'        => new sfWidgetFormTextarea(),
      'campo_diez'         => new sfWidgetFormTextarea(),
      'campo_once'         => new sfWidgetFormTextarea(),
      'campo_doce'         => new sfWidgetFormTextarea(),
      'campo_trece'        => new sfWidgetFormTextarea(),
      'campo_catorce'      => new sfWidgetFormTextarea(),
      'campo_quince'       => new sfWidgetFormTextarea(),
      'id_update'          => new sfWidgetFormInputText(),
      'publico'            => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'correspondencia_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'))),
      'tipo_formato_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_TipoFormato'))),
      'contenido'          => new sfValidatorString(),
      'campo_uno'          => new sfValidatorString(array('required' => false)),
      'campo_dos'          => new sfValidatorString(array('required' => false)),
      'campo_tres'         => new sfValidatorString(array('required' => false)),
      'campo_cuatro'       => new sfValidatorString(array('required' => false)),
      'campo_cinco'        => new sfValidatorString(array('required' => false)),
      'campo_seis'         => new sfValidatorString(array('required' => false)),
      'campo_siete'        => new sfValidatorString(array('required' => false)),
      'campo_ocho'         => new sfValidatorString(array('required' => false)),
      'campo_nueve'        => new sfValidatorString(array('required' => false)),
      'campo_diez'         => new sfValidatorString(array('required' => false)),
      'campo_once'         => new sfValidatorString(array('required' => false)),
      'campo_doce'         => new sfValidatorString(array('required' => false)),
      'campo_trece'        => new sfValidatorString(array('required' => false)),
      'campo_catorce'      => new sfValidatorString(array('required' => false)),
      'campo_quince'       => new sfValidatorString(array('required' => false)),
      'id_update'          => new sfValidatorInteger(),
      'publico'            => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_formato[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_Formato';
  }

}
