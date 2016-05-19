<?php

/**
 * Funcionarios_Familiar form base class.
 *
 * @method Funcionarios_Familiar getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_FamiliarForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'funcionario_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'parentesco_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Parentesco'), 'add_empty' => false)),
      'ci'                 => new sfWidgetFormInputText(),
      'primer_nombre'      => new sfWidgetFormInputText(),
      'segundo_nombre'     => new sfWidgetFormInputText(),
      'primer_apellido'    => new sfWidgetFormInputText(),
      'segundo_apellido'   => new sfWidgetFormInputText(),
      'f_nacimiento'       => new sfWidgetFormDate(),
      'nacionalidad'       => new sfWidgetFormInputText(),
      'sexo'               => new sfWidgetFormInputText(),
      'nivel_academico_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_NivelAcademico'), 'add_empty' => false)),
      'estudia'            => new sfWidgetFormInputCheckbox(),
      'trabaja'            => new sfWidgetFormInputCheckbox(),
      'dependencia'        => new sfWidgetFormInputCheckbox(),
      'f_validado'         => new sfWidgetFormDateTime(),
      'id_validado'        => new sfWidgetFormInputText(),
      'status'             => new sfWidgetFormInputText(),
      'id_update'          => new sfWidgetFormInputText(),
      'ip_update'          => new sfWidgetFormInputText(),
      'proteccion'         => new sfWidgetFormTextarea(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'funcionario_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'parentesco_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Parentesco'))),
      'ci'                 => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'primer_nombre'      => new sfValidatorString(array('max_length' => 255)),
      'segundo_nombre'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'primer_apellido'    => new sfValidatorString(array('max_length' => 255)),
      'segundo_apellido'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'f_nacimiento'       => new sfValidatorDate(),
      'nacionalidad'       => new sfValidatorString(array('max_length' => 1)),
      'sexo'               => new sfValidatorString(array('max_length' => 1)),
      'nivel_academico_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_NivelAcademico'))),
      'estudia'            => new sfValidatorBoolean(),
      'trabaja'            => new sfValidatorBoolean(),
      'dependencia'        => new sfValidatorBoolean(),
      'f_validado'         => new sfValidatorDateTime(array('required' => false)),
      'id_validado'        => new sfValidatorInteger(array('required' => false)),
      'status'             => new sfValidatorString(array('max_length' => 1)),
      'id_update'          => new sfValidatorInteger(),
      'ip_update'          => new sfValidatorString(array('max_length' => 40)),
      'proteccion'         => new sfValidatorString(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_familiar[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_Familiar';
  }

}
