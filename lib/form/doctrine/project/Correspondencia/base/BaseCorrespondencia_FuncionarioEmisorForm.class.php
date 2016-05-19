<?php

/**
 * Correspondencia_FuncionarioEmisor form base class.
 *
 * @method Correspondencia_FuncionarioEmisor getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_FuncionarioEmisorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                            => new sfWidgetFormInputHidden(),
      'correspondencia_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'), 'add_empty' => false)),
      'funcionario_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'funcionario_cargo_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioCargo'), 'add_empty' => false)),
      'firma'                         => new sfWidgetFormInputText(),
      'accion_delegada_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_AccionDelegada'), 'add_empty' => true)),
      'funcionario_delegado_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioDelegado'), 'add_empty' => true)),
      'funcionario_delegado_cargo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioCargoDelegado'), 'add_empty' => true)),
      'id_update'                     => new sfWidgetFormInputText(),
      'ip_update'                     => new sfWidgetFormInputText(),
      'proteccion'                    => new sfWidgetFormTextarea(),
      'created_at'                    => new sfWidgetFormDateTime(),
      'updated_at'                    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'correspondencia_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'))),
      'funcionario_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'funcionario_cargo_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioCargo'))),
      'firma'                         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'accion_delegada_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_AccionDelegada'), 'required' => false)),
      'funcionario_delegado_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioDelegado'), 'required' => false)),
      'funcionario_delegado_cargo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioCargoDelegado'), 'required' => false)),
      'id_update'                     => new sfValidatorInteger(),
      'ip_update'                     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'proteccion'                    => new sfValidatorString(array('required' => false)),
      'created_at'                    => new sfValidatorDateTime(),
      'updated_at'                    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_funcionario_emisor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_FuncionarioEmisor';
  }

}
