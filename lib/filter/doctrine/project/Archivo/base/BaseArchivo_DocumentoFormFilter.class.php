<?php

/**
 * Archivo_Documento filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArchivo_DocumentoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'unidad_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => true)),
      'expediente_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Expediente'), 'add_empty' => true)),
      'correspondencia_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'), 'add_empty' => true)),
      'correlativo'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'unidad_correlativos_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_UnidadCorrelativos'), 'add_empty' => true)),
      'tipologia_documental_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_TipologiaDocumental'), 'add_empty' => true)),
      'copia_fisica'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'copia_digital'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'contenido_automatico'    => new sfWidgetFormFilterInput(),
      'ruta'                    => new sfWidgetFormFilterInput(),
      'nombre_original'         => new sfWidgetFormFilterInput(),
      'tipo_archivo'            => new sfWidgetFormFilterInput(),
      'usuario_validador_id'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'unidad_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Unidad'), 'column' => 'id')),
      'expediente_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_Expediente'), 'column' => 'id')),
      'correspondencia_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Correspondencia_Correspondencia'), 'column' => 'id')),
      'correlativo'             => new sfValidatorPass(array('required' => false)),
      'unidad_correlativos_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_UnidadCorrelativos'), 'column' => 'id')),
      'tipologia_documental_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_TipologiaDocumental'), 'column' => 'id')),
      'copia_fisica'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'copia_digital'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'contenido_automatico'    => new sfValidatorPass(array('required' => false)),
      'ruta'                    => new sfValidatorPass(array('required' => false)),
      'nombre_original'         => new sfValidatorPass(array('required' => false)),
      'tipo_archivo'            => new sfValidatorPass(array('required' => false)),
      'usuario_validador_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'                  => new sfValidatorPass(array('required' => false)),
      'id_update'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'               => new sfValidatorPass(array('required' => false)),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('archivo_documento_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_Documento';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'unidad_id'               => 'ForeignKey',
      'expediente_id'           => 'ForeignKey',
      'correspondencia_id'      => 'ForeignKey',
      'correlativo'             => 'Text',
      'unidad_correlativos_id'  => 'ForeignKey',
      'tipologia_documental_id' => 'ForeignKey',
      'copia_fisica'            => 'Boolean',
      'copia_digital'           => 'Boolean',
      'contenido_automatico'    => 'Text',
      'ruta'                    => 'Text',
      'nombre_original'         => 'Text',
      'tipo_archivo'            => 'Text',
      'usuario_validador_id'    => 'Number',
      'status'                  => 'Text',
      'id_update'               => 'Number',
      'ip_update'               => 'Text',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
    );
  }
}
