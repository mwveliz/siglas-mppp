<?php

/**
 * Siglas_ActualizacionSvn form base class.
 *
 * @method Siglas_ActualizacionSvn getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSiglas_ActualizacionSvnForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'f_actualizacion' => new sfWidgetFormDateTime(),
      'version_siglas'  => new sfWidgetFormInputText(),
      'revision_svn'    => new sfWidgetFormInputText(),
      'log_cambios'     => new sfWidgetFormTextarea(),
      'id_update'       => new sfWidgetFormInputText(),
      'ip_update'       => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'f_actualizacion' => new sfValidatorDateTime(),
      'version_siglas'  => new sfValidatorString(array('max_length' => 30)),
      'revision_svn'    => new sfValidatorString(array('max_length' => 30)),
      'log_cambios'     => new sfValidatorString(),
      'id_update'       => new sfValidatorInteger(),
      'ip_update'       => new sfValidatorString(array('max_length' => 30)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('siglas_actualizacion_svn[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Siglas_ActualizacionSvn';
  }

}
