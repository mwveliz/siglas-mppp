<?php

/**
 * Correspondencia_Formato filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_FormatoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'correspondencia_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'), 'add_empty' => true)),
      'tipo_formato_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_TipoFormato'), 'add_empty' => true)),
      'contenido'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'campo_uno'          => new sfWidgetFormFilterInput(),
      'campo_dos'          => new sfWidgetFormFilterInput(),
      'campo_tres'         => new sfWidgetFormFilterInput(),
      'campo_cuatro'       => new sfWidgetFormFilterInput(),
      'campo_cinco'        => new sfWidgetFormFilterInput(),
      'campo_seis'         => new sfWidgetFormFilterInput(),
      'campo_siete'        => new sfWidgetFormFilterInput(),
      'campo_ocho'         => new sfWidgetFormFilterInput(),
      'campo_nueve'        => new sfWidgetFormFilterInput(),
      'campo_diez'         => new sfWidgetFormFilterInput(),
      'campo_once'         => new sfWidgetFormFilterInput(),
      'campo_doce'         => new sfWidgetFormFilterInput(),
      'campo_trece'        => new sfWidgetFormFilterInput(),
      'campo_catorce'      => new sfWidgetFormFilterInput(),
      'campo_quince'       => new sfWidgetFormFilterInput(),
      'id_update'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'publico'            => new sfWidgetFormFilterInput(),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'correspondencia_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Correspondencia_Correspondencia'), 'column' => 'id')),
      'tipo_formato_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Correspondencia_TipoFormato'), 'column' => 'id')),
      'contenido'          => new sfValidatorPass(array('required' => false)),
      'campo_uno'          => new sfValidatorPass(array('required' => false)),
      'campo_dos'          => new sfValidatorPass(array('required' => false)),
      'campo_tres'         => new sfValidatorPass(array('required' => false)),
      'campo_cuatro'       => new sfValidatorPass(array('required' => false)),
      'campo_cinco'        => new sfValidatorPass(array('required' => false)),
      'campo_seis'         => new sfValidatorPass(array('required' => false)),
      'campo_siete'        => new sfValidatorPass(array('required' => false)),
      'campo_ocho'         => new sfValidatorPass(array('required' => false)),
      'campo_nueve'        => new sfValidatorPass(array('required' => false)),
      'campo_diez'         => new sfValidatorPass(array('required' => false)),
      'campo_once'         => new sfValidatorPass(array('required' => false)),
      'campo_doce'         => new sfValidatorPass(array('required' => false)),
      'campo_trece'        => new sfValidatorPass(array('required' => false)),
      'campo_catorce'      => new sfValidatorPass(array('required' => false)),
      'campo_quince'       => new sfValidatorPass(array('required' => false)),
      'id_update'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'publico'            => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_formato_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_Formato';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'correspondencia_id' => 'ForeignKey',
      'tipo_formato_id'    => 'ForeignKey',
      'contenido'          => 'Text',
      'campo_uno'          => 'Text',
      'campo_dos'          => 'Text',
      'campo_tres'         => 'Text',
      'campo_cuatro'       => 'Text',
      'campo_cinco'        => 'Text',
      'campo_seis'         => 'Text',
      'campo_siete'        => 'Text',
      'campo_ocho'         => 'Text',
      'campo_nueve'        => 'Text',
      'campo_diez'         => 'Text',
      'campo_once'         => 'Text',
      'campo_doce'         => 'Text',
      'campo_trece'        => 'Text',
      'campo_catorce'      => 'Text',
      'campo_quince'       => 'Text',
      'id_update'          => 'Number',
      'publico'            => 'Text',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
