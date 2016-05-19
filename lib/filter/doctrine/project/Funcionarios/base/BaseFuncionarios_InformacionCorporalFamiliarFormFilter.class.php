<?php

/**
 * Funcionarios_InformacionCorporalFamiliar filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFuncionarios_InformacionCorporalFamiliarFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'familiar_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Familiar'), 'add_empty' => true)),
      'color_ojos'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'color_cabello'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'color_piel'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'peso'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'altura'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'talla_camisa'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'talla_pantalon' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'talla_calzado'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'talla_gorra'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'f_validado'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_validado'    => new sfWidgetFormFilterInput(),
      'status'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'familiar_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Familiar'), 'column' => 'id')),
      'color_ojos'     => new sfValidatorPass(array('required' => false)),
      'color_cabello'  => new sfValidatorPass(array('required' => false)),
      'color_piel'     => new sfValidatorPass(array('required' => false)),
      'peso'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'altura'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'talla_camisa'   => new sfValidatorPass(array('required' => false)),
      'talla_pantalon' => new sfValidatorPass(array('required' => false)),
      'talla_calzado'  => new sfValidatorPass(array('required' => false)),
      'talla_gorra'    => new sfValidatorPass(array('required' => false)),
      'f_validado'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'id_validado'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'         => new sfValidatorPass(array('required' => false)),
      'id_update'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'      => new sfValidatorPass(array('required' => false)),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('funcionarios_informacion_corporal_familiar_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Funcionarios_InformacionCorporalFamiliar';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'familiar_id'    => 'ForeignKey',
      'color_ojos'     => 'Text',
      'color_cabello'  => 'Text',
      'color_piel'     => 'Text',
      'peso'           => 'Number',
      'altura'         => 'Number',
      'talla_camisa'   => 'Text',
      'talla_pantalon' => 'Text',
      'talla_calzado'  => 'Text',
      'talla_gorra'    => 'Text',
      'f_validado'     => 'Date',
      'id_validado'    => 'Number',
      'status'         => 'Text',
      'id_update'      => 'Number',
      'ip_update'      => 'Text',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
