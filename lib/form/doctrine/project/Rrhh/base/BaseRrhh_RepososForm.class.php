<?php

/**
 * Rrhh_Reposos form base class.
 *
 * @method Rrhh_Reposos getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRrhh_RepososForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                             => new sfWidgetFormInputHidden(),
      'configuraciones_reposos_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_Configuraciones'), 'add_empty' => false)),
      'funcionario_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'correspondencia_solicitud_id'   => new sfWidgetFormInputText(),
      'tipo_reposo'                    => new sfWidgetFormInputText(),
      'f_inicio_reposo'                => new sfWidgetFormDate(),
      'f_fin_reposo'                   => new sfWidgetFormDate(),
      'f_retorno_reposo'               => new sfWidgetFormDate(),
      'dias_solicitados'               => new sfWidgetFormInputText(),
      'dias_reposo_habiles'            => new sfWidgetFormInputText(),
      'dias_reposo_fin_semana'         => new sfWidgetFormInputText(),
      'dias_reposo_no_laborales'       => new sfWidgetFormInputText(),
      'dias_reposo_continuo'           => new sfWidgetFormInputText(),
      'observaciones_descritas'        => new sfWidgetFormTextarea(),
      'observaciones_automaticas'      => new sfWidgetFormTextarea(),
      'correspondencia_cancelacion_id' => new sfWidgetFormInputText(),
      'motivo_cancelacion'             => new sfWidgetFormTextarea(),
      'dias_reposo_ejecutados'         => new sfWidgetFormInputText(),
      'status'                         => new sfWidgetFormInputText(),
      'id_update'                      => new sfWidgetFormInputText(),
      'ip_update'                      => new sfWidgetFormInputText(),
      'clasificacion'                  => new sfWidgetFormInputText(),
      'created_at'                     => new sfWidgetFormDateTime(),
      'updated_at'                     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'configuraciones_reposos_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_Configuraciones'))),
      'funcionario_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'correspondencia_solicitud_id'   => new sfValidatorInteger(array('required' => false)),
      'tipo_reposo'                    => new sfValidatorString(array('max_length' => 255)),
      'f_inicio_reposo'                => new sfValidatorDate(),
      'f_fin_reposo'                   => new sfValidatorDate(),
      'f_retorno_reposo'               => new sfValidatorDate(),
      'dias_solicitados'               => new sfValidatorInteger(),
      'dias_reposo_habiles'            => new sfValidatorInteger(),
      'dias_reposo_fin_semana'         => new sfValidatorInteger(),
      'dias_reposo_no_laborales'       => new sfValidatorInteger(),
      'dias_reposo_continuo'           => new sfValidatorInteger(),
      'observaciones_descritas'        => new sfValidatorString(array('required' => false)),
      'observaciones_automaticas'      => new sfValidatorString(),
      'correspondencia_cancelacion_id' => new sfValidatorInteger(array('required' => false)),
      'motivo_cancelacion'             => new sfValidatorString(array('required' => false)),
      'dias_reposo_ejecutados'         => new sfValidatorInteger(),
      'status'                         => new sfValidatorString(array('max_length' => 1)),
      'id_update'                      => new sfValidatorInteger(),
      'ip_update'                      => new sfValidatorString(array('max_length' => 50)),
      'clasificacion'                  => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'created_at'                     => new sfValidatorDateTime(),
      'updated_at'                     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('rrhh_reposos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rrhh_Reposos';
  }

}
