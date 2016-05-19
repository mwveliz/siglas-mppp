<?php

/**
 * Seguridad_Equipo filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSeguridad_EquipoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tipo_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Tipo'), 'add_empty' => true)),
      'marca_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seguridad_Marca'), 'add_empty' => true)),
      'serial'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'tipo_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Seguridad_Tipo'), 'column' => 'id')),
      'marca_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Seguridad_Marca'), 'column' => 'id')),
      'serial'     => new sfValidatorPass(array('required' => false)),
      'id_update'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'  => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('seguridad_equipo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seguridad_Equipo';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'tipo_id'    => 'ForeignKey',
      'marca_id'   => 'ForeignKey',
      'serial'     => 'Text',
      'id_update'  => 'Number',
      'ip_update'  => 'Text',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
