<?php

/**
 * Archivo_SerieDocumental form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Archivo_SerieDocumentalForm extends BaseArchivo_SerieDocumentalForm
{
  public function configure()
  {
//    unset($this['unidad_id']);
      
//    $this->widgetSchema['unidad_id'] = new sfWidgetFormChoice(array(
//        'choices'  => Doctrine::getTable('Organigrama_Unidad')->combounidad(),
//        'expanded' => false, 'multiple' => false
//    ));
    
    $this->setValidator('unidad_id', new sfValidatorInteger(array(
                'required' => false,
            )));
  }
}
