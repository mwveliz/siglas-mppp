<?php

/**
 * Correspondencia_GrupoReceptor form base class.
 *
 * @method Correspondencia_GrupoReceptor getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_GrupoReceptorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'nombre'             => new sfWidgetFormInputText(),
      'unidad_duena_id'    => new sfWidgetFormInputText(),
      'cargo_receptor_id'  => new sfWidgetFormInputText(),
      'unidad_receptor_id' => new sfWidgetFormInputText(),
      'grupo_id'           => new sfWidgetFormInputText(),
      'tipo'               => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'nombre'             => new sfValidatorString(array('max_length' => 50)),
      'unidad_duena_id'    => new sfValidatorInteger(),
      'cargo_receptor_id'  => new sfValidatorInteger(),
      'unidad_receptor_id' => new sfValidatorInteger(),
      'grupo_id'           => new sfValidatorInteger(),
      'tipo'               => new sfValidatorString(array('max_length' => 1)),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_grupo_receptor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_GrupoReceptor';
  }

}
