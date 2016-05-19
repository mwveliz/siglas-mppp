<?php

/**
 * Rrhh_Vacaciones form base class.
 *
 * @method Rrhh_Vacaciones getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRrhh_VacacionesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                            => new sfWidgetFormInputHidden(),
      'configuraciones_vacaciones_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_Configuraciones'), 'add_empty' => false)),
      'funcionario_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'f_cumplimiento'                => new sfWidgetFormDate(),
      'periodo_vacacional'            => new sfWidgetFormInputText(),
      'anios_laborales'               => new sfWidgetFormInputText(),
      'dias_disfrute_establecidos'    => new sfWidgetFormInputText(),
      'dias_disfrute_adicionales'     => new sfWidgetFormInputText(),
      'dias_disfrute_totales'         => new sfWidgetFormInputText(),
      'dias_disfrute_pendientes'      => new sfWidgetFormInputText(),
      'pagadas'                       => new sfWidgetFormInputCheckbox(),
      'f_abono'                       => new sfWidgetFormDate(),
      'monto_abonado_concepto'        => new sfWidgetFormInputText(),
      'status'                        => new sfWidgetFormInputText(),
      'id_update'                     => new sfWidgetFormInputText(),
      'ip_update'                     => new sfWidgetFormInputText(),
      'created_at'                    => new sfWidgetFormDateTime(),
      'updated_at'                    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'configuraciones_vacaciones_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_Configuraciones'))),
      'funcionario_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'f_cumplimiento'                => new sfValidatorDate(),
      'periodo_vacacional'            => new sfValidatorString(array('max_length' => 9)),
      'anios_laborales'               => new sfValidatorInteger(),
      'dias_disfrute_establecidos'    => new sfValidatorInteger(),
      'dias_disfrute_adicionales'     => new sfValidatorInteger(),
      'dias_disfrute_totales'         => new sfValidatorInteger(),
      'dias_disfrute_pendientes'      => new sfValidatorInteger(),
      'pagadas'                       => new sfValidatorBoolean(),
      'f_abono'                       => new sfValidatorDate(array('required' => false)),
      'monto_abonado_concepto'        => new sfValidatorNumber(),
      'status'                        => new sfValidatorString(array('max_length' => 1)),
      'id_update'                     => new sfValidatorInteger(),
      'ip_update'                     => new sfValidatorString(array('max_length' => 50)),
      'created_at'                    => new sfValidatorDateTime(),
      'updated_at'                    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('rrhh_vacaciones[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rrhh_Vacaciones';
  }

}
