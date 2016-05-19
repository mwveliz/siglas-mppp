<?php

/**
 * Funcionarios_InformacionCorporal form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Funcionarios_InformacionCorporalForm extends BaseFuncionarios_InformacionCorporalForm
{
  public function configure()
  {
    $corporal = Doctrine::getTable('Funcionarios_InformacionCorporal')->findOneByFuncionarioIdAndStatus(sfContext::getInstance()->getUser()->getAttribute('funcionario_id'),'A');  
    
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
    
    $tipo_sangre = array("O-" => "O-","O+"=> "O+","A-"=> "A-","A+"=> "A+","B-"=> "B-","B+"=> "B+","AB-"=> "AB-","AB+"=> "AB+");
    $this->widgetSchema['corporal_sangre'] = new sfWidgetFormChoice(array(
        'choices' => $tipo_sangre, 
        'multiple' => false, 
        'expanded' => false        
    ));  
    
    $tallas = array('XS' => 'XS (extra pequeña)','S'=> 'S (pequeña)','M'=> 'M (mediana)','L'=> 'L (grande)','XL'=> 'XL (extra grande)','XXL'=> 'XXL (extra grande doble)');
    $this->widgetSchema['corporal_camisa'] = new sfWidgetFormChoice(array(
        'choices' => $tallas, 
        'multiple' => false, 
        'expanded' => false        
    ));
 
    $this->widgetSchema['corporal_pantalon'] = new sfWidgetFormChoice(array(
        'choices' => $tallas, 
        'multiple' => false, 
        'expanded' => false        
    ));    
    
    $tallaGorra = array('S/M' => 'S/M (circunferencia 54cm a 57cm)','M/L'=> 'M/L (circunferencia 57cm a 60cm)','L/XL'=> 'L/XL (circunferencia 60cm a 62cm)');
    $this->widgetSchema['corporal_gorra'] = new sfWidgetFormChoice(array(
        'choices' => $tallaGorra, 
        'multiple' => false, 
        'expanded' => false        
    ));    
   
    if ($corporal!=""){
        $this->widgetSchema['corporal_color_ojos']  ->setDefault($corporal->getColorOjos()); 
        $this->widgetSchema['corporal_color_cabello']  ->setDefault($corporal->getColorCabello()); 
        $this->widgetSchema['corporal_color_piel']  ->setDefault($corporal->getColorPiel()); 
        $this->widgetSchema['corporal_sangre']  ->setDefault($corporal->getTipoSangre()); 
        $this->widgetSchema['corporal_camisa']  ->setDefault($corporal->getTallaCamisa()); 
        $this->widgetSchema['corporal_pantalon']->setDefault($corporal->getTallaPantalon());
        $this->widgetSchema['corporal_gorra']   ->setDefault($corporal->getTallaGorra()); 
    }
      
    
    
  }
}
