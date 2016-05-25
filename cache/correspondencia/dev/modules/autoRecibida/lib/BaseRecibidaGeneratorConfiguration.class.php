<?php

/**
 * recibida module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage recibida
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRecibidaGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
    return array();
  }

  public function getListObjectActions()
  {
    return array();
  }

  public function getListActions()
  {
    return array(  'excel' =>   array(    'label' => 'Exportar',    'action' => 'excel',  ),);
  }

  public function getListBatchActions()
  {
    return array();
  }

  public function getListParams()
  {
    return '%%_identificacion%% - %%_documento%% - %%_detalles%% - %%_acciones%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Correspondencia y Solicitudes recibidas';
  }

  public function getEditTitle()
  {
    return 'Edit Recibida';
  }

  public function getNewTitle()
  {
    return 'New Recibida';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'n_correspondencia_emisor',  1 => 'f_envio',  2 => 'statusRecepcion',  3 => '_separador_emisor_externo',  4 => 'emisor_organismo_id',  5 => 'emisor_persona_id',  6 => 'emisor_persona_cargo_id',  7 => 'tipo_traslado_externo',  8 => 'empresa_traslado',  9 => 'n_guia_traslado',  10 => '_separador_emisor_interno',  11 => '_unidad_funcionario_emisor_filter',  12 => '_separador_receptor',  13 => '_unidad_funcionario_receptor_filter',  14 => '_separador_formatos',  15 => 'formato',  16 => 'formatoPalabra',  17 => '_separador_adjuntos',  18 => 'adjunto',  19 => '_separador_fisicos',  20 => 'fisico',  21 => 'fisicoPalabra',);
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => '_identificacion',  1 => '_documento',  2 => '_detalles',  3 => '_acciones',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'padre_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'grupo_correspondencia' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'n_correspondencia_emisor' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'N° Envio',),
      'n_correspondencia_externa' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'emisor_unidad_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'emisor_organismo_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',  'label' => 'Organización',),
      'f_envio' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',  'label' => 'Fecha de Envio',),
      'privado' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'tipo_traslado_externo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Forma de envio',),
      'empresa_traslado' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Empresa contratada',),
      'n_guia_traslado' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Nº de Guia',),
      'status' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Estatus',),
      'id_create' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'id_update' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'id_delete' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'unidad_correlativo_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'funcionario_correlativo_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'email_externo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'emisor_persona_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',  'label' => 'Nombre Emisor',),
      'emisor_persona_cargo_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',  'label' => 'Cargo Emisor',),
      'telf_movil_externo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'telf_local_externo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'prioridad' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'editado' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'interoperabilidad_enviada_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'interoperabilidad_recibida_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'nCorrespondenciaReceptor' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'N° Recepción',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'padre_id' => array(),
      'grupo_correspondencia' => array(),
      'n_correspondencia_emisor' => array(),
      'n_correspondencia_externa' => array(),
      'emisor_unidad_id' => array(),
      'emisor_organismo_id' => array(),
      'f_envio' => array(),
      'privado' => array(),
      'tipo_traslado_externo' => array(),
      'empresa_traslado' => array(),
      'n_guia_traslado' => array(),
      'status' => array(),
      'id_create' => array(),
      'id_update' => array(),
      'id_delete' => array(),
      'unidad_correlativo_id' => array(),
      'funcionario_correlativo_id' => array(),
      'email_externo' => array(),
      'emisor_persona_id' => array(),
      'emisor_persona_cargo_id' => array(),
      'telf_movil_externo' => array(),
      'telf_local_externo' => array(),
      'prioridad' => array(),
      'editado' => array(),
      'interoperabilidad_enviada_id' => array(),
      'interoperabilidad_recibida_id' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'tadjuntos' => array(  'label' => '.',),
      'tfisicos' => array(  'label' => '.',),
      'ultima_vista' => array(  'label' => ' ',),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'padre_id' => array(),
      'grupo_correspondencia' => array(),
      'n_correspondencia_emisor' => array(  'label' => 'N° Envio',  'help' => 'Número de correlativo',),
      'n_correspondencia_externa' => array(),
      'emisor_unidad_id' => array(),
      'emisor_organismo_id' => array(),
      'f_envio' => array(),
      'privado' => array(),
      'tipo_traslado_externo' => array(),
      'empresa_traslado' => array(),
      'n_guia_traslado' => array(),
      'status' => array(),
      'id_create' => array(),
      'id_update' => array(),
      'id_delete' => array(),
      'unidad_correlativo_id' => array(),
      'funcionario_correlativo_id' => array(),
      'email_externo' => array(),
      'emisor_persona_id' => array(  'label' => 'Emitido por',  'help' => 'Nombre de la persona externa que envio',),
      'emisor_persona_cargo_id' => array(  'label' => 'Cargo',  'help' => 'Cargo de la persona externa que envio la correspondencia',),
      'telf_movil_externo' => array(),
      'telf_local_externo' => array(),
      'prioridad' => array(),
      'editado' => array(),
      'interoperabilidad_enviada_id' => array(),
      'interoperabilidad_recibida_id' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'formato' => array(  'label' => 'Tipo',),
      'formatoPalabra' => array(  'label' => 'Palabra o Frase',),
      'adjunto' => array(  'label' => 'Nombre',),
      'fisico' => array(  'label' => 'Tipo',),
      'fisicoPalabra' => array(  'label' => 'Caracteristicas',),
      'statusRecepcion' => array(  'label' => 'Estatus',),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'padre_id' => array(),
      'grupo_correspondencia' => array(),
      'n_correspondencia_emisor' => array(),
      'n_correspondencia_externa' => array(),
      'emisor_unidad_id' => array(),
      'emisor_organismo_id' => array(),
      'f_envio' => array(),
      'privado' => array(),
      'tipo_traslado_externo' => array(),
      'empresa_traslado' => array(),
      'n_guia_traslado' => array(),
      'status' => array(),
      'id_create' => array(),
      'id_update' => array(),
      'id_delete' => array(),
      'unidad_correlativo_id' => array(),
      'funcionario_correlativo_id' => array(),
      'email_externo' => array(),
      'emisor_persona_id' => array(),
      'emisor_persona_cargo_id' => array(),
      'telf_movil_externo' => array(),
      'telf_local_externo' => array(),
      'prioridad' => array(),
      'editado' => array(),
      'interoperabilidad_enviada_id' => array(),
      'interoperabilidad_recibida_id' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'padre_id' => array(),
      'grupo_correspondencia' => array(),
      'n_correspondencia_emisor' => array(),
      'n_correspondencia_externa' => array(),
      'emisor_unidad_id' => array(),
      'emisor_organismo_id' => array(),
      'f_envio' => array(),
      'privado' => array(),
      'tipo_traslado_externo' => array(),
      'empresa_traslado' => array(),
      'n_guia_traslado' => array(),
      'status' => array(),
      'id_create' => array(),
      'id_update' => array(),
      'id_delete' => array(),
      'unidad_correlativo_id' => array(),
      'funcionario_correlativo_id' => array(),
      'email_externo' => array(),
      'emisor_persona_id' => array(),
      'emisor_persona_cargo_id' => array(),
      'telf_movil_externo' => array(),
      'telf_local_externo' => array(),
      'prioridad' => array(),
      'editado' => array(),
      'interoperabilidad_enviada_id' => array(),
      'interoperabilidad_recibida_id' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'padre_id' => array(),
      'grupo_correspondencia' => array(),
      'n_correspondencia_emisor' => array(),
      'n_correspondencia_externa' => array(),
      'emisor_unidad_id' => array(),
      'emisor_organismo_id' => array(),
      'f_envio' => array(),
      'privado' => array(),
      'tipo_traslado_externo' => array(),
      'empresa_traslado' => array(),
      'n_guia_traslado' => array(),
      'status' => array(),
      'id_create' => array(),
      'id_update' => array(),
      'id_delete' => array(),
      'unidad_correlativo_id' => array(),
      'funcionario_correlativo_id' => array(),
      'email_externo' => array(),
      'emisor_persona_id' => array(),
      'emisor_persona_cargo_id' => array(),
      'telf_movil_externo' => array(),
      'telf_local_externo' => array(),
      'prioridad' => array(),
      'editado' => array(),
      'interoperabilidad_enviada_id' => array(),
      'interoperabilidad_recibida_id' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'Correspondencia_CorrespondenciaForm';
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'Correspondencia_CorrespondenciaFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 3;
  }

  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getTableMethod()
  {
    return 'innerListRecibida';
  }

  public function getTableCountMethod()
  {
    return '';
  }
}
