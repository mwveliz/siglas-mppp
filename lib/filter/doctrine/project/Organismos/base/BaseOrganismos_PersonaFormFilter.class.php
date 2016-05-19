<?php

/**
 * Organismos_Persona filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrganismos_PersonaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'organismo_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'), 'add_empty' => true)),
      'ci'               => new sfWidgetFormFilterInput(),
      'nombre_simple'    => new sfWidgetFormFilterInput(),
      'primer_nombre'    => new sfWidgetFormFilterInput(),
      'segundo_nombre'   => new sfWidgetFormFilterInput(),
      'primer_apellido'  => new sfWidgetFormFilterInput(),
      'segundo_apellido' => new sfWidgetFormFilterInput(),
      'email_principal'  => new sfWidgetFormFilterInput(),
      'email_secundario' => new sfWidgetFormFilterInput(),
      'sexo'             => new sfWidgetFormFilterInput(),
      'privado'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'status'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'organismo_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organismos_Organismo'), 'column' => 'id')),
      'ci'               => new sfValidatorPass(array('required' => false)),
      'nombre_simple'    => new sfValidatorPass(array('required' => false)),
      'primer_nombre'    => new sfValidatorPass(array('required' => false)),
      'segundo_nombre'   => new sfValidatorPass(array('required' => false)),
      'primer_apellido'  => new sfValidatorPass(array('required' => false)),
      'segundo_apellido' => new sfValidatorPass(array('required' => false)),
      'email_principal'  => new sfValidatorPass(array('required' => false)),
      'email_secundario' => new sfValidatorPass(array('required' => false)),
      'sexo'             => new sfValidatorPass(array('required' => false)),
      'privado'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'status'           => new sfValidatorPass(array('required' => false)),
      'id_update'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('organismos_persona_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organismos_Persona';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'organismo_id'     => 'ForeignKey',
      'ci'               => 'Text',
      'nombre_simple'    => 'Text',
      'primer_nombre'    => 'Text',
      'segundo_nombre'   => 'Text',
      'primer_apellido'  => 'Text',
      'segundo_apellido' => 'Text',
      'email_principal'  => 'Text',
      'email_secundario' => 'Text',
      'sexo'             => 'Text',
      'privado'          => 'Boolean',
      'status'           => 'Text',
      'id_update'        => 'Number',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
