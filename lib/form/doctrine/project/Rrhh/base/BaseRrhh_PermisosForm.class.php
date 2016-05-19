<?php

/**
 * Rrhh_Permisos form base class.
 *
 * @method Rrhh_Permisos getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRrhh_PermisosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                             => new sfWidgetFormInputHidden(),
      'configuraciones_permisos_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_Configuraciones'), 'add_empty' => false)),
      'funcionario_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'correspondencia_solicitud_id'   => new sfWidgetFormInputText(),
      'tipo_permiso'                   => new sfWidgetFormInputText(),
      'f_inicio_permiso'               => new sfWidgetFormDateTime(),
      'f_fin_permiso'                  => new sfWidgetFormDateTime(),
      'f_retorno_permiso'              => new sfWidgetFormDateTime(),
      'dias_solicitados'               => new sfWidgetFormInputText(),
      'dias_permiso_habiles'           => new sfWidgetFormInputText(),
      'dias_permiso_fin_semana'        => new sfWidgetFormInputText(),
      'dias_permiso_no_laborales'      => new sfWidgetFormInputText(),
      'dias_permiso_continuo'          => new sfWidgetFormInputText(),
      'observaciones_descritas'        => new sfWidgetFormTextarea(),
      'observaciones_automaticas'      => new sfWidgetFormTextarea(),
      'correspondencia_cancelacion_id' => new sfWidgetFormInputText(),
      'motivo_cancelacion'             => new sfWidgetFormTextarea(),
      'dias_permiso_ejecutados'        => new sfWidgetFormInputText(),
      'status'                         => new sfWidgetFormInputText(),
      'id_update'                      => new sfWidgetFormInputText(),
      'ip_update'                      => new sfWidgetFormInputText(),
      'clasificacion'                  => new sfWidgetFormInputText(),
      'created_at'                     => new sfWidgetFormDateTime(),
      'updated_at'                     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'configuraciones_permisos_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rrhh_Configuraciones'))),
      'funcionario_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'correspondencia_solicitud_id'   => new sfValidatorInteger(array('required' => false)),
      'tipo_permiso'                   => new sfValidatorString(array('max_length' => 255)),
      'f_inicio_permiso'               => new sfValidatorDateTime(),
      'f_fin_permiso'                  => new sfValidatorDateTime(),
      'f_retorno_permiso'              => new sfValidatorDateTime(),
      'dias_solicitados'               => new sfValidatorNumber(),
      'dias_permiso_habiles'           => new sfValidatorNumber(),
      'dias_permiso_fin_semana'        => new sfValidatorInteger(),
      'dias_permiso_no_laborales'      => new sfValidatorInteger(),
      'dias_permiso_continuo'          => new sfValidatorNumber(),
      'observaciones_descritas'        => new sfValidatorString(array('required' => false)),
      'observaciones_automaticas'      => new sfValidatorString(),
      'correspondencia_cancelacion_id' => new sfValidatorInteger(array('required' => false)),
      'motivo_cancelacion'             => new sfValidatorString(array('required' => false)),
      'dias_permiso_ejecutados'        => new sfValidatorNumber(),
      'status'                         => new sfValidatorString(array('max_length' => 1)),
      'id_update'                      => new sfValidatorInteger(),
      'ip_update'                      => new sfValidatorString(array('max_length' => 50)),
      'clasificacion'                  => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'created_at'                     => new sfValidatorDateTime(),
      'updated_at'                     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('rrhh_permisos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rrhh_Permisos';
  }

}
