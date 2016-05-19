<?php

/**
 * Correspondencia_GrupoReceptor filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_GrupoReceptorFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'unidad_duena_id'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cargo_receptor_id'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'unidad_receptor_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'grupo_id'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'nombre'             => new sfValidatorPass(array('required' => false)),
      'unidad_duena_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cargo_receptor_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'unidad_receptor_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'grupo_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tipo'               => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_grupo_receptor_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_GrupoReceptor';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'nombre'             => 'Text',
      'unidad_duena_id'    => 'Number',
      'cargo_receptor_id'  => 'Number',
      'unidad_receptor_id' => 'Number',
      'grupo_id'           => 'Number',
      'tipo'               => 'Text',
    );
  }
}
