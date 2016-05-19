<?php

/**
 * Public_EventosInvitados form base class.
 *
 * @method Public_EventosInvitados getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePublic_EventosInvitadosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'funcionario_invitado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'unidad_invitado_id'      => new sfWidgetFormInputText(),
      'cargo_invitado_id'       => new sfWidgetFormInputText(),
      'evento_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Eventos'), 'add_empty' => false)),
      'aprobado'                => new sfWidgetFormInputText(),
      'id_create'               => new sfWidgetFormInputText(),
      'id_update'               => new sfWidgetFormInputText(),
      'ip_update'               => new sfWidgetFormInputText(),
      'ip_create'               => new sfWidgetFormInputText(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'funcionario_invitado_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'required' => false)),
      'unidad_invitado_id'      => new sfValidatorInteger(),
      'cargo_invitado_id'       => new sfValidatorInteger(),
      'evento_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Eventos'))),
      'aprobado'                => new sfValidatorInteger(),
      'id_create'               => new sfValidatorInteger(),
      'id_update'               => new sfValidatorInteger(),
      'ip_update'               => new sfValidatorString(array('max_length' => 50)),
      'ip_create'               => new sfValidatorString(array('max_length' => 50)),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('public_eventos_invitados[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_EventosInvitados';
  }

}
