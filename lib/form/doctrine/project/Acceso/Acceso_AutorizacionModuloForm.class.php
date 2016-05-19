<?php

/**
 * Acceso_AutorizacionModulo form.
 *
 * @package    siglas-(institucion)
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Acceso_AutorizacionModuloForm extends BaseAcceso_AutorizacionModuloForm
{
  public function configure()
  {
      unset($this['modulo_id']);
  }
}
