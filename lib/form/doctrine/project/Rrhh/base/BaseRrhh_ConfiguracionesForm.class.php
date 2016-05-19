<?php

/**
 * Rrhh_Configuraciones form base class.
 *
 * @method Rrhh_Configuraciones getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRrhh_ConfiguracionesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'modulo'     => new sfWidgetFormInputText(),
      'parametros' => new sfWidgetFormTextarea(),
      'indexado'   => new sfWidgetFormTextarea(),
      'status'     => new sfWidgetFormInputText(),
      'id_update'  => new sfWidgetFormInputText(),
      'ip_update'  => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'modulo'     => new sfValidatorString(array('max_length' => 255)),
      'parametros' => new sfValidatorString(),
      'indexado'   => new sfValidatorString(array('required' => false)),
      'status'     => new sfValidatorString(array('max_length' => 1)),
      'id_update'  => new sfValidatorInteger(),
      'ip_update'  => new sfValidatorString(array('max_length' => 50)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('rrhh_configuraciones[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rrhh_Configuraciones';
  }

}
