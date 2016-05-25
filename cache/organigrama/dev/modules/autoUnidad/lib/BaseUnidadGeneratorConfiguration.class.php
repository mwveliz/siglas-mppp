<?php

/**
 * unidad module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage unidad
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseUnidadGeneratorConfiguration extends sfModelGeneratorConfiguration
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
    return array(  '_edit' =>   array(  ),  'anular' =>   array(    'label' => 'Anular',    'action' => 'anular',  ),  'cargos' =>   array(    'label' => 'Cargos',    'action' => 'cargos',  ),);
  }

  public function getListActions()
  {
    return array(  '_new' =>   array(  ),  'tipo' =>   array(    'label' => 'Tipos de Unidad',    'action' => 'unidadTipo',  ),);
  }

  public function getListBatchActions()
  {
    return array();
  }

  public function getListParams()
  {
    return '%%codigo_unidad%% - %%_list_identificacion%% - %%_list_detalles%% - %%_list_direccion%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Estructura Organizativa';
  }

  public function getEditTitle()
  {
    return 'Editar Unidad %%nombre%%';
  }

  public function getNewTitle()
  {
    return 'Nueva Unidad';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'codigo_unidad',  1 => 'nombre',  2 => 'unidad_tipo_id',  3 => 'estado_id',  4 => 'municipio_id',  5 => 'parroquia_id',  6 => 'dir_ciudad',);
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array(  'Identificación' =>   array(    0 => 'codigo_unidad',    1 => 'nombre',    2 => 'nombre_reducido',    3 => 'siglas',    4 => 'adscripcion',    5 => 'unidad_tipo_id',    6 => 'padre_id',    7 => 'f_ingreso',  ),  'Dirección' =>   array(    0 => '_form_direccion_padre',    1 => 'estado_id',    2 => 'municipio_id',    3 => 'parroquia_id',    4 => 'dir_av_calle_esq',    5 => 'dir_edf_torre_anexo',    6 => 'dir_piso',    7 => 'dir_urbanizacion',    8 => 'dir_ciudad',    9 => 'dir_punto_referencia',  ),  'Contacto' =>   array(    0 => 'telf_uno',    1 => 'telf_dos',  ),);
  }

  public function getNewDisplay()
  {
    return array(  'Identificación' =>   array(    0 => 'codigo_unidad',    1 => 'nombre',    2 => 'nombre_reducido',    3 => 'siglas',    4 => 'adscripcion',    5 => 'unidad_tipo_id',    6 => 'padre_id',    7 => 'f_ingreso',  ),  'Dirección' =>   array(    0 => '_form_direccion_padre',    1 => 'estado_id',    2 => 'municipio_id',    3 => 'parroquia_id',    4 => 'dir_av_calle_esq',    5 => 'dir_edf_torre_anexo',    6 => 'dir_piso',    7 => 'dir_urbanizacion',    8 => 'dir_ciudad',    9 => 'dir_punto_referencia',  ),  'Contacto' =>   array(    0 => 'telf_uno',    1 => 'telf_dos',  ),);
  }

  public function getListDisplay()
  {
    return array(  0 => 'codigo_unidad',  1 => '_list_identificacion',  2 => '_list_detalles',  3 => '_list_direccion',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'id_externo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'codigo_unidad' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'padre_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',  'label' => 'Dependencia',  'help' => 'seleccione la unidad administrativa de la cual depende jerárquicamente',),
      'unidad_tipo_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',  'label' => 'Tipo de Unidad',  'help' => 'seleccione la clasificación de la unidad',),
      'nombre' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'help' => 'Escriba el nombre con el que identificara la unidad',),
      'nombre_reducido' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'help' => 'Escriba un nombre corto para esta unidad para efectos de diagramación o vizualizaciones varias',),
      'siglas' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'SIGLAS',),
      'adscripcion' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'estado_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'municipio_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'parroquia_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'dir_av_calle_esq' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Av/Calle/Ezq',),
      'dir_edf_torre_anexo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Edif/Torre/Anexo',),
      'dir_piso' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Piso',),
      'dir_oficina' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'dir_urbanizacion' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Urbanización',),
      'dir_ciudad' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Ciudad',),
      'dir_punto_referencia' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Punto de Referencia',),
      'telf_uno' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Telefono principal',),
      'telf_dos' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Telefono secundario',),
      'f_ingreso' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',  'label' => 'Fecha de Apertura',  'help' => 'indique la fecha en la cual se dio apertura o comenzo a laborar',),
      'f_retiro' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'motivo_retiro' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'orden_automatico' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'orden_preferencial' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'status' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'id_update' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'id_externo' => array(),
      'codigo_unidad' => array(),
      'padre_id' => array(),
      'unidad_tipo_id' => array(),
      'nombre' => array(),
      'nombre_reducido' => array(),
      'siglas' => array(),
      'adscripcion' => array(),
      'estado_id' => array(),
      'municipio_id' => array(),
      'parroquia_id' => array(),
      'dir_av_calle_esq' => array(),
      'dir_edf_torre_anexo' => array(),
      'dir_piso' => array(),
      'dir_oficina' => array(),
      'dir_urbanizacion' => array(),
      'dir_ciudad' => array(),
      'dir_punto_referencia' => array(),
      'telf_uno' => array(),
      'telf_dos' => array(),
      'f_ingreso' => array(),
      'f_retiro' => array(),
      'motivo_retiro' => array(),
      'orden_automatico' => array(),
      'orden_preferencial' => array(),
      'status' => array(),
      'id_update' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'list_identificacion' => array(  'label' => 'Identificación',),
      'list_detalles' => array(  'label' => 'Detalles',),
      'list_direccion' => array(  'label' => 'Dirección',),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'id_externo' => array(),
      'codigo_unidad' => array(),
      'padre_id' => array(),
      'unidad_tipo_id' => array(),
      'nombre' => array(),
      'nombre_reducido' => array(),
      'siglas' => array(),
      'adscripcion' => array(),
      'estado_id' => array(),
      'municipio_id' => array(),
      'parroquia_id' => array(),
      'dir_av_calle_esq' => array(),
      'dir_edf_torre_anexo' => array(),
      'dir_piso' => array(),
      'dir_oficina' => array(),
      'dir_urbanizacion' => array(),
      'dir_ciudad' => array(),
      'dir_punto_referencia' => array(),
      'telf_uno' => array(),
      'telf_dos' => array(),
      'f_ingreso' => array(),
      'f_retiro' => array(),
      'motivo_retiro' => array(),
      'orden_automatico' => array(),
      'orden_preferencial' => array(),
      'status' => array(),
      'id_update' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'id_externo' => array(),
      'codigo_unidad' => array(),
      'padre_id' => array(),
      'unidad_tipo_id' => array(),
      'nombre' => array(),
      'nombre_reducido' => array(),
      'siglas' => array(),
      'adscripcion' => array(),
      'estado_id' => array(),
      'municipio_id' => array(),
      'parroquia_id' => array(),
      'dir_av_calle_esq' => array(),
      'dir_edf_torre_anexo' => array(),
      'dir_piso' => array(),
      'dir_oficina' => array(),
      'dir_urbanizacion' => array(),
      'dir_ciudad' => array(),
      'dir_punto_referencia' => array(),
      'telf_uno' => array(),
      'telf_dos' => array(),
      'f_ingreso' => array(),
      'f_retiro' => array(),
      'motivo_retiro' => array(),
      'orden_automatico' => array(),
      'orden_preferencial' => array(),
      'status' => array(),
      'id_update' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'id_externo' => array(),
      'codigo_unidad' => array(),
      'padre_id' => array(),
      'unidad_tipo_id' => array(),
      'nombre' => array(),
      'nombre_reducido' => array(),
      'siglas' => array(),
      'adscripcion' => array(),
      'estado_id' => array(),
      'municipio_id' => array(),
      'parroquia_id' => array(),
      'dir_av_calle_esq' => array(),
      'dir_edf_torre_anexo' => array(),
      'dir_piso' => array(),
      'dir_oficina' => array(),
      'dir_urbanizacion' => array(),
      'dir_ciudad' => array(),
      'dir_punto_referencia' => array(),
      'telf_uno' => array(),
      'telf_dos' => array(),
      'f_ingreso' => array(),
      'f_retiro' => array(),
      'motivo_retiro' => array(),
      'orden_automatico' => array(),
      'orden_preferencial' => array(),
      'status' => array(),
      'id_update' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'id_externo' => array(),
      'codigo_unidad' => array(),
      'padre_id' => array(),
      'unidad_tipo_id' => array(),
      'nombre' => array(),
      'nombre_reducido' => array(),
      'siglas' => array(),
      'adscripcion' => array(),
      'estado_id' => array(),
      'municipio_id' => array(),
      'parroquia_id' => array(),
      'dir_av_calle_esq' => array(),
      'dir_edf_torre_anexo' => array(),
      'dir_piso' => array(),
      'dir_oficina' => array(),
      'dir_urbanizacion' => array(),
      'dir_ciudad' => array(),
      'dir_punto_referencia' => array(),
      'telf_uno' => array(),
      'telf_dos' => array(),
      'f_ingreso' => array(),
      'f_retiro' => array(),
      'motivo_retiro' => array(),
      'orden_automatico' => array(),
      'orden_preferencial' => array(),
      'status' => array(),
      'id_update' => array(),
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
    return 'Organigrama_UnidadForm';
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
    return 'Organigrama_UnidadFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 1000;
  }

  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getTableMethod()
  {
    return 'innerList';
  }

  public function getTableCountMethod()
  {
    return '';
  }
}
