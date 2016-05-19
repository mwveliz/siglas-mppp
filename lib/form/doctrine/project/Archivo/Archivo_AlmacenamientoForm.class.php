<?php

/**
 * Archivo_Almacenamiento form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Archivo_AlmacenamientoForm extends BaseArchivo_AlmacenamientoForm
{
  public function configure()
  {
    unset($this['estante_id']);
    
    $this->widgetSchema['serie_documental_id'] = new sfWidgetFormDoctrineChoice(array(
      'model'  => 'Archivo_SerieDocumental',
      'table_method' => 'serieDeUnidadAutorizadas',
      'multiple' => false, 'expanded' => false
    ));
  }
}
