<?php

/**
 * Seguridad_Preingreso form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Seguridad_PreingresoForm extends BaseSeguridad_PreingresoForm
{
  public function configure()
  {
    $years = range(date('Y'), date('Y')+1);
    $hoy = date('Y-m-d');
    $this->widgetSchema['f_ingreso_posible_inicio'] = new sfWidgetFormJQueryDate(array(
        'image' => '/images/icon/calendar.png',
        'culture' => 'es',
        'config' => "{changeYear: true, yearRange: 'c-100:c+100', minDate: '".$hoy."', firstDay: 1}",
        'date_widget' => new sfWidgetFormI18nDate(array(
                        'format' => '%day%-%month%-%year%',
                        'culture'=>'es',
                        'empty_values' => array('day'=>'<- Día ->',
                        'month'=>'<- Mes ->',
                        'year'=>'<- Año ->'),
                        'years' => array_combine($years, $years)))
    ));
    
    $this->widgetSchema['f_ingreso_posible_final'] = new sfWidgetFormJQueryDate(array(
        'image' => '/images/icon/calendar.png',
        'culture' => 'es',
        'config' => "{changeYear: true, yearRange: 'c-100:c+100', minDate: '".$hoy."', firstDay: 1}",
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
