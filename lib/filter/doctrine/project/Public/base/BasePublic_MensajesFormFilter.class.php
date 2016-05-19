<?php

/**
 * Public_Mensajes filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePublic_MensajesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'conversacion'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'funcionario_envia_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioEnvia'), 'add_empty' => true)),
      'funcionario_recibe_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioRecibe'), 'add_empty' => true)),
      'contenido'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre_externo'        => new sfWidgetFormFilterInput(),
      'n_informe_progreso'    => new sfWidgetFormFilterInput(),
      'tipo'                  => new sfWidgetFormFilterInput(),
      'status'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'             => new sfWidgetFormFilterInput(),
      'id_eliminado'          => new sfWidgetFormFilterInput(),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'conversacion'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'funcionario_envia_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_FuncionarioEnvia'), 'column' => 'id')),
      'funcionario_recibe_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_FuncionarioRecibe'), 'column' => 'id')),
      'contenido'             => new sfValidatorPass(array('required' => false)),
      'nombre_externo'        => new sfValidatorPass(array('required' => false)),
      'n_informe_progreso'    => new sfValidatorPass(array('required' => false)),
      'tipo'                  => new sfValidatorPass(array('required' => false)),
      'status'                => new sfValidatorPass(array('required' => false)),
      'id_update'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'             => new sfValidatorPass(array('required' => false)),
      'id_eliminado'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('public_mensajes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_Mensajes';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'conversacion'          => 'Number',
      'funcionario_envia_id'  => 'ForeignKey',
      'funcionario_recibe_id' => 'ForeignKey',
      'contenido'             => 'Text',
      'nombre_externo'        => 'Text',
      'n_informe_progreso'    => 'Text',
      'tipo'                  => 'Text',
      'status'                => 'Text',
      'id_update'             => 'Number',
      'ip_update'             => 'Text',
      'id_eliminado'          => 'Number',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
