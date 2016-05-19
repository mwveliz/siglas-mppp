<?php

/**
 * Inventario_Inventario filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseInventario_InventarioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'almacen_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Inventario_Almacen'), 'add_empty' => true)),
      'articulo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Inventario_Articulo'), 'add_empty' => true)),
      'articulo_ingreso_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Inventario_ArticuloIngreso'), 'add_empty' => true)),
      'cantidad_inicial'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cantidad_actual'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'almacen_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Inventario_Almacen'), 'column' => 'id')),
      'articulo_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Inventario_Articulo'), 'column' => 'id')),
      'articulo_ingreso_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Inventario_ArticuloIngreso'), 'column' => 'id')),
      'cantidad_inicial'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cantidad_actual'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'status'              => new sfValidatorPass(array('required' => false)),
      'id_update'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'           => new sfValidatorPass(array('required' => false)),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('inventario_inventario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Inventario_Inventario';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'almacen_id'          => 'ForeignKey',
      'articulo_id'         => 'ForeignKey',
      'articulo_ingreso_id' => 'ForeignKey',
      'cantidad_inicial'    => 'Number',
      'cantidad_actual'     => 'Number',
      'status'              => 'Text',
      'id_update'           => 'Number',
      'ip_update'           => 'Text',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
