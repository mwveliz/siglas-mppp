<?php

/**
 * Archivo_TipologiaDocumental filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArchivo_TipologiaDocumentalFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'serie_documental_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_SerieDocumental'), 'add_empty' => true)),
      'cuerpo_documental_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_CuerpoDocumental'), 'add_empty' => true)),
      'nombre'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'orden'                => new sfWidgetFormFilterInput(),
      'status'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'serie_documental_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_SerieDocumental'), 'column' => 'id')),
      'cuerpo_documental_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_CuerpoDocumental'), 'column' => 'id')),
      'nombre'               => new sfValidatorPass(array('required' => false)),
      'orden'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'               => new sfValidatorPass(array('required' => false)),
      'id_update'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('archivo_tipologia_documental_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_TipologiaDocumental';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'serie_documental_id'  => 'ForeignKey',
      'cuerpo_documental_id' => 'ForeignKey',
      'nombre'               => 'Text',
      'orden'                => 'Number',
      'status'               => 'Text',
      'id_update'            => 'Number',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
