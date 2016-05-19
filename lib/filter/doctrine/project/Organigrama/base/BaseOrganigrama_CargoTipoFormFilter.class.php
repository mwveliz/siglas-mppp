<?php

/**
 * Organigrama_CargoTipo filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrganigrama_CargoTipoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'principal'                    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'status'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cargo_condicion_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoCondicion'), 'add_empty' => true)),
      'masculino'                    => new sfWidgetFormFilterInput(),
      'femenino'                     => new sfWidgetFormFilterInput(),
      'orden'                        => new sfWidgetFormFilterInput(),
      'created_at'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'organigrama_cargo_grado_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Organigrama_CargoGrado')),
    ));

    $this->setValidators(array(
      'nombre'                       => new sfValidatorPass(array('required' => false)),
      'descripcion'                  => new sfValidatorPass(array('required' => false)),
      'principal'                    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'status'                       => new sfValidatorPass(array('required' => false)),
      'id_update'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cargo_condicion_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_CargoCondicion'), 'column' => 'id')),
      'masculino'                    => new sfValidatorPass(array('required' => false)),
      'femenino'                     => new sfValidatorPass(array('required' => false)),
      'orden'                        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'organigrama_cargo_grado_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Organigrama_CargoGrado', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('organigrama_cargo_tipo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addOrganigramaCargoGradoListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('Organigrama_CargoGradoTipo.cargo_grado_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Organigrama_CargoTipo';
  }

  public function getFields()
  {
    return array(
      'id'                           => 'Number',
      'nombre'                       => 'Text',
      'descripcion'                  => 'Text',
      'principal'                    => 'Boolean',
      'status'                       => 'Text',
      'id_update'                    => 'Number',
      'cargo_condicion_id'           => 'ForeignKey',
      'masculino'                    => 'Text',
      'femenino'                     => 'Text',
      'orden'                        => 'Number',
      'created_at'                   => 'Date',
      'updated_at'                   => 'Date',
      'organigrama_cargo_grado_list' => 'ManyKey',
    );
  }
}
