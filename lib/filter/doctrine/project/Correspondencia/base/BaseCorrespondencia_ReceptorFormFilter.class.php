<?php

/**
 * Correspondencia_Receptor filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_ReceptorFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'correspondencia_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'), 'add_empty' => true)),
      'unidad_id'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => true)),
      'cargo_id'                      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Cargo'), 'add_empty' => true)),
      'funcionario_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'f_recepcion'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'copia'                         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'establecido'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'respuesta_correspondencia_ids' => new sfWidgetFormFilterInput(),
      'privado'                       => new sfWidgetFormFilterInput(),
      'id_update'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'correspondencia_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Correspondencia_Correspondencia'), 'column' => 'id')),
      'unidad_id'                     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Unidad'), 'column' => 'id')),
      'cargo_id'                      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Cargo'), 'column' => 'id')),
      'funcionario_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'f_recepcion'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'copia'                         => new sfValidatorPass(array('required' => false)),
      'establecido'                   => new sfValidatorPass(array('required' => false)),
      'respuesta_correspondencia_ids' => new sfValidatorPass(array('required' => false)),
      'privado'                       => new sfValidatorPass(array('required' => false)),
      'id_update'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_receptor_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_Receptor';
  }

  public function getFields()
  {
    return array(
      'id'                            => 'Number',
      'correspondencia_id'            => 'ForeignKey',
      'unidad_id'                     => 'ForeignKey',
      'cargo_id'                      => 'ForeignKey',
      'funcionario_id'                => 'ForeignKey',
      'f_recepcion'                   => 'Date',
      'copia'                         => 'Text',
      'establecido'                   => 'Text',
      'respuesta_correspondencia_ids' => 'Text',
      'privado'                       => 'Text',
      'id_update'                     => 'Number',
      'created_at'                    => 'Date',
      'updated_at'                    => 'Date',
    );
  }
}
