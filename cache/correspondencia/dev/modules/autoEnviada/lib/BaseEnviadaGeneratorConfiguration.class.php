<?php

/**
 * enviada module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage enviada
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseEnviadaGeneratorConfiguration extends sfModelGeneratorConfiguration
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
    return array(  '_list' =>   array(  ),  '_save' =>   array(  ),);
  }

  public function getEditActions()
  {
    return array(  '_list' =>   array(  ),  '_save' =>   array(  ),);
  }

  public function getListObjectActions()
  {
    return array();
  }

  public function getListActions()
  {
    return array(  '_new' =>   array(  ),  'excel' =>   array(    'label' => 'Exportar',    'action' => 'excel',  ),  'estadisticas' =>   array(    'label' => 'Estadisticas',    'action' => 'estadisticas',  ),);
  }

  public function getListBatchActions()
  {
    return array(  'anular' =>   array(    'label' => 'Anular',  ),  'firmarEnviar' =>   array(    'label' => 'Firmar y Enviar',  ),);
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
    return 'Correspondencia y Solicitudes enviadas';
  }

  public function getEditTitle()
  {
    return 'Editar correspondencia o solicitud número <%%n_correspondencia_emisor%%>';
  }

  public function getNewTitle()
  {
    return 'Nueva correspondencia o solicitud';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'n_correspondencia_emisor',  1 => 'f_envio',  2 => 'created_at',  3 => 'status',  4 => 'prioridad',  5 => 'hechoPor',  6 => '_separador_firman',  7 => 'firma',  8 => '_separador_receptor_externo',  9 => 'receptor_organismo_id',  10 => 'receptor_persona_id',  11 => 'receptor_persona_cargo_id',  12 => 'tipo_traslado_externo',  13 => 'empresa_traslado',  14 => 'n_guia_traslado',  15 => '_separador_receptor_interno',  16 => '_unidad_funcionario_filter',  17 => '_separador_formatos',  18 => 'formato',  19 => 'formatoPalabra',  20 => '_separador_adjuntos',  21 => 'adjunto',  22 => '_separador_fisicos',  23 => 'fisico',  24 => 'fisicoPalabra',);
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
      'n_correspondencia_emisor' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'N° Envio',  'help' => 'Número o Nombre con el que identificará el envio. Ejemplos= DI-1223  1233  DINFOR3  D1233',),
      'n_correspondencia_externa' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'emisor_unidad_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'emisor_organismo_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
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
      'emisor_persona_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'emisor_persona_cargo_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'telf_movil_externo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'telf_local_externo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'prioridad' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'editado' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'interoperabilidad_enviada_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'interoperabilidad_recibida_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
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
      'tadjuntos' => array(  'label' => ' ',),
      'tfisicos' => array(  'label' => ' ',),
      'ultima_vista' => array(  'label' => ' ',),
      'user_update' => array(  'label' => 'Hecho por',),
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
      'emisor_persona_id' => array(),
      'emisor_persona_cargo_id' => array(),
      'telf_movil_externo' => array(),
      'telf_local_externo' => array(),
      'prioridad' => array(),
      'editado' => array(),
      'interoperabilidad_enviada_id' => array(),
      'interoperabilidad_recibida_id' => array(),
      'created_at' => array(  'label' => 'Fecha de Creación',),
      'updated_at' => array(),
      'receptor_persona' => array(  'label' => 'Dirigido a',  'help' => 'Nombre de la persona externa a la que se envio',),
      'receptor_persona_cargo' => array(  'label' => 'Cargo',  'help' => 'Cargo de la persona externa a la que se le envio la correspondencia',),
      'firma' => array(  'label' => 'Funcionario',),
      'formato' => array(  'label' => 'Tipo',),
      'formatoPalabra' => array(  'label' => 'Palabra o Frase',),
      'adjunto' => array(  'label' => 'Nombre',),
      'fisico' => array(  'label' => 'Tipo',),
      'fisicoPalabra' => array(  'label' => 'Caracteristicas',),
      'hechoPor' => array(  'label' => 'Hecha Por',),
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
      'correlativo' => array(  'label' => ' ',),
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
    return 'innerListEnviada';
  }

  public function getTableCountMethod()
  {
    return '';
  }
}
