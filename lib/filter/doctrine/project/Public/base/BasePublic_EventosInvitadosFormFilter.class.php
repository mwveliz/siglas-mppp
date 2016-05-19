<?php

/**
 * Public_EventosInvitados filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePublic_EventosInvitadosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'funcionario_invitado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'unidad_invitado_id'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cargo_invitado_id'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'evento_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Eventos'), 'add_empty' => true)),
      'aprobado'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_create'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_create'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'funcionario_invitado_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'unidad_invitado_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cargo_invitado_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'evento_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Public_Eventos'), 'column' => 'id')),
      'aprobado'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_create'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_update'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'               => new sfValidatorPass(array('required' => false)),
      'ip_create'               => new sfValidatorPass(array('required' => false)),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('public_eventos_invitados_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_EventosInvitados';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'funcionario_invitado_id' => 'ForeignKey',
      'unidad_invitado_id'      => 'Number',
      'cargo_invitado_id'       => 'Number',
      'evento_id'               => 'ForeignKey',
      'aprobado'                => 'Number',
      'id_create'               => 'Number',
      'id_update'               => 'Number',
      'ip_update'               => 'Text',
      'ip_create'               => 'Text',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
    );
  }
}
