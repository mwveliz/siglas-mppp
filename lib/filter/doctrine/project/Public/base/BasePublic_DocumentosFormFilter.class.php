<?php

/**
 * Public_Documentos filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePublic_DocumentosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'codigo'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'contenido'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'documento_tipo_id' => new sfWidgetFormFilterInput(),
      'id_update'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'codigo'            => new sfValidatorPass(array('required' => false)),
      'contenido'         => new sfValidatorPass(array('required' => false)),
      'documento_tipo_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_update'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('public_documentos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_Documentos';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'codigo'            => 'Text',
      'contenido'         => 'Text',
      'documento_tipo_id' => 'Number',
      'id_update'         => 'Number',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
