<?php

/**
 * funcionario module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage funcionario
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFuncionarioGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'funcionarios_funcionario' : 'funcionarios_funcionario_'.$action;
  }
}
