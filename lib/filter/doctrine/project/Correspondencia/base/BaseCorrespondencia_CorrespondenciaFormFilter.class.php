<?php

/**
 * Correspondencia_Correspondencia filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_CorrespondenciaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'padre_id'                      => new sfWidgetFormFilterInput(),
      'grupo_correspondencia'         => new sfWidgetFormFilterInput(),
      'n_correspondencia_emisor'      => new sfWidgetFormFilterInput(),
      'n_correspondencia_externa'     => new sfWidgetFormFilterInput(),
      'emisor_unidad_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => true)),
      'emisor_organismo_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'), 'add_empty' => true)),
      'f_envio'                       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'privado'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo_traslado_externo'         => new sfWidgetFormFilterInput(),
      'empresa_traslado'              => new sfWidgetFormFilterInput(),
      'n_guia_traslado'               => new sfWidgetFormFilterInput(),
      'status'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_create'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_delete'                     => new sfWidgetFormFilterInput(),
      'unidad_correlativo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_UnidadCorrelativo'), 'add_empty' => true)),
      'funcionario_correlativo_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_FuncionarioCorrelativo'), 'add_empty' => true)),
      'email_externo'                 => new sfWidgetFormFilterInput(),
      'emisor_persona_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Persona'), 'add_empty' => true)),
      'emisor_persona_cargo_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_PersonaCargo'), 'add_empty' => true)),
      'telf_movil_externo'            => new sfWidgetFormFilterInput(),
      'telf_local_externo'            => new sfWidgetFormFilterInput(),
      'prioridad'                     => new sfWidgetFormFilterInput(),
      'editado'                       => new sfWidgetFormFilterInput(),
      'interoperabilidad_enviada_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_InteroperabilidadEnviada'), 'add_empty' => true)),
      'interoperabilidad_recibida_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_InteroperabilidadRecibida'), 'add_empty' => true)),
      'created_at'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'padre_id'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'grupo_correspondencia'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'n_correspondencia_emisor'      => new sfValidatorPass(array('required' => false)),
      'n_correspondencia_externa'     => new sfValidatorPass(array('required' => false)),
      'emisor_unidad_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Unidad'), 'column' => 'id')),
      'emisor_organismo_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organismos_Organismo'), 'column' => 'id')),
      'f_envio'                       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'privado'                       => new sfValidatorPass(array('required' => false)),
      'tipo_traslado_externo'         => new sfValidatorPass(array('required' => false)),
      'empresa_traslado'              => new sfValidatorPass(array('required' => false)),
      'n_guia_traslado'               => new sfValidatorPass(array('required' => false)),
      'status'                        => new sfValidatorPass(array('required' => false)),
      'id_create'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_update'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_delete'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'unidad_correlativo_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Correspondencia_UnidadCorrelativo'), 'column' => 'id')),
      'funcionario_correlativo_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Correspondencia_FuncionarioCorrelativo'), 'column' => 'id')),
      'email_externo'                 => new sfValidatorPass(array('required' => false)),
      'emisor_persona_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organismos_Persona'), 'column' => 'id')),
      'emisor_persona_cargo_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organismos_PersonaCargo'), 'column' => 'id')),
      'telf_movil_externo'            => new sfValidatorPass(array('required' => false)),
      'telf_local_externo'            => new sfValidatorPass(array('required' => false)),
      'prioridad'                     => new sfValidatorPass(array('required' => false)),
      'editado'                       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'interoperabilidad_enviada_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Siglas_InteroperabilidadEnviada'), 'column' => 'id')),
      'interoperabilidad_recibida_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Siglas_InteroperabilidadRecibida'), 'column' => 'id')),
      'created_at'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_correspondencia_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_Correspondencia';
  }

  public function getFields()
  {
    return array(
      'id'                            => 'Number',
      'padre_id'                      => 'Number',
      'grupo_correspondencia'         => 'Number',
      'n_correspondencia_emisor'      => 'Text',
      'n_correspondencia_externa'     => 'Text',
      'emisor_unidad_id'              => 'ForeignKey',
      'emisor_organismo_id'           => 'ForeignKey',
      'f_envio'                       => 'Date',
      'privado'                       => 'Text',
      'tipo_traslado_externo'         => 'Text',
      'empresa_traslado'              => 'Text',
      'n_guia_traslado'               => 'Text',
      'status'                        => 'Text',
      'id_create'                     => 'Number',
      'id_update'                     => 'Number',
      'id_delete'                     => 'Number',
      'unidad_correlativo_id'         => 'ForeignKey',
      'funcionario_correlativo_id'    => 'ForeignKey',
      'email_externo'                 => 'Text',
      'emisor_persona_id'             => 'ForeignKey',
      'emisor_persona_cargo_id'       => 'ForeignKey',
      'telf_movil_externo'            => 'Text',
      'telf_local_externo'            => 'Text',
      'prioridad'                     => 'Text',
      'editado'                       => 'Number',
      'interoperabilidad_enviada_id'  => 'ForeignKey',
      'interoperabilidad_recibida_id' => 'ForeignKey',
      'created_at'                    => 'Date',
      'updated_at'                    => 'Date',
    );
  }
}
