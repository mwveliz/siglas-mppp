<?php

/**
 * Inventario_ArticuloEgreso filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseInventario_ArticuloEgresoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'correspondencia_solicitud_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_CorrespondenciaSolicitud'), 'add_empty' => true)),
      'correspondencia_aprobacion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_CorrespondenciaAprobacion'), 'add_empty' => true)),
      'unidad_id'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => true)),
      'inventario_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Inventario_Inventario'), 'add_empty' => true)),
      'articulo_id'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cantidad'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'f_egreso'                      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'status'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'correspondencia_solicitud_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Correspondencia_CorrespondenciaSolicitud'), 'column' => 'id')),
      'correspondencia_aprobacion_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Correspondencia_CorrespondenciaAprobacion'), 'column' => 'id')),
      'unidad_id'                     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Unidad'), 'column' => 'id')),
      'inventario_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Inventario_Inventario'), 'column' => 'id')),
      'articulo_id'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidad'                      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'f_egreso'                      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'status'                        => new sfValidatorPass(array('required' => false)),
      'id_update'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'                     => new sfValidatorPass(array('required' => false)),
      'created_at'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('inventario_articulo_egreso_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Inventario_ArticuloEgreso';
  }

  public function getFields()
  {
    return array(
      'id'                            => 'Number',
      'correspondencia_solicitud_id'  => 'ForeignKey',
      'correspondencia_aprobacion_id' => 'ForeignKey',
      'unidad_id'                     => 'ForeignKey',
      'inventario_id'                 => 'ForeignKey',
      'articulo_id'                   => 'Number',
      'cantidad'                      => 'Number',
      'f_egreso'                      => 'Date',
      'status'                        => 'Text',
      'id_update'                     => 'Number',
      'ip_update'                     => 'Text',
      'created_at'                    => 'Date',
      'updated_at'                    => 'Date',
    );
  }
}
