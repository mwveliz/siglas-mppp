<?php

/**
 * Organigrama_TelefonoCargo filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrganigrama_TelefonoCargoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cargo_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Cargo'), 'add_empty' => true)),
      'telefono'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'cargo_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Cargo'), 'column' => 'id')),
      'telefono'   => new sfValidatorPass(array('required' => false)),
      'id_update'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'     => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('organigrama_telefono_cargo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organigrama_TelefonoCargo';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'cargo_id'   => 'ForeignKey',
      'telefono'   => 'Text',
      'id_update'  => 'Number',
      'status'     => 'Text',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
