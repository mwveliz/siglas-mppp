<?php

/**
 * Funcionarios_EducacionMedia form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Funcionarios_EducacionMediaForm extends BaseFuncionarios_EducacionMediaForm
{
public function configure()
  {
      
    $this->widgetSchema['pais_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'     => 'Public_Pais',
        'add_empty' => 'Seleccione pais',
        'default'   => '239',
    )); 

    $especialidad = array('0' => 'Seleccione','1' => 'Ciencias','2'=> 'Humanidades', '3' => 'Tecnico medio');
    $this->widgetSchema['especialidad'] = new sfWidgetFormChoice(array(
        'choices' => $especialidad, 
        'multiple' => false, 
        'expanded' => false
    ));
    
    $this->widgetSchema['organismo_educativo_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'     => 'Organismos_Organismo',
        'table_method' => 'getOrganismoEducativos',
        'add_empty' => 'Seleccione organismo',
    ));       
    
    $this->widgetSchema['nivel_academico_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'     => 'Public_NivelAcademico',
        'add_empty' => 'Seleccione nivel',
    )); 
    
    $years = range(date('Y')-100, date('Y'));
    $this->widgetSchema['f_ingreso'] = new sfWidgetFormJQueryDate(array(
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
    $this->widgetSchema['f_graduado'] = new sfWidgetFormJQueryDate(array(
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
    
    
    $estudia = array('1' => 'Si','0'=> 'No');
    $this->widgetSchema['estudiando_actualmente'] = new sfWidgetFormChoice(array(
        'choices' => $estudia, 
        'multiple' => false, 
        'expanded' => false
    ));
    
    
     echo sfContext::getInstance()->getUser()->getAttribute('edumedia_accion');
    
    if (sfContext::getInstance()->getUser()->getAttribute('edumedia_accion')=='editar'){
        $edumedia = Doctrine::getTable('Funcionarios_EducacionMedia')->findOneById(sfContext::getInstance()->getUser()->getAttribute('edumedia_id'));
        if ($edumedia!="") {
           
            $this->widgetSchema['pais_id']->setDefault($edumedia->getPaisId());
            $this->widgetSchema['organismo_educativo_id']->setDefault($edumedia->getOrganismoEducativoId());
            $this->widgetSchema['especialidad']->setDefault($edumedia->getEspecialidad());
            $this->widgetSchema['nivel_academico_id']->setDefault($edumedia->getNivelAcademicoId());
            $this->widgetSchema['f_ingreso']->setDefault($edumedia->getFIngreso());
            $this->widgetSchema['f_graduado']->setDefault($edumedia->getFGraduado());
             if ($edumedia->getEstudiandoActualmente() != 1){ $this->widgetSchema['estudiando_actualmente']->setDefault(0);}            
        }
     } else {
         $edumedia = "";
     }  
  }
}
