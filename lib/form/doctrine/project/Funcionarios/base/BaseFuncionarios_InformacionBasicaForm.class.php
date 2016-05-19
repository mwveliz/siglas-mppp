<?php

/**
 * Funcionarios_InformacionBasica form base class.
 *
 * @method Funcionarios_InformacionBasica getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_InformacionBasicaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'funcionario_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'f_nacimiento'                => new sfWidgetFormDate(),
      'estado_nacimiento_id'        => new sfWidgetFormInputText(),
      'sexo'                        => new sfWidgetFormInputText(),
      'edo_civil'                   => new sfWidgetFormInputText(),
      'licencia_conducir_uno_grado' => new sfWidgetFormInputText(),
      'licencia_conducir_dos_grado' => new sfWidgetFormInputText(),
      'f_validado'                  => new sfWidgetFormDateTime(),
      'id_validado'                 => new sfWidgetFormInputText(),
      'status'                      => new sfWidgetFormInputText(),
      'id_update'                   => new sfWidgetFormInputText(),
      'ip_update'                   => new sfWidgetFormInputText(),
      'proteccion'                  => new sfWidgetFormTextarea(),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'funcionario_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'f_nacimiento'                => new sfValidatorDate(),
      'estado_nacimiento_id'        => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'sexo'                        => new sfValidatorString(array('max_length' => 1)),
      'edo_civil'                   => new sfValidatorString(array('max_length' => 1)),
      'licencia_conducir_uno_grado' => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'licencia_conducir_dos_grado' => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'f_validado'                  => new sfValidatorDateTime(array('required' => false)),
      'id_validado'                 => new sfValidatorInteger(array('required' => false)),
      'status'                      => new sfValidatorString(array('max_length' => 1)),
      'id_update'                   => new sfValidatorInteger(),
      'ip_update'                   => new sfValidatorString(array('max_length' => 40)),
      'proteccion'                  => new sfValidatorString(array('required' => false)),
      'created_at'                  => new sfValidatorDateTime(),
      'updated_at'                  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_informacion_basica[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_InformacionBasica';
  }

}
