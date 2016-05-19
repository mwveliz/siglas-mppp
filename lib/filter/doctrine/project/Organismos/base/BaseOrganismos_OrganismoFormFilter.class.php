<?php

/**
 * Organismos_Organismo filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrganismos_OrganismoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'padre_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'), 'add_empty' => true)),
      'organismo_tipo_id'    => new sfWidgetFormFilterInput(),
      'nombre'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'siglas'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'estado_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Estado'), 'add_empty' => true)),
      'municipio_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Municipio'), 'add_empty' => true)),
      'parroquia_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Parroquia'), 'add_empty' => true)),
      'dir_av_calle_esq'     => new sfWidgetFormFilterInput(),
      'dir_edf_torre_anexo'  => new sfWidgetFormFilterInput(),
      'dir_piso'             => new sfWidgetFormFilterInput(),
      'dir_oficina'          => new sfWidgetFormFilterInput(),
      'dir_urbanizacion'     => new sfWidgetFormFilterInput(),
      'dir_ciudad'           => new sfWidgetFormFilterInput(),
      'dir_punto_referencia' => new sfWidgetFormFilterInput(),
      'telf_uno'             => new sfWidgetFormFilterInput(),
      'telf_dos'             => new sfWidgetFormFilterInput(),
      'email_principal'      => new sfWidgetFormFilterInput(),
      'email_secundario'     => new sfWidgetFormFilterInput(),
      'privado'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'status'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'padre_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organismos_Organismo'), 'column' => 'id')),
      'organismo_tipo_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'               => new sfValidatorPass(array('required' => false)),
      'siglas'               => new sfValidatorPass(array('required' => false)),
      'estado_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Public_Estado'), 'column' => 'id')),
      'municipio_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Public_Municipio'), 'column' => 'id')),
      'parroquia_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Public_Parroquia'), 'column' => 'id')),
      'dir_av_calle_esq'     => new sfValidatorPass(array('required' => false)),
      'dir_edf_torre_anexo'  => new sfValidatorPass(array('required' => false)),
      'dir_piso'             => new sfValidatorPass(array('required' => false)),
      'dir_oficina'          => new sfValidatorPass(array('required' => false)),
      'dir_urbanizacion'     => new sfValidatorPass(array('required' => false)),
      'dir_ciudad'           => new sfValidatorPass(array('required' => false)),
      'dir_punto_referencia' => new sfValidatorPass(array('required' => false)),
      'telf_uno'             => new sfValidatorPass(array('required' => false)),
      'telf_dos'             => new sfValidatorPass(array('required' => false)),
      'email_principal'      => new sfValidatorPass(array('required' => false)),
      'email_secundario'     => new sfValidatorPass(array('required' => false)),
      'privado'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'status'               => new sfValidatorPass(array('required' => false)),
      'id_update'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('organismos_organismo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organismos_Organismo';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'padre_id'             => 'ForeignKey',
      'organismo_tipo_id'    => 'Number',
      'nombre'               => 'Text',
      'siglas'               => 'Text',
      'estado_id'            => 'ForeignKey',
      'municipio_id'         => 'ForeignKey',
      'parroquia_id'         => 'ForeignKey',
      'dir_av_calle_esq'     => 'Text',
      'dir_edf_torre_anexo'  => 'Text',
      'dir_piso'             => 'Text',
      'dir_oficina'          => 'Text',
      'dir_urbanizacion'     => 'Text',
      'dir_ciudad'           => 'Text',
      'dir_punto_referencia' => 'Text',
      'telf_uno'             => 'Text',
      'telf_dos'             => 'Text',
      'email_principal'      => 'Text',
      'email_secundario'     => 'Text',
      'privado'              => 'Boolean',
      'status'               => 'Text',
      'id_update'            => 'Number',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
