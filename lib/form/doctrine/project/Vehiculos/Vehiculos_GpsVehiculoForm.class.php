<?php

/**
 * Vehiculos_GpsVehiculo form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Vehiculos_GpsVehiculoForm extends BaseVehiculos_GpsVehiculoForm
{
  public function configure()
  {
        unset($this['vehiculo_id'],$this['gps_id'],$this['operador_id'],$this['clave'],$this['sim'],$this['alerta_parametro'],$this['ip_create']);
  }
}
