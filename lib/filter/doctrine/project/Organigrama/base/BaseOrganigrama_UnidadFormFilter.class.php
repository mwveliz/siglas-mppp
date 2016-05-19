<?php

/**
 * Organigrama_Unidad filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrganigrama_UnidadFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_externo'           => new sfWidgetFormFilterInput(),
      'codigo_unidad'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'padre_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => true)),
      'unidad_tipo_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_UnidadTipo'), 'add_empty' => true)),
      'nombre'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre_reducido'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'siglas'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'adscripcion'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
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
      'f_ingreso'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'f_retiro'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'motivo_retiro'        => new sfWidgetFormFilterInput(),
      'orden_automatico'     => new sfWidgetFormFilterInput(),
      'orden_preferencial'   => new sfWidgetFormFilterInput(),
      'status'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_externo'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'codigo_unidad'        => new sfValidatorPass(array('required' => false)),
      'padre_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Unidad'), 'column' => 'id')),
      'unidad_tipo_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_UnidadTipo'), 'column' => 'id')),
      'nombre'               => new sfValidatorPass(array('required' => false)),
      'nombre_reducido'      => new sfValidatorPass(array('required' => false)),
      'siglas'               => new sfValidatorPass(array('required' => false)),
      'adscripcion'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
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
      'f_ingreso'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'f_retiro'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'motivo_retiro'        => new sfValidatorPass(array('required' => false)),
      'orden_automatico'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orden_preferencial'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'               => new sfValidatorPass(array('required' => false)),
      'id_update'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('organigrama_unidad_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organigrama_Unidad';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'id_externo'           => 'Number',
      'codigo_unidad'        => 'Text',
      'padre_id'             => 'ForeignKey',
      'unidad_tipo_id'       => 'ForeignKey',
      'nombre'               => 'Text',
      'nombre_reducido'      => 'Text',
      'siglas'               => 'Text',
      'adscripcion'          => 'Boolean',
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
      'f_ingreso'            => 'Date',
      'f_retiro'             => 'Date',
      'motivo_retiro'        => 'Text',
      'orden_automatico'     => 'Number',
      'orden_preferencial'   => 'Number',
      'status'               => 'Text',
      'id_update'            => 'Number',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
