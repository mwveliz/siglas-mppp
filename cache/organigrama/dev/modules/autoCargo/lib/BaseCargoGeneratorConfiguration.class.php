<?php

/**
 * cargo module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage cargo
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCargoGeneratorConfiguration extends sfModelGeneratorConfiguration
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
    return array(  '_list' =>   array(  ),  '_save' =>   array(  ),);
  }

  public function getListObjectActions()
  {
    return array(  '_edit' =>   array(  ),  'mover' =>   array(    'label' => 'Mover de Unidad',    'action' => 'mover',  ),  'anular' =>   array(    'label' => 'Anular',    'action' => 'anular',  ),  'reactivar' =>   array(    'label' => 'Reactivar',    'action' => 'reactivar',  ),);
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,);
  }

  public function getListBatchActions()
  {
    return array();
  }

  public function getListParams()
  {
    return '%%codigo_nomina%% - %%condicion%% - %%tipo%% - %%grado%% - %%f_ingreso%% - %%acceso_perfil%% - %%_funcionario_actual%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Cargos de la Unidad';
  }

  public function getEditTitle()
  {
    return 'Editar Cargo %%codigo_nomina%%';
  }

  public function getNewTitle()
  {
    return 'Nuevo Cargo';
  }

  public function getFilterDisplay()
  {
    return array();
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array(  'Identificación' =>   array(    0 => 'codigo_nomina',    1 => '_condicionTipoGrado',    2 => 'f_ingreso',  ),  'Acceso' =>   array(    0 => 'perfil_id',  ),);
  }

  public function getNewDisplay()
  {
    return array(  'Identificación' =>   array(    0 => 'codigo_nomina',    1 => '_condicionTipoGrado',    2 => 'f_ingreso',  ),  'Acceso' =>   array(    0 => 'perfil_id',  ),);
  }

  public function getListDisplay()
  {
    return array(  0 => 'codigo_nomina',  1 => 'condicion',  2 => 'tipo',  3 => 'grado',  4 => 'f_ingreso',  5 => 'acceso_perfil',  6 => '_funcionario_actual',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'unidad_funcional_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'unidad_administrativa_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'padre_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'codigo_nomina' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'help' => 'ingrese el codigo de identificacion del cargo',),
      'cargo_tipo_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',  'label' => 'Tipo',  'help' => 'seleccione el tipo de cargo',),
      'cargo_condicion_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',  'label' => 'Condición',  'help' => 'seleccione la condición del cargo',),
      'cargo_grado_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',  'label' => 'Grado',  'help' => 'seleccione el grado o jerarquía del cargo',),
      'descripcion' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'help' => 'ingrese una descripción breve de las actividades del cargo',),
      'f_ingreso' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',  'label' => 'Fecha de apertura',  'help' => 'seleccione la fecha en la que se inicio el cargo',),
      'f_retiro' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'motivo_retiro' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'perfil_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
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
      'unidad_funcional_id' => array(),
      'unidad_administrativa_id' => array(),
      'padre_id' => array(),
      'codigo_nomina' => array(),
      'cargo_tipo_id' => array(),
      'cargo_condicion_id' => array(),
      'cargo_grado_id' => array(),
      'descripcion' => array(),
      'f_ingreso' => array(),
      'f_retiro' => array(),
      'motivo_retiro' => array(),
      'perfil_id' => array(),
      'status' => array(),
      'id_update' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'acceso_perfil' => array(  'label' => 'Perfil asignado',),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'unidad_funcional_id' => array(),
      'unidad_administrativa_id' => array(),
      'padre_id' => array(),
      'codigo_nomina' => array(),
      'cargo_tipo_id' => array(),
      'cargo_condicion_id' => array(),
      'cargo_grado_id' => array(),
      'descripcion' => array(),
      'f_ingreso' => array(),
      'f_retiro' => array(),
      'motivo_retiro' => array(),
      'perfil_id' => array(),
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
      'unidad_funcional_id' => array(),
      'unidad_administrativa_id' => array(),
      'padre_id' => array(),
      'codigo_nomina' => array(),
      'cargo_tipo_id' => array(),
      'cargo_condicion_id' => array(),
      'cargo_grado_id' => array(),
      'descripcion' => array(),
      'f_ingreso' => array(),
      'f_retiro' => array(),
      'motivo_retiro' => array(),
      'perfil_id' => array(),
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
      'unidad_funcional_id' => array(),
      'unidad_administrativa_id' => array(),
      'padre_id' => array(),
      'codigo_nomina' => array(),
      'cargo_tipo_id' => array(),
      'cargo_condicion_id' => array(),
      'cargo_grado_id' => array(),
      'descripcion' => array(),
      'f_ingreso' => array(),
      'f_retiro' => array(),
      'motivo_retiro' => array(),
      'perfil_id' => array(),
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
      'unidad_funcional_id' => array(),
      'unidad_administrativa_id' => array(),
      'padre_id' => array(),
      'codigo_nomina' => array(),
      'cargo_tipo_id' => array(),
      'cargo_condicion_id' => array(),
      'cargo_grado_id' => array(),
      'descripcion' => array(),
      'f_ingreso' => array(),
      'f_retiro' => array(),
      'motivo_retiro' => array(),
      'perfil_id' => array(),
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
    return 'Organigrama_CargoForm';
  }

  public function hasFilterForm()
  {
    return false;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'Organigrama_CargoFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
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
