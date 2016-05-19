<?php

/**
 * Funcionarios_Contacto form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Funcionarios_ContactoForm extends BaseFuncionarios_ContactoForm
{
  public function configure()
  {
     
    echo sfContext::getInstance()->getUser()->getAttribute('contacto_accion');
    
    $tipo = array('' => 'Seleccione','1' => 'Teléfono Fijo','2'=> 'Teléfono Móvil','3'=> 'Correo electrónico');
    $this->widgetSchema['contacto_tipo'] = new sfWidgetFormChoice(array(
        'choices' => $tipo, 
        'multiple' => false, 
        'expanded' => false        
    )); 
          
  }
}
