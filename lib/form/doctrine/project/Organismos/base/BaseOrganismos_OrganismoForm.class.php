<?php

/**
 * Organismos_Organismo form base class.
 *
 * @method Organismos_Organismo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrganismos_OrganismoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'padre_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'), 'add_empty' => true)),
      'organismo_tipo_id'    => new sfWidgetFormInputText(),
      'nombre'               => new sfWidgetFormInputText(),
      'siglas'               => new sfWidgetFormInputText(),
      'estado_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Estado'), 'add_empty' => true)),
      'municipio_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Municipio'), 'add_empty' => true)),
      'parroquia_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Parroquia'), 'add_empty' => true)),
      'dir_av_calle_esq'     => new sfWidgetFormInputText(),
      'dir_edf_torre_anexo'  => new sfWidgetFormInputText(),
      'dir_piso'             => new sfWidgetFormInputText(),
      'dir_oficina'          => new sfWidgetFormInputText(),
      'dir_urbanizacion'     => new sfWidgetFormInputText(),
      'dir_ciudad'           => new sfWidgetFormInputText(),
      'dir_punto_referencia' => new sfWidgetFormInputText(),
      'telf_uno'             => new sfWidgetFormInputText(),
      'telf_dos'             => new sfWidgetFormInputText(),
      'email_principal'      => new sfWidgetFormInputText(),
      'email_secundario'     => new sfWidgetFormInputText(),
      'privado'              => new sfWidgetFormInputCheckbox(),
      'status'               => new sfWidgetFormInputText(),
      'id_update'            => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'padre_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'), 'required' => false)),
      'organismo_tipo_id'    => new sfValidatorInteger(array('required' => false)),
      'nombre'               => new sfValidatorString(array('max_length' => 255)),
      'siglas'               => new sfValidatorString(array('max_length' => 100)),
      'estado_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Estado'), 'required' => false)),
      'municipio_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Municipio'), 'required' => false)),
      'parroquia_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Parroquia'), 'required' => false)),
      'dir_av_calle_esq'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_edf_torre_anexo'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_piso'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_oficina'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_urbanizacion'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_ciudad'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dir_punto_referencia' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'telf_uno'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'telf_dos'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email_principal'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email_secundario'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'privado'              => new sfValidatorBoolean(array('required' => false)),
      'status'               => new sfValidatorString(array('max_length' => 1)),
      'id_update'            => new sfValidatorInteger(),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('organismos_organismo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organismos_Organismo';
  }

}
