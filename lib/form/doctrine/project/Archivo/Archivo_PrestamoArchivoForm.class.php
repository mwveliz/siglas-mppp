<?php

/**
 * Archivo_PrestamoArchivo form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Archivo_PrestamoArchivoForm extends BaseArchivo_PrestamoArchivoForm
{
  public function configure()
  {
    unset($this['expediente_id']);

    $years = range(date('Y'), date('Y')+1);
    $this->widgetSchema['f_expiracion'] = new sfWidgetFormJQueryDate(array(
        'culture' => 'es',
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
