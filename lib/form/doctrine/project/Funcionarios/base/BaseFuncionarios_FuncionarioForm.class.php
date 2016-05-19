<?php

/**
 * Funcionarios_Funcionario form base class.
 *
 * @method Funcionarios_Funcionario getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_FuncionarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'ci'                     => new sfWidgetFormInputText(),
      'primer_nombre'          => new sfWidgetFormInputText(),
      'segundo_nombre'         => new sfWidgetFormInputText(),
      'primer_apellido'        => new sfWidgetFormInputText(),
      'segundo_apellido'       => new sfWidgetFormInputText(),
      'f_nacimiento'           => new sfWidgetFormDate(),
      'estado_nacimiento_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Estado'), 'add_empty' => true)),
      'sexo'                   => new sfWidgetFormInputText(),
      'edo_civil'              => new sfWidgetFormInputText(),
      'telf_movil'             => new sfWidgetFormInputText(),
      'telf_fijo'              => new sfWidgetFormInputText(),
      'email_validado'         => new sfWidgetFormInputCheckbox(),
      'email_institucional'    => new sfWidgetFormInputText(),
      'email_personal'         => new sfWidgetFormInputText(),
      'codigo_validador_email' => new sfWidgetFormInputText(),
      'codigo_validador_telf'  => new sfWidgetFormInputText(),
      'status'                 => new sfWidgetFormInputText(),
      'id_update'              => new sfWidgetFormInputText(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'ci'                     => new sfValidatorInteger(),
      'primer_nombre'          => new sfValidatorString(array('max_length' => 255)),
      'segundo_nombre'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'primer_apellido'        => new sfValidatorString(array('max_length' => 255)),
      'segundo_apellido'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'f_nacimiento'           => new sfValidatorDate(),
      'estado_nacimiento_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Estado'), 'required' => false)),
      'sexo'                   => new sfValidatorString(array('max_length' => 1)),
      'edo_civil'              => new sfValidatorString(array('max_length' => 1)),
      'telf_movil'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'telf_fijo'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email_validado'         => new sfValidatorBoolean(array('required' => false)),
      'email_institucional'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email_personal'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'codigo_validador_email' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'codigo_validador_telf'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'status'                 => new sfValidatorString(array('max_length' => 1)),
      'id_update'              => new sfValidatorInteger(),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_funcionario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_Funcionario';
  }

}
