<?php

/**
 * Funcionarios_Residencia form base class.
 *
 * @method Funcionarios_Residencia getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_ResidenciaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'funcionario_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'estado_id'            => new sfWidgetFormInputText(),
      'municipio_id'         => new sfWidgetFormInputText(),
      'parroquia_id'         => new sfWidgetFormInputText(),
      'dir_av_calle_esq'     => new sfWidgetFormInputText(),
      'dir_edf_casa'         => new sfWidgetFormInputText(),
      'dir_piso'             => new sfWidgetFormInputText(),
      'dir_apt_nombre'       => new sfWidgetFormInputText(),
      'dir_urbanizacion'     => new sfWidgetFormInputText(),
      'dir_ciudad'           => new sfWidgetFormInputText(),
      'dir_punto_referencia' => new sfWidgetFormInputText(),
      'telf_uno'             => new sfWidgetFormInputText(),
      'telf_dos'             => new sfWidgetFormInputText(),
      'f_validado'           => new sfWidgetFormDateTime(),
      'id_validado'          => new sfWidgetFormInputText(),
      'status'               => new sfWidgetFormInputText(),
      'id_update'            => new sfWidgetFormInputText(),
      'ip_update'            => new sfWidgetFormInputText(),
      'proteccion'           => new sfWidgetFormTextarea(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'funcionario_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'estado_id'            => new sfValidatorString(array('max_length' => 2)),
      'municipio_id'         => new sfValidatorString(array('max_length' => 4)),
      'parroquia_id'         => new sfValidatorString(array('max_length' => 6)),
      'dir_av_calle_esq'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_edf_casa'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_piso'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_apt_nombre'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_urbanizacion'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_ciudad'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_punto_referencia' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'telf_uno'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'telf_dos'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'f_validado'           => new sfValidatorDateTime(array('required' => false)),
      'id_validado'          => new sfValidatorInteger(array('required' => false)),
      'status'               => new sfValidatorString(array('max_length' => 1)),
      'id_update'            => new sfValidatorInteger(),
      'ip_update'            => new sfValidatorString(array('max_length' => 40)),
      'proteccion'           => new sfValidatorString(array('required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_residencia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_Residencia';
  }

}
