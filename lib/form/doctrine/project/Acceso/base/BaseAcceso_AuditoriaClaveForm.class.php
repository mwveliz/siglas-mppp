<?php

/**
 * Acceso_AuditoriaClave form base class.
 *
 * @method Acceso_AuditoriaClave getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAcceso_AuditoriaClaveForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'usuario_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_Usuario'), 'add_empty' => false)),
      'clave'        => new sfWidgetFormInputText(),
      'fecha_cambio' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'usuario_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_Usuario'))),
      'clave'        => new sfValidatorString(array('max_length' => 100)),
      'fecha_cambio' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('acceso_auditoria_clave[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Acceso_AuditoriaClave';
  }

}
