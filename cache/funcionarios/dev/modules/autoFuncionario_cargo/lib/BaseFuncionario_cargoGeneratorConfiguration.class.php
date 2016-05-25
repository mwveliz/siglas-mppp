<?php

/**
 * funcionario_cargo module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage funcionario_cargo
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFuncionario_cargoGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getActionsDefault()
  {
    return array(  '_new' =>   array(    'credentials' =>     array(      0 =>       array(        0 => 'Root',        1 => 'Administrador',      ),    ),    'label' => 'Asignar cargo',  ),);
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
    return array(  'destituir' =>   array(    'label' => 'Desincorporar',    'action' => 'edit',  ),  'mover' =>   array(    'label' => 'Mover de Unidad',    'action' => 'mover',  ),);
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
    return '%%unidad%% - %%ctnombre%% - %%funcionarios_funcionario_cargo_condicion%% - %%f_ingreso%% - %%_coletilla%% - %%f_retiro%% - %%motivo_retiro%% - %%_status%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Cargos del Funcionario o Personal';
  }

  public function getEditTitle()
  {
    return 'Desincorporación del Funcionario en el cargo';
  }

  public function getNewTitle()
  {
    return 'Nuevo cargo para el Funcionario o Personal';
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
    return array(  0 => '_desincorporacion',);
  }

  public function getNewDisplay()
  {
    return array(  'Datos del nuevo cargo' =>   array(    0 => '_form_unidad',    1 => '_form_cargos_vacios',    2 => 'funcionario_cargo_condicion_id',    3 => 'f_ingreso',  ),);
  }

  public function getListDisplay()
  {
    return array(  0 => 'unidad',  1 => 'ctnombre',  2 => 'funcionarios_funcionario_cargo_condicion',  3 => 'f_ingreso',  4 => '_coletilla',  5 => 'f_retiro',  6 => 'motivo_retiro',  7 => '_status',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'cargo_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',  'help' => 'Seleccione el cargo que se le asignara al funcionario',),
      'funcionario_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'f_ingreso' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',  'label' => 'Fecha de Asignación',  'help' => 'Fecha en la que comenzo las actividades en el cargo',),
      'observaciones' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Coletilla de Firma',  'help' => 'escriba de existir la coletilla de firma.',),
      'funcionario_cargo_condicion_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',  'label' => 'Condición en el Cargo',),
      'f_retiro' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',  'label' => 'Fecha de desincorporación',),
      'motivo_retiro' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Motivo de desincorporación',  'help' => 'escriba una breve observación de la desincorporación en el cargo',),
      'status' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Estatus',  'help' => 'estatus en el cargo',),
      'id_update' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'cargo_id' => array(),
      'funcionario_id' => array(),
      'f_ingreso' => array(),
      'observaciones' => array(),
      'funcionario_cargo_condicion_id' => array(),
      'f_retiro' => array(),
      'motivo_retiro' => array(),
      'status' => array(),
      'id_update' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'funcionarios_funcionario_cargo_condicion' => array(  'label' => 'Condicion en el Cargo',),
      'ctnombre' => array(  'label' => 'Cargo',),
      '_coletilla' => array(  'label' => 'Coletilla de Firma',),
      '_status' => array(  'label' => 'Estatus',),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'cargo_id' => array(),
      'funcionario_id' => array(),
      'f_ingreso' => array(),
      'observaciones' => array(),
      'funcionario_cargo_condicion_id' => array(),
      'f_retiro' => array(),
      'motivo_retiro' => array(),
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
      'cargo_id' => array(),
      'funcionario_id' => array(),
      'f_ingreso' => array(),
      'observaciones' => array(),
      'funcionario_cargo_condicion_id' => array(),
      'f_retiro' => array(),
      'motivo_retiro' => array(),
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
      'cargo_id' => array(),
      'funcionario_id' => array(),
      'f_ingreso' => array(),
      'observaciones' => array(),
      'funcionario_cargo_condicion_id' => array(),
      'f_retiro' => array(),
      'motivo_retiro' => array(),
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
      'cargo_id' => array(),
      'funcionario_id' => array(),
      'f_ingreso' => array(),
      'observaciones' => array(),
      'funcionario_cargo_condicion_id' => array(),
      'f_retiro' => array(),
      'motivo_retiro' => array(),
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
    return 'Funcionarios_FuncionarioCargoForm';
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
    return 'Funcionarios_FuncionarioCargoFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 100;
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
