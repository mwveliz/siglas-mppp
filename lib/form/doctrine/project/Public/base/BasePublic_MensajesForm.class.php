<?php

/**
 * Public_Mensajes form base class.
 *
 * @method Public_Mensajes getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePublic_MensajesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'conversacion'          => new sfWidgetFormInputText(),
      'funcionario_envia_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioEnvia'), 'add_empty' => false)),
      'funcionario_recibe_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioRecibe'), 'add_empty' => true)),
      'contenido'             => new sfWidgetFormTextarea(),
      'nombre_externo'        => new sfWidgetFormInputText(),
      'n_informe_progreso'    => new sfWidgetFormTextarea(),
      'tipo'                  => new sfWidgetFormInputText(),
      'status'                => new sfWidgetFormInputText(),
      'id_update'             => new sfWidgetFormInputText(),
      'ip_update'             => new sfWidgetFormTextarea(),
      'id_eliminado'          => new sfWidgetFormInputText(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'conversacion'          => new sfValidatorInteger(),
      'funcionario_envia_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioEnvia'))),
      'funcionario_recibe_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioRecibe'), 'required' => false)),
      'contenido'             => new sfValidatorString(),
      'nombre_externo'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'n_informe_progreso'    => new sfValidatorString(array('required' => false)),
      'tipo'                  => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'status'                => new sfValidatorString(array('max_length' => 1)),
      'id_update'             => new sfValidatorInteger(),
      'ip_update'             => new sfValidatorString(array('required' => false)),
      'id_eliminado'          => new sfValidatorInteger(array('required' => false)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('public_mensajes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_Mensajes';
  }

}
