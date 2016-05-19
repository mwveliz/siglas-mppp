<?php

/**
 * Funcionarios_InformacionCorporalFamiliar form base class.
 *
 * @method Funcionarios_InformacionCorporalFamiliar getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_InformacionCorporalFamiliarForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'familiar_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Familiar'), 'add_empty' => false)),
      'color_ojos'     => new sfWidgetFormInputText(),
      'color_cabello'  => new sfWidgetFormInputText(),
      'color_piel'     => new sfWidgetFormInputText(),
      'peso'           => new sfWidgetFormInputText(),
      'altura'         => new sfWidgetFormInputText(),
      'talla_camisa'   => new sfWidgetFormInputText(),
      'talla_pantalon' => new sfWidgetFormInputText(),
      'talla_calzado'  => new sfWidgetFormInputText(),
      'talla_gorra'    => new sfWidgetFormInputText(),
      'f_validado'     => new sfWidgetFormDateTime(),
      'id_validado'    => new sfWidgetFormInputText(),
      'status'         => new sfWidgetFormInputText(),
      'id_update'      => new sfWidgetFormInputText(),
      'ip_update'      => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'familiar_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Familiar'))),
      'color_ojos'     => new sfValidatorString(array('max_length' => 30)),
      'color_cabello'  => new sfValidatorString(array('max_length' => 30)),
      'color_piel'     => new sfValidatorString(array('max_length' => 30)),
      'peso'           => new sfValidatorNumber(),
      'altura'         => new sfValidatorNumber(),
      'talla_camisa'   => new sfValidatorString(array('max_length' => 25)),
      'talla_pantalon' => new sfValidatorString(array('max_length' => 25)),
      'talla_calzado'  => new sfValidatorString(array('max_length' => 25)),
      'talla_gorra'    => new sfValidatorString(array('max_length' => 25)),
      'f_validado'     => new sfValidatorDateTime(array('required' => false)),
      'id_validado'    => new sfValidatorInteger(array('required' => false)),
      'status'         => new sfValidatorString(array('max_length' => 1)),
      'id_update'      => new sfValidatorInteger(),
      'ip_update'      => new sfValidatorString(array('max_length' => 40)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_informacion_corporal_familiar[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_InformacionCorporalFamiliar';
  }

}
