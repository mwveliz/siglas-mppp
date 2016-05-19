<?php

/**
 * Organigrama_Cargo filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrganigrama_CargoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'unidad_funcional_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_UnidadFuncional'), 'add_empty' => true)),
      'unidad_administrativa_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_UnidadAdministrativa'), 'add_empty' => true)),
      'padre_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Cargo'), 'add_empty' => true)),
      'codigo_nomina'            => new sfWidgetFormFilterInput(),
      'cargo_tipo_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoTipo'), 'add_empty' => true)),
      'cargo_condicion_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoCondicion'), 'add_empty' => true)),
      'cargo_grado_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoGrado'), 'add_empty' => true)),
      'descripcion'              => new sfWidgetFormFilterInput(),
      'f_ingreso'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'f_retiro'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'motivo_retiro'            => new sfWidgetFormFilterInput(),
      'perfil_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_Perfil'), 'add_empty' => true)),
      'status'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'unidad_funcional_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_UnidadFuncional'), 'column' => 'id')),
      'unidad_administrativa_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_UnidadAdministrativa'), 'column' => 'id')),
      'padre_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Cargo'), 'column' => 'id')),
      'codigo_nomina'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cargo_tipo_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_CargoTipo'), 'column' => 'id')),
      'cargo_condicion_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_CargoCondicion'), 'column' => 'id')),
      'cargo_grado_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_CargoGrado'), 'column' => 'id')),
      'descripcion'              => new sfValidatorPass(array('required' => false)),
      'f_ingreso'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'f_retiro'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'motivo_retiro'            => new sfValidatorPass(array('required' => false)),
      'perfil_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Acceso_Perfil'), 'column' => 'id')),
      'status'                   => new sfValidatorPass(array('required' => false)),
      'id_update'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('organigrama_cargo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organigrama_Cargo';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'unidad_funcional_id'      => 'ForeignKey',
      'unidad_administrativa_id' => 'ForeignKey',
      'padre_id'                 => 'ForeignKey',
      'codigo_nomina'            => 'Number',
      'cargo_tipo_id'            => 'ForeignKey',
      'cargo_condicion_id'       => 'ForeignKey',
      'cargo_grado_id'           => 'ForeignKey',
      'descripcion'              => 'Text',
      'f_ingreso'                => 'Date',
      'f_retiro'                 => 'Date',
      'motivo_retiro'            => 'Text',
      'perfil_id'                => 'ForeignKey',
      'status'                   => 'Text',
      'id_update'                => 'Number',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
    );
  }
}
