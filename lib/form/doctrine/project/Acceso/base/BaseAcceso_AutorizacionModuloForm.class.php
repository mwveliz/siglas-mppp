<?php

/**
 * Acceso_AutorizacionModulo form base class.
 *
 * @method Acceso_AutorizacionModulo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAcceso_AutorizacionModuloForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'modulo_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_Modulo'), 'add_empty' => false)),
      'funcionario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'permiso'        => new sfWidgetFormInputText(),
      'status'         => new sfWidgetFormInputText(),
      'id_update'      => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'modulo_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_Modulo'))),
      'funcionario_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'permiso'        => new sfValidatorString(array('max_length' => 1)),
      'status'         => new sfValidatorString(array('max_length' => 1)),
      'id_update'      => new sfValidatorInteger(),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('acceso_autorizacion_modulo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Acceso_AutorizacionModulo';
  }

}
