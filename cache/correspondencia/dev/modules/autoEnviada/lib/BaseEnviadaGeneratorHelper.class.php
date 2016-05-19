<?php

/**
 * enviada module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage enviada
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseEnviadaGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'correspondencia_correspondencia' : 'correspondencia_correspondencia_'.$action;
  }
}
