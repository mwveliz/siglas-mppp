<?php

/**
 * Archivo_Estante form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Archivo_EstanteForm extends BaseArchivo_EstanteForm
{
  public function configure()
  {
      unset($this['porcentaje_ocupado']);
      
    $this->widgetSchema['unidad_fisica_id'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine::getTable('Organigrama_Unidad')->combounidad(),
      'expanded' => false, 'multiple' => false
    ));
    
    $this->widgetSchema['tramos'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine::getTable('Archivo_Estante')->getTramos(),
      'multiple' => false, 'expanded' => false
    ));
  }
}
