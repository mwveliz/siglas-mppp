<?php

/**
 * Funcionarios_InformacionCorporalFamiliar form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Funcionarios_InformacionCorporalFamiliarForm extends BaseFuncionarios_InformacionCorporalFamiliarForm
{
  public function configure()
  {
    $familiarcorporal = Doctrine::getTable('Funcionarios_InformacionCorporalFamiliar')->findOneByFamiliarId(sfContext::getInstance()->getUser()->getAttribute('familiarcorporal_id'));
       
    $ojos = array('' => 'Seleccione','Ambar' => 'Ambar','Avellana' => 'Avellana','Azul' => 'Azul','Castaño'=> 'Castaño','Verde' => 'Verde','Gris' => 'Gris','Negro' => 'Negro');
    $this->widgetSchema['corporal_color_ojos'] = new sfWidgetFormChoice(array(
        'choices' => $ojos, 
        'multiple' => false, 
        'expanded' => false        
    ));
    
    $cabello = array('' => 'Seleccione','Ambar' => 'Ambar', 'Blanco' => 'Blanco','Castaño' => 'Castaño','Gris' => 'Gris','Negro'=> 'Negro','Rojo' => 'Rojo','Rubio' => 'Rubio');
    $this->widgetSchema['corporal_color_cabello'] = new sfWidgetFormChoice(array(
        'choices' => $cabello, 
        'multiple' => false, 
        'expanded' => false        
    ));
        
    $piel = array('' => 'Seleccione','Blanca' => 'Blanca','Rosada'=> 'Rosada','Trigeña'=> 'Trigeña','Mulata'=> 'Mulata','Morena' => 'Morena','Amarilla' => 'Amarilla');
    $this->widgetSchema['corporal_color_piel'] = new sfWidgetFormChoice(array(
        'choices' => $piel, 
        'multiple' => false, 
        'expanded' => false        
    ));
    
    $tallas = array('XS' => 'XS (extra pequeña)','S'=> 'S (pequeña)','M'=> 'M (mediana)','L'=> 'L (grande)','XL'=> 'XL (extra grande)','XXL'=> 'XXL (extra grande doble)');
    $this->widgetSchema['familiarcorporal_camisa'] = new sfWidgetFormChoice(array(
        'choices' => $tallas, 
        'multiple' => false, 
        'expanded' => false        
    ));
 
    $this->widgetSchema['familiarcorporal_pantalon'] = new sfWidgetFormChoice(array(
        'choices' => $tallas, 
        'multiple' => false, 
        'expanded' => false        
    ));    
    
    $tallaGorra = array('S/M' => 'S/M (circunferencia 54cm a 57cm)','M/L'=> 'M/L (circunferencia 57cm a 60cm)','L/XL'=> 'L/XL (circunferencia 60cm a 62cm)');
    $this->widgetSchema['familiarcorporal_gorra'] = new sfWidgetFormChoice(array(
        'choices' => $tallaGorra, 
        'multiple' => false, 
        'expanded' => false        
    ));
    
    
   
    if ($familiarcorporal!=""){
        $this->widgetSchema['corporal_color_ojos']  ->setDefault($familiarcorporal->getColorOjos()); 
        $this->widgetSchema['corporal_color_cabello']  ->setDefault($familiarcorporal->getColorCabello()); 
        $this->widgetSchema['corporal_color_piel']  ->setDefault($familiarcorporal->getColorPiel());
        $this->widgetSchema['familiarcorporal_camisa']  ->setDefault($familiarcorporal->getTallaCamisa()); 
        $this->widgetSchema['familiarcorporal_pantalon']->setDefault($familiarcorporal->getTallaPantalon());
        $this->widgetSchema['familiarcorporal_gorra']   ->setDefault($familiarcorporal->getTallaGorra()); 
    }
      
    
    
  }
}
