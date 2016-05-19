<?php

/**
 * Funcionarios_EducacionMedia form base class.
 *
 * @method Funcionarios_EducacionMedia getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_EducacionMediaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'funcionario_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'pais_id'                => new sfWidgetFormInputText(),
      'organismo_educativo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'), 'add_empty' => true)),
      'especialidad_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Especialidad'), 'add_empty' => true)),
      'nivel_academico_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_NivelAcademico'), 'add_empty' => false)),
      'f_ingreso'              => new sfWidgetFormDate(),
      'f_graduado'             => new sfWidgetFormDate(),
      'estudiando_actualmente' => new sfWidgetFormInputCheckbox(),
      'f_validado'             => new sfWidgetFormDateTime(),
      'id_validado'            => new sfWidgetFormInputText(),
      'status'                 => new sfWidgetFormInputText(),
      'id_update'              => new sfWidgetFormInputText(),
      'ip_update'              => new sfWidgetFormInputText(),
      'proteccion'             => new sfWidgetFormTextarea(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'funcionario_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'pais_id'                => new sfValidatorInteger(),
      'organismo_educativo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'), 'required' => false)),
      'especialidad_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Especialidad'), 'required' => false)),
      'nivel_academico_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_NivelAcademico'))),
      'f_ingreso'              => new sfValidatorDate(),
      'f_graduado'             => new sfValidatorDate(array('required' => false)),
      'estudiando_actualmente' => new sfValidatorBoolean(),
      'f_validado'             => new sfValidatorDateTime(array('required' => false)),
      'id_validado'            => new sfValidatorInteger(array('required' => false)),
      'status'                 => new sfValidatorString(array('max_length' => 1)),
      'id_update'              => new sfValidatorInteger(),
      'ip_update'              => new sfValidatorString(array('max_length' => 40)),
      'proteccion'             => new sfValidatorString(array('required' => false)),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_educacion_media[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_EducacionMedia';
  }

}
