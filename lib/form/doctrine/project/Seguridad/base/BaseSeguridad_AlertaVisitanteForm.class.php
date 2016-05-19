<?php

/**
 * Seguridad_AlertaVisitante form base class.
 *
 * @method Seguridad_AlertaVisitante getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeguridad_AlertaVisitanteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'ci'          => new sfWidgetFormInputText(),
      'descripcion' => new sfWidgetFormTextarea(),
      'status'      => new sfWidgetFormInputText(),
      'id_create'   => new sfWidgetFormInputText(),
      'id_update'   => new sfWidgetFormInputText(),
      'ip_update'   => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'ci'          => new sfValidatorNumber(),
      'descripcion' => new sfValidatorString(),
      'status'      => new sfValidatorString(array('max_length' => 1)),
      'id_create'   => new sfValidatorInteger(),
      'id_update'   => new sfValidatorInteger(),
      'ip_update'   => new sfValidatorString(array('max_length' => 50)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('seguridad_alerta_visitante[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seguridad_AlertaVisitante';
  }

}
