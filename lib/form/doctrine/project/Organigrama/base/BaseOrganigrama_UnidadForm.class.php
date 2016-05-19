<?php

/**
 * Organigrama_Unidad form base class.
 *
 * @method Organigrama_Unidad getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrganigrama_UnidadForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'id_externo'           => new sfWidgetFormInputText(),
      'codigo_unidad'        => new sfWidgetFormInputText(),
      'padre_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => true)),
      'unidad_tipo_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_UnidadTipo'), 'add_empty' => false)),
      'nombre'               => new sfWidgetFormInputText(),
      'nombre_reducido'      => new sfWidgetFormInputText(),
      'siglas'               => new sfWidgetFormInputText(),
      'adscripcion'          => new sfWidgetFormInputCheckbox(),
      'estado_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Estado'), 'add_empty' => false)),
      'municipio_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Municipio'), 'add_empty' => false)),
      'parroquia_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Parroquia'), 'add_empty' => false)),
      'dir_av_calle_esq'     => new sfWidgetFormInputText(),
      'dir_edf_torre_anexo'  => new sfWidgetFormInputText(),
      'dir_piso'             => new sfWidgetFormInputText(),
      'dir_oficina'          => new sfWidgetFormInputText(),
      'dir_urbanizacion'     => new sfWidgetFormInputText(),
      'dir_ciudad'           => new sfWidgetFormInputText(),
      'dir_punto_referencia' => new sfWidgetFormInputText(),
      'telf_uno'             => new sfWidgetFormInputText(),
      'telf_dos'             => new sfWidgetFormInputText(),
      'f_ingreso'            => new sfWidgetFormDate(),
      'f_retiro'             => new sfWidgetFormDate(),
      'motivo_retiro'        => new sfWidgetFormInputText(),
      'orden_automatico'     => new sfWidgetFormInputText(),
      'orden_preferencial'   => new sfWidgetFormInputText(),
      'status'               => new sfWidgetFormInputText(),
      'id_update'            => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'id_externo'           => new sfValidatorInteger(array('required' => false)),
      'codigo_unidad'        => new sfValidatorString(array('max_length' => 12)),
      'padre_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'required' => false)),
      'unidad_tipo_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_UnidadTipo'))),
      'nombre'               => new sfValidatorString(array('max_length' => 255)),
      'nombre_reducido'      => new sfValidatorString(array('max_length' => 255)),
      'siglas'               => new sfValidatorString(array('max_length' => 100)),
      'adscripcion'          => new sfValidatorBoolean(),
      'estado_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Estado'))),
      'municipio_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Municipio'))),
      'parroquia_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Parroquia'))),
      'dir_av_calle_esq'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_edf_torre_anexo'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_piso'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_oficina'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_urbanizacion'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_ciudad'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_punto_referencia' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'telf_uno'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'telf_dos'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'f_ingreso'            => new sfValidatorDate(),
      'f_retiro'             => new sfValidatorDate(array('required' => false)),
      'motivo_retiro'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'orden_automatico'     => new sfValidatorInteger(array('required' => false)),
      'orden_preferencial'   => new sfValidatorInteger(array('required' => false)),
      'status'               => new sfValidatorString(array('max_length' => 1)),
      'id_update'            => new sfValidatorInteger(),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('organigrama_unidad[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organigrama_Unidad';
  }

}
