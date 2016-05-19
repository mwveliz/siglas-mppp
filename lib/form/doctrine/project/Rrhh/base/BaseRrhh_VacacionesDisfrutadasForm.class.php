<?php

/**
 * Rrhh_VacacionesDisfrutadas form base class.
 *
 * @method Rrhh_VacacionesDisfrutadas getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRrhh_VacacionesDisfrutadasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                           => new sfWidgetFormInputHidden(),
      'vacaciones_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_Vacaciones'), 'add_empty' => false)),
      'correspondencia_solicitud_id' => new sfWidgetFormInputText(),
      'f_inicio_disfrute'            => new sfWidgetFormDate(),
      'f_fin_disfrute'               => new sfWidgetFormDate(),
      'f_retorno_disfrute'           => new sfWidgetFormDate(),
      'dias_solicitados'             => new sfWidgetFormInputText(),
      'dias_disfrute_habiles'        => new sfWidgetFormInputText(),
      'dias_disfrute_fin_semana'     => new sfWidgetFormInputText(),
      'dias_disfrute_no_laborales'   => new sfWidgetFormInputText(),
      'dias_disfrute_continuo'       => new sfWidgetFormInputText(),
      'observaciones_descritas'      => new sfWidgetFormTextarea(),
      'observaciones_automaticas'    => new sfWidgetFormTextarea(),
      'dias_disfrute_ejecutados'     => new sfWidgetFormInputText(),
      'dias_pendientes'              => new sfWidgetFormInputText(),
      'status'                       => new sfWidgetFormInputText(),
      'id_update'                    => new sfWidgetFormInputText(),
      'ip_update'                    => new sfWidgetFormInputText(),
      'created_at'                   => new sfWidgetFormDateTime(),
      'updated_at'                   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'vacaciones_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_Vacaciones'))),
      'correspondencia_solicitud_id' => new sfValidatorInteger(array('required' => false)),
      'f_inicio_disfrute'            => new sfValidatorDate(),
      'f_fin_disfrute'               => new sfValidatorDate(),
      'f_retorno_disfrute'           => new sfValidatorDate(),
      'dias_solicitados'             => new sfValidatorInteger(),
      'dias_disfrute_habiles'        => new sfValidatorInteger(),
      'dias_disfrute_fin_semana'     => new sfValidatorInteger(),
      'dias_disfrute_no_laborales'   => new sfValidatorInteger(),
      'dias_disfrute_continuo'       => new sfValidatorInteger(),
      'observaciones_descritas'      => new sfValidatorString(array('required' => false)),
      'observaciones_automaticas'    => new sfValidatorString(),
      'dias_disfrute_ejecutados'     => new sfValidatorInteger(),
      'dias_pendientes'              => new sfValidatorInteger(),
      'status'                       => new sfValidatorString(array('max_length' => 1)),
      'id_update'                    => new sfValidatorInteger(),
      'ip_update'                    => new sfValidatorString(array('max_length' => 50)),
      'created_at'                   => new sfValidatorDateTime(),
      'updated_at'                   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('rrhh_vacaciones_disfrutadas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rrhh_VacacionesDisfrutadas';
  }

}
