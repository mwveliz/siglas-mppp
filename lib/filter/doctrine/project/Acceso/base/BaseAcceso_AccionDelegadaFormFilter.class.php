<?php

/**
 * Acceso_AccionDelegada filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAcceso_AccionDelegadaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'usuario_delega_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_UsuarioDelega'), 'add_empty' => true)),
      'usuario_delegado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_UsuarioDelegado'), 'add_empty' => true)),
      'f_expiracion'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'accion'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parametros'          => new sfWidgetFormFilterInput(),
      'status'              => new sfWidgetFormFilterInput(),
      'id_update'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'usuario_delega_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Acceso_UsuarioDelega'), 'column' => 'id')),
      'usuario_delegado_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Acceso_UsuarioDelegado'), 'column' => 'id')),
      'f_expiracion'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'accion'              => new sfValidatorPass(array('required' => false)),
      'parametros'          => new sfValidatorPass(array('required' => false)),
      'status'              => new sfValidatorPass(array('required' => false)),
      'id_update'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'           => new sfValidatorPass(array('required' => false)),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('acceso_accion_delegada_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Acceso_AccionDelegada';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'usuario_delega_id'   => 'ForeignKey',
      'usuario_delegado_id' => 'ForeignKey',
      'f_expiracion'        => 'Date',
      'accion'              => 'Text',
      'parametros'          => 'Text',
      'status'              => 'Text',
      'id_update'           => 'Number',
      'ip_update'           => 'Text',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
