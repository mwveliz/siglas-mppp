<?php

/**
 * Archivo_CuerpoDocumental form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Archivo_CuerpoDocumentalForm extends BaseArchivo_CuerpoDocumentalForm
{
  public function configure()
  {
    unset($this['serie_documental_id']);
      
    $this->widgetSchema['padre_id'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine::getTable('Archivo_CuerpoDocumental')->comboCuerpoDocumental(),
      'expanded' => false, 'multiple' => false
    ));
  }
}