<?php

/**
 * Organigrama_CargoGrado filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrganigrama_CargoGradoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'siglas'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'orden'                       => new sfWidgetFormFilterInput(),
      'status'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'organigrama_cargo_tipo_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Organigrama_CargoTipo')),
    ));

    $this->setValidators(array(
      'nombre'                      => new sfValidatorPass(array('required' => false)),
      'siglas'                      => new sfValidatorPass(array('required' => false)),
      'orden'                       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'                      => new sfValidatorPass(array('required' => false)),
      'id_update'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'organigrama_cargo_tipo_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Organigrama_CargoTipo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('organigrama_cargo_grado_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addOrganigramaCargoTipoListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.Organigrama_CargoGradoTipo Organigrama_CargoGradoTipo')
      ->andWhereIn('Organigrama_CargoGradoTipo.cargo_tipo_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Organigrama_CargoGrado';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'nombre'                      => 'Text',
      'siglas'                      => 'Text',
      'orden'                       => 'Number',
      'status'                      => 'Text',
      'id_update'                   => 'Number',
      'created_at'                  => 'Date',
      'updated_at'                  => 'Date',
      'organigrama_cargo_tipo_list' => 'ManyKey',
    );
  }
}
