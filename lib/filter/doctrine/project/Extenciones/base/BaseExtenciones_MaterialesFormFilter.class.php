<?php

/**
 * Extenciones_Materiales filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseExtenciones_MaterialesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'unidad_medida_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Extenciones_UnidadMedida'), 'add_empty' => true)),
      'nombre'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'stop'                      => new sfWidgetFormFilterInput(),
      'status'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'material_clasificacion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Extenciones_MaterialClasificacion'), 'add_empty' => true)),
      'created_at'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'unidad_medida_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Extenciones_UnidadMedida'), 'column' => 'id')),
      'nombre'                    => new sfValidatorPass(array('required' => false)),
      'stop'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'                    => new sfValidatorPass(array('required' => false)),
      'id_update'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'material_clasificacion_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Extenciones_MaterialClasificacion'), 'column' => 'id')),
      'created_at'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('extenciones_materiales_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Extenciones_Materiales';
  }

  public function getFields()
  {
    return array(
      'id'                        => 'Number',
      'unidad_medida_id'          => 'ForeignKey',
      'nombre'                    => 'Text',
      'stop'                      => 'Number',
      'status'                    => 'Text',
      'id_update'                 => 'Number',
      'material_clasificacion_id' => 'ForeignKey',
      'created_at'                => 'Date',
      'updated_at'                => 'Date',
    );
  }
}
