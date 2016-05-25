<?php

/**
 * funcionario_cargo module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage funcionario_cargo
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFuncionario_cargoGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'funcionarios_funcionario_cargo' : 'funcionarios_funcionario_cargo_'.$action;
  }
}
