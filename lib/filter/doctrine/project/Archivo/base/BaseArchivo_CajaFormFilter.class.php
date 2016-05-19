<?php

/**
 * Archivo_Caja filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArchivo_CajaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'estante_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Estante'), 'add_empty' => true)),
      'caja_modelo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_CajaModelo'), 'add_empty' => true)),
      'correlativo'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'unidad_correlativos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_UnidadCorrelativos'), 'add_empty' => true)),
      'tramo'                  => new sfWidgetFormFilterInput(),
      'porcentaje_ocupado'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'estante_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_Estante'), 'column' => 'id')),
      'caja_modelo_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_CajaModelo'), 'column' => 'id')),
      'correlativo'            => new sfValidatorPass(array('required' => false)),
      'unidad_correlativos_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_UnidadCorrelativos'), 'column' => 'id')),
      'tramo'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'porcentaje_ocupado'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_update'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('archivo_caja_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_Caja';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'estante_id'             => 'ForeignKey',
      'caja_modelo_id'         => 'ForeignKey',
      'correlativo'            => 'Text',
      'unidad_correlativos_id' => 'ForeignKey',
      'tramo'                  => 'Number',
      'porcentaje_ocupado'     => 'Number',
      'id_update'              => 'Number',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
