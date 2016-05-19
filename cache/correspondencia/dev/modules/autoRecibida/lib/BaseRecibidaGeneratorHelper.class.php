<?php

/**
 * recibida module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage recibida
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRecibidaGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'correspondencia_correspondencia_recibida' : 'correspondencia_correspondencia_recibida_'.$action;
  }
}
