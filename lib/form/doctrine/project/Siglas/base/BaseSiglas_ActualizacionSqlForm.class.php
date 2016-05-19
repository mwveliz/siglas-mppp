<?php

/**
 * Siglas_ActualizacionSql form base class.
 *
 * @method Siglas_ActualizacionSql getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSiglas_ActualizacionSqlForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'f_actualizacion' => new sfWidgetFormDateTime(),
      'archivo'         => new sfWidgetFormTextarea(),
      'detalles_sql'    => new sfWidgetFormTextarea(),
      'id_update'       => new sfWidgetFormInputText(),
      'ip_update'       => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'f_actualizacion' => new sfValidatorDateTime(),
      'archivo'         => new sfValidatorString(array('max_length' => 500)),
      'detalles_sql'    => new sfValidatorString(),
      'id_update'       => new sfValidatorInteger(),
      'ip_update'       => new sfValidatorString(array('max_length' => 30)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('siglas_actualizacion_sql[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Siglas_ActualizacionSql';
  }

}
