<?php

/**
 * Archivo_Etiqueta filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArchivo_EtiquetaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tipologia_documental_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_TipologiaDocumental'), 'add_empty' => true)),
      'nombre'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo_dato'               => new sfWidgetFormFilterInput(),
      'parametros'              => new sfWidgetFormFilterInput(),
      'vacio'                   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'orden'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'tipologia_documental_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_TipologiaDocumental'), 'column' => 'id')),
      'nombre'                  => new sfValidatorPass(array('required' => false)),
      'tipo_dato'               => new sfValidatorPass(array('required' => false)),
      'parametros'              => new sfValidatorPass(array('required' => false)),
      'vacio'                   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'orden'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_update'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('archivo_etiqueta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_Etiqueta';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'tipologia_documental_id' => 'ForeignKey',
      'nombre'                  => 'Text',
      'tipo_dato'               => 'Text',
      'parametros'              => 'Text',
      'vacio'                   => 'Boolean',
      'orden'                   => 'Number',
      'id_update'               => 'Number',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
    );
  }
}
