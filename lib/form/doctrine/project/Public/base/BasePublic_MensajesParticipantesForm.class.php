<?php

/**
 * Public_MensajesParticipantes form base class.
 *
 * @method Public_MensajesParticipantes getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePublic_MensajesParticipantesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'mensajes_grupo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_MensajesGrupo'), 'add_empty' => false)),
      'funcionario_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'mensajes_grupo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_MensajesGrupo'))),
      'funcionario_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
    ));

    $this->widgetSchema->setNameFormat('public_mensajes_participantes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_MensajesParticipantes';
  }

}
