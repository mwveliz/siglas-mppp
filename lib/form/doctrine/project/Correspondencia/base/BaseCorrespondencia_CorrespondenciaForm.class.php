<?php

/**
 * Correspondencia_Correspondencia form base class.
 *
 * @method Correspondencia_Correspondencia getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_CorrespondenciaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                            => new sfWidgetFormInputHidden(),
      'padre_id'                      => new sfWidgetFormInputText(),
      'grupo_correspondencia'         => new sfWidgetFormInputText(),
      'n_correspondencia_emisor'      => new sfWidgetFormInputText(),
      'n_correspondencia_externa'     => new sfWidgetFormInputText(),
      'emisor_unidad_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => true)),
      'emisor_organismo_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'), 'add_empty' => true)),
      'f_envio'                       => new sfWidgetFormDateTime(),
      'privado'                       => new sfWidgetFormInputText(),
      'tipo_traslado_externo'         => new sfWidgetFormInputText(),
      'empresa_traslado'              => new sfWidgetFormInputText(),
      'n_guia_traslado'               => new sfWidgetFormInputText(),
      'status'                        => new sfWidgetFormInputText(),
      'id_create'                     => new sfWidgetFormInputText(),
      'id_update'                     => new sfWidgetFormInputText(),
      'id_delete'                     => new sfWidgetFormInputText(),
      'unidad_correlativo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_UnidadCorrelativo'), 'add_empty' => true)),
      'funcionario_correlativo_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_FuncionarioCorrelativo'), 'add_empty' => true)),
      'email_externo'                 => new sfWidgetFormInputText(),
      'emisor_persona_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Persona'), 'add_empty' => true)),
      'emisor_persona_cargo_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_PersonaCargo'), 'add_empty' => true)),
      'telf_movil_externo'            => new sfWidgetFormInputText(),
      'telf_local_externo'            => new sfWidgetFormInputText(),
      'prioridad'                     => new sfWidgetFormInputText(),
      'editado'                       => new sfWidgetFormInputText(),
      'interoperabilidad_enviada_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_InteroperabilidadEnviada'), 'add_empty' => true)),
      'interoperabilidad_recibida_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_InteroperabilidadRecibida'), 'add_empty' => true)),
      'created_at'                    => new sfWidgetFormDateTime(),
      'updated_at'                    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'padre_id'                      => new sfValidatorInteger(array('required' => false)),
      'grupo_correspondencia'         => new sfValidatorInteger(array('required' => false)),
      'n_correspondencia_emisor'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'n_correspondencia_externa'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'emisor_unidad_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'required' => false)),
      'emisor_organismo_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Organismo'), 'required' => false)),
      'f_envio'                       => new sfValidatorDateTime(array('required' => false)),
      'privado'                       => new sfValidatorString(array('max_length' => 1)),
      'tipo_traslado_externo'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'empresa_traslado'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'n_guia_traslado'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'status'                        => new sfValidatorString(array('max_length' => 1)),
      'id_create'                     => new sfValidatorInteger(),
      'id_update'                     => new sfValidatorInteger(),
      'id_delete'                     => new sfValidatorInteger(array('required' => false)),
      'unidad_correlativo_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_UnidadCorrelativo'), 'required' => false)),
      'funcionario_correlativo_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_FuncionarioCorrelativo'), 'required' => false)),
      'email_externo'                 => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'emisor_persona_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_Persona'), 'required' => false)),
      'emisor_persona_cargo_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organismos_PersonaCargo'), 'required' => false)),
      'telf_movil_externo'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'telf_local_externo'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'prioridad'                     => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'editado'                       => new sfValidatorInteger(array('required' => false)),
      'interoperabilidad_enviada_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_InteroperabilidadEnviada'), 'required' => false)),
      'interoperabilidad_recibida_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Siglas_InteroperabilidadRecibida'), 'required' => false)),
      'created_at'                    => new sfValidatorDateTime(),
      'updated_at'                    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_correspondencia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_Correspondencia';
  }

}
