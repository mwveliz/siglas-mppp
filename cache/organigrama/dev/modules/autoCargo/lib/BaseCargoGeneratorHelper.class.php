<?php

/**
 * cargo module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage cargo
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCargoGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'organigrama_cargo' : 'organigrama_cargo_'.$action;
  }
}
