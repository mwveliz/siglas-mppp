<?php

/**
 * Public_CarreraUniversitaria filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePublic_CarreraUniversitariaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'organismo_educativo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'), 'add_empty' => true)),
      'area_conocimiento_id'   => new sfWidgetFormFilterInput(),
      'nombre'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'organismo_educativo_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organismos_Organismo'), 'column' => 'id')),
      'area_conocimiento_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'                 => new sfValidatorPass(array('required' => false)),
      'status'                 => new sfValidatorPass(array('required' => false)),
      'id_update'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('public_carrera_universitaria_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_CarreraUniversitaria';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'organismo_educativo_id' => 'ForeignKey',
      'area_conocimiento_id'   => 'Number',
      'nombre'                 => 'Text',
      'status'                 => 'Text',
      'id_update'              => 'Number',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
