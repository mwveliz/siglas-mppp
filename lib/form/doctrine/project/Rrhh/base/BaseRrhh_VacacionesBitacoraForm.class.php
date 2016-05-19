<?php

/**
 * Rrhh_VacacionesBitacora form base class.
 *
 * @method Rrhh_VacacionesBitacora getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRrhh_VacacionesBitacoraForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'vacaciones_disfrutadas_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_VacacionesDisfrutadas'), 'add_empty' => false)),
      'correspondencia_bitacora_id' => new sfWidgetFormInputText(),
      'tipo'                        => new sfWidgetFormInputText(),
      'reposos_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_Reposos'), 'add_empty' => true)),
      'f_retorno_real'              => new sfWidgetFormDate(),
      'dias_agregados_disfrute'     => new sfWidgetFormInputText(),
      'status'                      => new sfWidgetFormInputText(),
      'id_update'                   => new sfWidgetFormInputText(),
      'ip_update'                   => new sfWidgetFormInputText(),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'vacaciones_disfrutadas_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_VacacionesDisfrutadas'))),
      'correspondencia_bitacora_id' => new sfValidatorInteger(),
      'tipo'                        => new sfValidatorString(array('max_length' => 255)),
      'reposos_id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_Reposos'), 'required' => false)),
      'f_retorno_real'              => new sfValidatorDate(),
      'dias_agregados_disfrute'     => new sfValidatorInteger(),
      'status'                      => new sfValidatorString(array('max_length' => 1)),
      'id_update'                   => new sfValidatorInteger(),
      'ip_update'                   => new sfValidatorString(array('max_length' => 50)),
      'created_at'                  => new sfValidatorDateTime(),
      'updated_at'                  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('rrhh_vacaciones_bitacora[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rrhh_VacacionesBitacora';
  }

}
