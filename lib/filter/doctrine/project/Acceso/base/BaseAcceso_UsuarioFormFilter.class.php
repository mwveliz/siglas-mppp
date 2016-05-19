<?php

/**
 * Acceso_Usuario filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAcceso_UsuarioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'usuario_enlace_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'enlace_id'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ldap'              => new sfWidgetFormFilterInput(),
      'clave'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'clave_temporal'    => new sfWidgetFormFilterInput(),
      'visitas'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ultimaconexion'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'ultimo_status'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ultimocambioclave' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'tema'              => new sfWidgetFormFilterInput(),
      'acceso_global'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'status'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'         => new sfWidgetFormFilterInput(),
      'ip'                => new sfWidgetFormFilterInput(),
      'pc'                => new sfWidgetFormFilterInput(),
      'puerta'            => new sfWidgetFormFilterInput(),
      'so'                => new sfWidgetFormFilterInput(),
      'agente'            => new sfWidgetFormFilterInput(),
      'variables_entorno' => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'usuario_enlace_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'enlace_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'            => new sfValidatorPass(array('required' => false)),
      'ldap'              => new sfValidatorPass(array('required' => false)),
      'clave'             => new sfValidatorPass(array('required' => false)),
      'clave_temporal'    => new sfValidatorPass(array('required' => false)),
      'visitas'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ultimaconexion'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ultimo_status'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ultimocambioclave' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'tema'              => new sfValidatorPass(array('required' => false)),
      'acceso_global'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'status'            => new sfValidatorPass(array('required' => false)),
      'id_update'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'         => new sfValidatorPass(array('required' => false)),
      'ip'                => new sfValidatorPass(array('required' => false)),
      'pc'                => new sfValidatorPass(array('required' => false)),
      'puerta'            => new sfValidatorPass(array('required' => false)),
      'so'                => new sfValidatorPass(array('required' => false)),
      'agente'            => new sfValidatorPass(array('required' => false)),
      'variables_entorno' => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('acceso_usuario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Acceso_Usuario';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'usuario_enlace_id' => 'Number',
      'enlace_id'         => 'Number',
      'nombre'            => 'Text',
      'ldap'              => 'Text',
      'clave'             => 'Text',
      'clave_temporal'    => 'Text',
      'visitas'           => 'Number',
      'ultimaconexion'    => 'Date',
      'ultimo_status'     => 'Date',
      'ultimocambioclave' => 'Date',
      'tema'              => 'Text',
      'acceso_global'     => 'Boolean',
      'status'            => 'Text',
      'id_update'         => 'Number',
      'ip_update'         => 'Text',
      'ip'                => 'Text',
      'pc'                => 'Text',
      'puerta'            => 'Text',
      'so'                => 'Text',
      'agente'            => 'Text',
      'variables_entorno' => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
