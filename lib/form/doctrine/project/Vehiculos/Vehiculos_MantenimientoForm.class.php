<?php

/**
 * Vehiculos_Mantenimiento form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Vehiculos_MantenimientoForm extends BaseVehiculos_MantenimientoForm
{
  public function configure()
  {
      unset($this['ip_create']);
      
      $years = range(date('Y'), date('Y')+5);
        $this->widgetSchema['fecha'] = new sfWidgetFormJQueryDate(array(
            'image' => '/images/icon/calendar.png',
            'culture' => 'es',
            'config' => '{changeYear: true, yearRange: \'c-100:c+100\'}',
            'date_widget' => new sfWidgetFormI18nDate(array(
                            'format' => '%day%-%month%-%year%',
                            'culture'=>'es',
                            'empty_values' => array('day'=>'<- Día ->',
                            'month'=>'<- Mes ->',
                            'year'=>'<- Año ->'),
                            'years' => array_combine($years, $years)))
        ));
  }
}
