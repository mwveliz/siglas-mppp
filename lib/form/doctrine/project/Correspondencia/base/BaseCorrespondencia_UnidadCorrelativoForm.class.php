<?php

/**
 * Correspondencia_UnidadCorrelativo form base class.
 *
 * @method Correspondencia_UnidadCorrelativo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_UnidadCorrelativoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'unidad_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => false)),
      'descripcion'        => new sfWidgetFormInputText(),
      'letra'              => new sfWidgetFormInputText(),
      'ultimo_correlativo' => new sfWidgetFormTextarea(),
      'nomenclador'        => new sfWidgetFormInputText(),
      'secuencia'          => new sfWidgetFormInputText(),
      'compartido'         => new sfWidgetFormInputCheckbox(),
      'tipo'               => new sfWidgetFormInputText(),
      'status'             => new sfWidgetFormInputText(),
      'id_update'          => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'unidad_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'))),
      'descripcion'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'letra'              => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'ultimo_correlativo' => new sfValidatorString(array('required' => false)),
      'nomenclador'        => new sfValidatorString(array('max_length' => 100)),
      'secuencia'          => new sfValidatorInteger(),
      'compartido'         => new sfValidatorBoolean(array('required' => false)),
      'tipo'               => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'status'             => new sfValidatorString(array('max_length' => 1)),
      'id_update'          => new sfValidatorInteger(),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_unidad_correlativo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_UnidadCorrelativo';
  }

}
