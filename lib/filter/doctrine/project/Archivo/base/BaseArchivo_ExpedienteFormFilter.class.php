<?php

/**
 * Archivo_Expediente filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArchivo_ExpedienteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'padre_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Expediente'), 'add_empty' => true)),
      'correlativo'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'unidad_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => true)),
      'expediente_modelo_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_ExpedienteModelo'), 'add_empty' => true)),
      'unidad_correlativos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_UnidadCorrelativos'), 'add_empty' => true)),
      'estante_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Estante'), 'add_empty' => true)),
      'tramo'                  => new sfWidgetFormFilterInput(),
      'caja_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Caja'), 'add_empty' => true)),
      'serie_documental_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_SerieDocumental'), 'add_empty' => true)),
      'porcentaje_ocupado'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'padre_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_Expediente'), 'column' => 'id')),
      'correlativo'            => new sfValidatorPass(array('required' => false)),
      'unidad_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Unidad'), 'column' => 'id')),
      'expediente_modelo_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_ExpedienteModelo'), 'column' => 'id')),
      'unidad_correlativos_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_UnidadCorrelativos'), 'column' => 'id')),
      'estante_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_Estante'), 'column' => 'id')),
      'tramo'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'caja_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_Caja'), 'column' => 'id')),
      'serie_documental_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_SerieDocumental'), 'column' => 'id')),
      'porcentaje_ocupado'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'                 => new sfValidatorPass(array('required' => false)),
      'id_update'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'              => new sfValidatorPass(array('required' => false)),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('archivo_expediente_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_Expediente';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'padre_id'               => 'ForeignKey',
      'correlativo'            => 'Text',
      'unidad_id'              => 'ForeignKey',
      'expediente_modelo_id'   => 'ForeignKey',
      'unidad_correlativos_id' => 'ForeignKey',
      'estante_id'             => 'ForeignKey',
      'tramo'                  => 'Number',
      'caja_id'                => 'ForeignKey',
      'serie_documental_id'    => 'ForeignKey',
      'porcentaje_ocupado'     => 'Number',
      'status'                 => 'Text',
      'id_update'              => 'Number',
      'ip_update'              => 'Text',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
