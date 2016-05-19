<?php

/**
 * Acceso_AuditoriaClave filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAcceso_AuditoriaClaveFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'usuario_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_Usuario'), 'add_empty' => true)),
      'clave'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_cambio' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'usuario_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Acceso_Usuario'), 'column' => 'id')),
      'clave'        => new sfValidatorPass(array('required' => false)),
      'fecha_cambio' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('acceso_auditoria_clave_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Acceso_AuditoriaClave';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'usuario_id'   => 'ForeignKey',
      'clave'        => 'Text',
      'fecha_cambio' => 'Date',
    );
  }
}
