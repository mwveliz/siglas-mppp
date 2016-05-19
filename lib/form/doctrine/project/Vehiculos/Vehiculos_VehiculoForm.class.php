<?php

/**
 * Vehiculos_Vehiculo form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Vehiculos_VehiculoForm extends BaseVehiculos_VehiculoForm
{
  public function configure()
  {
      unset($this['ip_create']);
  }
}
