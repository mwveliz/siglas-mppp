<?php

/**
 * Funcionarios_FuncionarioCargoCertificado form base class.
 *
 * @method Funcionarios_FuncionarioCargoCertificado getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_FuncionarioCargoCertificadoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'funcionario_cargo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioCargo'), 'add_empty' => false)),
      'certificado'          => new sfWidgetFormTextarea(),
      'detalles_tecnicos'    => new sfWidgetFormTextarea(),
      'configuraciones'      => new sfWidgetFormTextarea(),
      'f_valido_desde'       => new sfWidgetFormDate(),
      'f_valido_hasta'       => new sfWidgetFormDate(),
      'status'               => new sfWidgetFormInputText(),
      'id_update'            => new sfWidgetFormInputText(),
      'id_create'            => new sfWidgetFormInputText(),
      'ip_update'            => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'funcionario_cargo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioCargo'))),
      'certificado'          => new sfValidatorString(),
      'detalles_tecnicos'    => new sfValidatorString(),
      'configuraciones'      => new sfValidatorString(),
      'f_valido_desde'       => new sfValidatorDate(),
      'f_valido_hasta'       => new sfValidatorDate(),
      'status'               => new sfValidatorString(array('max_length' => 1)),
      'id_update'            => new sfValidatorInteger(),
      'id_create'            => new sfValidatorInteger(),
      'ip_update'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_funcionario_cargo_certificado[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_FuncionarioCargoCertificado';
  }

}
