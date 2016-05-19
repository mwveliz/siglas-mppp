<?php

/**
 * Public_MensajesParticipantes filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePublic_MensajesParticipantesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mensajes_grupo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_MensajesGrupo'), 'add_empty' => true)),
      'funcionario_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'mensajes_grupo_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Public_MensajesGrupo'), 'column' => 'id')),
      'funcionario_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('public_mensajes_participantes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_MensajesParticipantes';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'mensajes_grupo_id' => 'ForeignKey',
      'funcionario_id'    => 'ForeignKey',
    );
  }
}
