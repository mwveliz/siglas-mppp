<?php

/**
 * Seguridad_Persona filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSeguridad_PersonaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nacionalidad'       => new sfWidgetFormFilterInput(),
      'ci'                 => new sfWidgetFormFilterInput(),
      'primer_nombre'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'segundo_nombre'     => new sfWidgetFormFilterInput(),
      'primer_apellido'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'segundo_apellido'   => new sfWidgetFormFilterInput(),
      'sexo'               => new sfWidgetFormFilterInput(),
      'f_nacimiento'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'correo_electronico' => new sfWidgetFormFilterInput(),
      'telefono'           => new sfWidgetFormFilterInput(),
      'id_update'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'nacionalidad'       => new sfValidatorPass(array('required' => false)),
      'ci'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'primer_nombre'      => new sfValidatorPass(array('required' => false)),
      'segundo_nombre'     => new sfValidatorPass(array('required' => false)),
      'primer_apellido'    => new sfValidatorPass(array('required' => false)),
      'segundo_apellido'   => new sfValidatorPass(array('required' => false)),
      'sexo'               => new sfValidatorPass(array('required' => false)),
      'f_nacimiento'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'correo_electronico' => new sfValidatorPass(array('required' => false)),
      'telefono'           => new sfValidatorPass(array('required' => false)),
      'id_update'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'          => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('seguridad_persona_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seguridad_Persona';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'nacionalidad'       => 'Text',
      'ci'                 => 'Number',
      'primer_nombre'      => 'Text',
      'segundo_nombre'     => 'Text',
      'primer_apellido'    => 'Text',
      'segundo_apellido'   => 'Text',
      'sexo'               => 'Text',
      'f_nacimiento'       => 'Date',
      'correo_electronico' => 'Text',
      'telefono'           => 'Text',
      'id_update'          => 'Number',
      'ip_update'          => 'Text',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
