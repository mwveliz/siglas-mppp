<?php

/**
 * Funcionarios_Familiar form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Funcionarios_FamiliarForm extends BaseFuncionarios_FamiliarForm
{
  public function configure()
  {
    $this->widgetSchema['parentesco_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'     => 'Public_Parentesco',
        'add_empty' => 'Seleccione parentesco',
    )); 
    
    $years = range(date('Y')-100, date('Y'));
    $this->widgetSchema['familiar_f_nacimiento'] = new sfWidgetFormJQueryDate(array(
        'image' => '/images/icon/calendar.png',
        'culture' => 'es',
        'config' => '{changeYear: true, yearRange: \'c-100:c+100\'}',
        'date_widget' => new sfWidgetFormI18nDate(array(
                        'format' => '%day%-%month%-%year%',
                        'culture'=>'es',
                        'empty_values' => array('day'=>'<- Día ->',
                        'month'=>'<- Mes ->',
                        'year'=>'<- Año ->'),
                        'years' => array_combine($years, $years)))
    ));
    
    $sexo = array('' => 'Seleccione', 'm' => 'Masculino','f'=> 'Femenino');
    $this->widgetSchema['familiar_sexo'] = new sfWidgetFormChoice(array(
        'choices' => $sexo, 
        'multiple' => false, 
        'expanded' => false
    ));
    
    $nacionalidad = array('v' => 'V','E'=> 'E');
    $this->widgetSchema['familiar_nacionalidad'] = new sfWidgetFormChoice(array(
        'choices' => $nacionalidad, 
        'multiple' => false, 
        'expanded' => false
    ));
    
    $this->widgetSchema['nivel_academico_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'     => 'Public_NivelAcademico',
        'add_empty' => 'Seleccione nivel',
    )); 
    
    $estudia = array('0' => 'No','1'=> 'Si');
    $this->widgetSchema['familiar_estudia'] = new sfWidgetFormChoice(array(
        'choices' => $estudia, 
        'multiple' => false, 
        'expanded' => false
    ));
    
    $trabaja = array('0' => 'No','1'=> 'Si');
    $this->widgetSchema['familiar_trabaja'] = new sfWidgetFormChoice(array(
        'choices' => $trabaja, 
        'multiple' => false, 
        'expanded' => false
    ));
    
    $depende = array('0' => 'No','1'=> 'Si');
    $this->widgetSchema['familiar_dependencia'] = new sfWidgetFormChoice(array(
        'choices' => $depende, 
        'multiple' => false, 
        'expanded' => false
    ));
    
     
    echo sfContext::getInstance()->getUser()->getAttribute('familiar_accion');
    
    if (sfContext::getInstance()->getUser()->getAttribute('familiar_accion')=='editar'){
        $familiar = Doctrine::getTable('Funcionarios_Familiar')->findOneById(sfContext::getInstance()->getUser()->getAttribute('familiar_id'));
        if ($familiar!="") {
            
            $this->widgetSchema['familiar_f_nacimiento']->setDefault($familiar->getFNacimiento());
            $this->widgetSchema['parentesco_id']->setDefault($familiar->getParentescoId());
            $this->widgetSchema['familiar_sexo']->setDefault($familiar->getSexo());
            $this->widgetSchema['nivel_academico_id']->setDefault($familiar->getNivelAcademicoId());
            $this->widgetSchema['familiar_estudia']->setDefault($familiar->getEstudia());
            $this->widgetSchema['familiar_trabaja']->setDefault($familiar->getTrabaja());
            $this->widgetSchema['familiar_dependencia']->setDefault($familiar->getDependencia());            
        }
     } else {
         $familiar = "";
     }  
  }
}
