<?php

/**
 * Correspondencia_VistobuenoGeneralConfig filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_VistobuenoGeneralConfigFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'     => new sfWidgetFormFilterInput(),
      'tipo_formato_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_TipoFormato'), 'add_empty' => true)),
      'status'          => new sfWidgetFormFilterInput(),
      'id_update'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_create'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_create'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'nombre'          => new sfValidatorPass(array('required' => false)),
      'descripcion'     => new sfValidatorPass(array('required' => false)),
      'tipo_formato_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Correspondencia_TipoFormato'), 'column' => 'id')),
      'status'          => new sfValidatorPass(array('required' => false)),
      'id_update'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_create'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'       => new sfValidatorPass(array('required' => false)),
      'ip_create'       => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_vistobueno_general_config_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_VistobuenoGeneralConfig';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'nombre'          => 'Text',
      'descripcion'     => 'Text',
      'tipo_formato_id' => 'ForeignKey',
      'status'          => 'Text',
      'id_update'       => 'Number',
      'id_create'       => 'Number',
      'ip_update'       => 'Text',
      'ip_create'       => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
