<?php

/**
 * Public_Eventos form base class.
 *
 * @method Public_Eventos getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePublic_EventosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'unidad_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => false)),
      'cargo_id'                => new sfWidgetFormInputText(),
      'funcionario_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'titulo'                  => new sfWidgetFormInputText(),
      'f_inicio'                => new sfWidgetFormDateTime(),
      'f_final'                 => new sfWidgetFormDateTime(),
      'motivo_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Motivo'), 'add_empty' => true)),
      'funcionario_delegado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioDelegado'), 'add_empty' => true)),
      'dia'                     => new sfWidgetFormInputCheckbox(),
      'institucional'           => new sfWidgetFormInputCheckbox(),
      'id_update'               => new sfWidgetFormInputText(),
      'ip_update'               => new sfWidgetFormInputText(),
      'ip_create'               => new sfWidgetFormInputText(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'unidad_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'))),
      'cargo_id'                => new sfValidatorInteger(),
      'funcionario_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'titulo'                  => new sfValidatorString(array('max_length' => 200)),
      'f_inicio'                => new sfValidatorDateTime(),
      'f_final'                 => new sfValidatorDateTime(),
      'motivo_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Motivo'), 'required' => false)),
      'funcionario_delegado_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioDelegado'), 'required' => false)),
      'dia'                     => new sfValidatorBoolean(),
      'institucional'           => new sfValidatorBoolean(array('required' => false)),
      'id_update'               => new sfValidatorInteger(),
      'ip_update'               => new sfValidatorString(array('max_length' => 50)),
      'ip_create'               => new sfValidatorString(array('max_length' => 50)),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('public_eventos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_Eventos';
  }

}
