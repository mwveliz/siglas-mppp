<?php

/**
 * Correspondencia_TipoFormato form.
 *
 * @package    sigla-(institution)
 * @subpackage form
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Correspondencia_TipoFormatoForm extends BaseCorrespondencia_TipoFormatoForm
{
  public function configure()
  {
    $this->widgetSchema['privado'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine::getTable('Correspondencia_TipoFormato')->getPrivado(),
      'multiple' => false, 'expanded' => true
    ));
    
    $this->widgetSchema['tipo'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine::getTable('Correspondencia_TipoFormato')->getTipo(),
      'multiple' => false, 'expanded' => false
    ));
  }
}
