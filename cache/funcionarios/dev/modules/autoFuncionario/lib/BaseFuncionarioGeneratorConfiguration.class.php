<?php

/**
 * funcionario module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage funcionario
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFuncionarioGeneratorConfiguration extends sfModelGeneratorConfiguration
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
    return array(  '_edit' =>   array(  ),  'cargosf' =>   array(    'label' => 'Cargo',    'action' => 'cargosf',  ),  'passwd' =>   array(    'label' => 'Reiniciar Contraseña',    'action' => 'passwd',    'params' => 'confirm=\'¿Estas seguro de reiniciar la contraseña?\'',  ),  'digitalizar' =>   array(    'label' => 'Firma digitalizada',    'action' => 'digiFirma',  ),  'global_enable' =>   array(    'label' => 'Activar acceso global',    'action' => 'globalEnable',    'params' => 'confirm=\'¿Estas seguro de activar el acceso global?\'',  ),  'global_disable' =>   array(    'label' => 'Desactivar acceso global',    'action' => 'globalDisable',    'params' => 'confirm=\'¿Estas seguro de desactivar el acceso global?\'',  ),  'anular' =>   array(    'label' => 'Anular',    'action' => 'anular',  ),  'reactivar' =>   array(    'label' => 'Reactivar',    'action' => 'reactivar',  ),);
  }

  public function getListActions()
  {
    return array(  '_new' =>   array(    'credentials' =>     array(      0 =>       array(        0 => 'Root',        1 => 'Administrador',      ),    ),  ),  'formularioFirmas' =>   array(    'credentials' =>     array(      0 =>       array(        0 => 'Root',        1 => 'Administrador',      ),    ),    'label' => 'Formulario de firmas',    'action' => 'formularioFirmas',  ),  'migrar' =>   array(    'credentials' =>     array(      0 =>       array(        0 => 'Root',        1 => 'Administrador',      ),    ),    'label' => 'Migrar Funcionarios',    'action' => 'migrarFuncionarios',  ),);
  }

  public function getListBatchActions()
  {
    return array();
  }

  public function getListParams()
  {
    return '%%_foto%% - %%_cargo%% - %%ci%% - %%primer_nombre%% - %%segundo_nombre%% - %%primer_apellido%% - %%segundo_apellido%% - %%sexo%% - %%_contacto%% - %%_usuario%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Listado de Funcionarios y Personal';
  }

  public function getEditTitle()
  {
    return 'Editar Funcionario o Personal %%primer_nombre%%, %%primer_apellido%%';
  }

  public function getNewTitle()
  {
    return 'Nuevo Funcionario o Personal';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'ci',  1 => 'primer_nombre',  2 => 'segundo_nombre',  3 => 'primer_apellido',  4 => 'segundo_apellido',);
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array(  'Datos Básicos' =>   array(    0 => '_ci',    1 => 'primer_nombre',    2 => 'segundo_nombre',    3 => 'primer_apellido',    4 => 'segundo_apellido',    5 => 'f_nacimiento',    6 => 'estado_nacimiento_id',    7 => 'sexo',    8 => 'edo_civil',    9 => 'telf_movil',    10 => 'email_institucional',    11 => 'email_personal',    12 => 'email_validado',  ),);
  }

  public function getNewDisplay()
  {
    return array(  'Datos Básicos' =>   array(    0 => '_ci',    1 => 'primer_nombre',    2 => 'segundo_nombre',    3 => 'primer_apellido',    4 => 'segundo_apellido',    5 => 'f_nacimiento',    6 => 'estado_nacimiento_id',    7 => 'sexo',    8 => 'edo_civil',    9 => 'telf_movil',    10 => 'email_institucional',    11 => 'email_personal',    12 => 'email_validado',  ),  'Cargo' =>   array(    0 => '_cargo_asignado',  ),);
  }

  public function getListDisplay()
  {
    return array(  0 => '_foto',  1 => '_cargo',  2 => 'ci',  3 => 'primer_nombre',  4 => 'segundo_nombre',  5 => 'primer_apellido',  6 => 'segundo_apellido',  7 => 'sexo',  8 => '_contacto',  9 => '_usuario',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'ci' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Cédula',  'help' => 'Documento de identificación de la persona',),
      'primer_nombre' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => '1º Nombre',),
      'segundo_nombre' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => '2º Nombre',  'help' => 'Si tiene mas de 2 nombres agregue los siguientes en este campo separados por espacio',),
      'primer_apellido' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => '1º Apellido',),
      'segundo_apellido' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => '2º Apellido',  'help' => 'Si tiene mas de 2 apellidos agregue los siguientes en este campo separados por espacio',),
      'f_nacimiento' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',  'label' => 'Fecha de Nacimiento',),
      'estado_nacimiento_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',  'help' => 'Seleccione el estado donde nacion la persona',),
      'sexo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'edo_civil' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'telf_movil' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'telf_fijo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'email_validado' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'email_institucional' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'email_personal' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'codigo_validador_email' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'codigo_validador_telf' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
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
      'ci' => array(),
      'primer_nombre' => array(),
      'segundo_nombre' => array(),
      'primer_apellido' => array(),
      'segundo_apellido' => array(),
      'f_nacimiento' => array(),
      'estado_nacimiento_id' => array(),
      'sexo' => array(),
      'edo_civil' => array(),
      'telf_movil' => array(),
      'telf_fijo' => array(),
      'email_validado' => array(),
      'email_institucional' => array(),
      'email_personal' => array(),
      'codigo_validador_email' => array(),
      'codigo_validador_telf' => array(),
      'status' => array(),
      'id_update' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'cargo' => array(  'label' => '',),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'ci' => array(),
      'primer_nombre' => array(),
      'segundo_nombre' => array(),
      'primer_apellido' => array(),
      'segundo_apellido' => array(),
      'f_nacimiento' => array(),
      'estado_nacimiento_id' => array(),
      'sexo' => array(),
      'edo_civil' => array(),
      'telf_movil' => array(),
      'telf_fijo' => array(),
      'email_validado' => array(),
      'email_institucional' => array(),
      'email_personal' => array(),
      'codigo_validador_email' => array(),
      'codigo_validador_telf' => array(),
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
      'ci' => array(),
      'primer_nombre' => array(),
      'segundo_nombre' => array(),
      'primer_apellido' => array(),
      'segundo_apellido' => array(),
      'f_nacimiento' => array(),
      'estado_nacimiento_id' => array(),
      'sexo' => array(),
      'edo_civil' => array(),
      'telf_movil' => array(),
      'telf_fijo' => array(),
      'email_validado' => array(),
      'email_institucional' => array(),
      'email_personal' => array(),
      'codigo_validador_email' => array(),
      'codigo_validador_telf' => array(),
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
      'ci' => array(),
      'primer_nombre' => array(),
      'segundo_nombre' => array(),
      'primer_apellido' => array(),
      'segundo_apellido' => array(),
      'f_nacimiento' => array(),
      'estado_nacimiento_id' => array(),
      'sexo' => array(),
      'edo_civil' => array(),
      'telf_movil' => array(),
      'telf_fijo' => array(),
      'email_validado' => array(),
      'email_institucional' => array(),
      'email_personal' => array(),
      'codigo_validador_email' => array(),
      'codigo_validador_telf' => array(),
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
      'ci' => array(),
      'primer_nombre' => array(),
      'segundo_nombre' => array(),
      'primer_apellido' => array(),
      'segundo_apellido' => array(),
      'f_nacimiento' => array(),
      'estado_nacimiento_id' => array(),
      'sexo' => array(),
      'edo_civil' => array(),
      'telf_movil' => array(),
      'telf_fijo' => array(),
      'email_validado' => array(),
      'email_institucional' => array(),
      'email_personal' => array(),
      'codigo_validador_email' => array(),
      'codigo_validador_telf' => array(),
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
    return 'Funcionarios_FuncionarioForm';
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
    return 'Funcionarios_FuncionarioFormFilter';
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
