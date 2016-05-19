<?php

/**
 * usuario module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage usuario
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseUsuarioGeneratorConfiguration extends sfModelGeneratorConfiguration
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
    return array(  '_edit' => NULL,  '_delete' => NULL,);
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,);
  }

  public function getListBatchActions()
  {
    return array(  '_delete' => NULL,);
  }

  public function getListParams()
  {
    return '%%id%% - %%usuario_enlace_id%% - %%enlace_id%% - %%nombre%% - %%ldap%% - %%clave%% - %%clave_temporal%% - %%visitas%% - %%ultimaconexion%% - %%ultimo_status%% - %%ultimocambioclave%% - %%tema%% - %%acceso_global%% - %%status%% - %%id_update%% - %%ip_update%% - %%ip%% - %%pc%% - %%puerta%% - %%so%% - %%agente%% - %%variables_entorno%% - %%created_at%% - %%updated_at%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Usuario List';
  }

  public function getEditTitle()
  {
    return 'Edit Usuario';
  }

  public function getNewTitle()
  {
    return 'New Usuario';
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
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => 'id',  1 => 'usuario_enlace_id',  2 => 'enlace_id',  3 => 'nombre',  4 => 'ldap',  5 => 'clave',  6 => 'clave_temporal',  7 => 'visitas',  8 => 'ultimaconexion',  9 => 'ultimo_status',  10 => 'ultimocambioclave',  11 => 'tema',  12 => 'acceso_global',  13 => 'status',  14 => 'id_update',  15 => 'ip_update',  16 => 'ip',  17 => 'pc',  18 => 'puerta',  19 => 'so',  20 => 'agente',  21 => 'variables_entorno',  22 => 'created_at',  23 => 'updated_at',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'usuario_enlace_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'enlace_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'nombre' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'ldap' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'clave' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'clave_temporal' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'visitas' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'ultimaconexion' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'ultimo_status' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'ultimocambioclave' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'tema' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'acceso_global' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'status' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'id_update' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'ip_update' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'ip' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'pc' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'puerta' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'so' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'agente' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'variables_entorno' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'usuario_enlace_id' => array(),
      'enlace_id' => array(),
      'nombre' => array(),
      'ldap' => array(),
      'clave' => array(),
      'clave_temporal' => array(),
      'visitas' => array(),
      'ultimaconexion' => array(),
      'ultimo_status' => array(),
      'ultimocambioclave' => array(),
      'tema' => array(),
      'acceso_global' => array(),
      'status' => array(),
      'id_update' => array(),
      'ip_update' => array(),
      'ip' => array(),
      'pc' => array(),
      'puerta' => array(),
      'so' => array(),
      'agente' => array(),
      'variables_entorno' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'usuario_enlace_id' => array(),
      'enlace_id' => array(),
      'nombre' => array(),
      'ldap' => array(),
      'clave' => array(),
      'clave_temporal' => array(),
      'visitas' => array(),
      'ultimaconexion' => array(),
      'ultimo_status' => array(),
      'ultimocambioclave' => array(),
      'tema' => array(),
      'acceso_global' => array(),
      'status' => array(),
      'id_update' => array(),
      'ip_update' => array(),
      'ip' => array(),
      'pc' => array(),
      'puerta' => array(),
      'so' => array(),
      'agente' => array(),
      'variables_entorno' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'usuario_enlace_id' => array(),
      'enlace_id' => array(),
      'nombre' => array(),
      'ldap' => array(),
      'clave' => array(),
      'clave_temporal' => array(),
      'visitas' => array(),
      'ultimaconexion' => array(),
      'ultimo_status' => array(),
      'ultimocambioclave' => array(),
      'tema' => array(),
      'acceso_global' => array(),
      'status' => array(),
      'id_update' => array(),
      'ip_update' => array(),
      'ip' => array(),
      'pc' => array(),
      'puerta' => array(),
      'so' => array(),
      'agente' => array(),
      'variables_entorno' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'usuario_enlace_id' => array(),
      'enlace_id' => array(),
      'nombre' => array(),
      'ldap' => array(),
      'clave' => array(),
      'clave_temporal' => array(),
      'visitas' => array(),
      'ultimaconexion' => array(),
      'ultimo_status' => array(),
      'ultimocambioclave' => array(),
      'tema' => array(),
      'acceso_global' => array(),
      'status' => array(),
      'id_update' => array(),
      'ip_update' => array(),
      'ip' => array(),
      'pc' => array(),
      'puerta' => array(),
      'so' => array(),
      'agente' => array(),
      'variables_entorno' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'usuario_enlace_id' => array(),
      'enlace_id' => array(),
      'nombre' => array(),
      'ldap' => array(),
      'clave' => array(),
      'clave_temporal' => array(),
      'visitas' => array(),
      'ultimaconexion' => array(),
      'ultimo_status' => array(),
      'ultimocambioclave' => array(),
      'tema' => array(),
      'acceso_global' => array(),
      'status' => array(),
      'id_update' => array(),
      'ip_update' => array(),
      'ip' => array(),
      'pc' => array(),
      'puerta' => array(),
      'so' => array(),
      'agente' => array(),
      'variables_entorno' => array(),
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
    return 'Acceso_UsuarioForm';
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
    return 'Acceso_UsuarioFormFilter';
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
    return '';
  }

  public function getTableCountMethod()
  {
    return '';
  }
}
