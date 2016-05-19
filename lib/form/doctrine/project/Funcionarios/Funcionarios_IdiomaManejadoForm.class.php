<?php

/**
 * Funcionarios_IdiomaManejado form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Funcionarios_IdiomaManejadoForm extends BaseFuncionarios_IdiomaManejadoForm
{
  public function configure()
  {
    $this->widgetSchema['idioma_id'] = new sfWidgetFormDoctrineChoice(array(
    'model'     => 'Public_Idioma',
    'add_empty' => 'Seleccione idioma',

    ));  
        
    $principal = array('0' => 'No','1'=> 'Si');
    $this->widgetSchema['idioma_principal'] = new sfWidgetFormChoice(array(
        'choices' => $principal, 
        'multiple' => false, 
        'expanded' => true,
        'default' => '0'
    ));
    
            
    $habla = array('0' => 'No','1'=> 'Si');
    $this->widgetSchema['idioma_habla'] = new sfWidgetFormChoice(array(
        'choices' => $habla, 
        'multiple' => false, 
        'expanded' => true,
        'default' => '0'
    ));
    
            
    $lee = array('0' => 'No','1'=> 'Si');
    $this->widgetSchema['idioma_lee'] = new sfWidgetFormChoice(array(
        'choices' => $lee, 
        'multiple' => false, 
        'expanded' => true,
        'default' => '0'
    ));
    
            
    $escribe = array('0' => 'No','1'=> 'Si');
    $this->widgetSchema['idioma_escribe'] = new sfWidgetFormChoice(array(
        'choices' => $escribe, 
        'multiple' => false, 
        'expanded' => true,
        'default' => '0'
    ));
         
  }
}
