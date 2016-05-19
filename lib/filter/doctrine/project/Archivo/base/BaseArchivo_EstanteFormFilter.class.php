<?php

/**
 * Archivo_Estante filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArchivo_EstanteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'estante_modelo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_EstanteModelo'), 'add_empty' => true)),
      'unidad_duena_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_UnidadDuena'), 'add_empty' => true)),
      'unidad_fisica_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_UnidadFisica'), 'add_empty' => true)),
      'identificador'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tramos'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'alto_tramos'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ancho_tramos'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'largo_tramos'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'porcentaje_ocupado'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'detalles_ubicacion_fisica' => new sfWidgetFormFilterInput(),
      'id_update'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'estante_modelo_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_EstanteModelo'), 'column' => 'id')),
      'unidad_duena_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_UnidadDuena'), 'column' => 'id')),
      'unidad_fisica_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_UnidadFisica'), 'column' => 'id')),
      'identificador'             => new sfValidatorPass(array('required' => false)),
      'tramos'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'alto_tramos'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ancho_tramos'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'largo_tramos'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'porcentaje_ocupado'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'detalles_ubicacion_fisica' => new sfValidatorPass(array('required' => false)),
      'id_update'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('archivo_estante_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_Estante';
  }

  public function getFields()
  {
    return array(
      'id'                        => 'Number',
      'estante_modelo_id'         => 'ForeignKey',
      'unidad_duena_id'           => 'ForeignKey',
      'unidad_fisica_id'          => 'ForeignKey',
      'identificador'             => 'Text',
      'tramos'                    => 'Number',
      'alto_tramos'               => 'Number',
      'ancho_tramos'              => 'Number',
      'largo_tramos'              => 'Number',
      'porcentaje_ocupado'        => 'Number',
      'detalles_ubicacion_fisica' => 'Text',
      'id_update'                 => 'Number',
      'created_at'                => 'Date',
      'updated_at'                => 'Date',
    );
  }
}
