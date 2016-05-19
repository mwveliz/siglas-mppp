<?php

/**
 * Vehiculos_Conductor form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Vehiculos_ConductorForm extends BaseVehiculos_ConductorForm
{
  public function configure()
  {
      unset($this['ip_create']);
  }
}
