<?php

/**
 * Funcionarios_EducacionUniversitaria form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Funcionarios_EducacionUniversitariaForm extends BaseFuncionarios_EducacionUniversitariaForm
{
  public function configure()
  {
      
    $this->widgetSchema['pais_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'     => 'Public_Pais',
        'add_empty' => 'Seleccione pais',
        'default'   => '239',
    )); 

    $this->widgetSchema['organismo_educativo_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'     => 'Organismos_Organismo',
        'table_method' => 'getOrganismoEducativos',
        'add_empty' => 'Seleccione organismo',
    ));
    
    $this->widgetSchema['carrera_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'     => 'Public_CarreraUniversitaria',
        'add_empty' => 'Seleccione carrera',
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
    
    $segmento = range(0, 12);
    $this->widgetSchema['segmento'] = new sfWidgetFormChoice(array(
        'choices' => $segmento, 
        'multiple' => false, 
        'expanded' => false
    ));
    
     echo sfContext::getInstance()->getUser()->getAttribute('eduuniversitaria_accion');
    
    if (sfContext::getInstance()->getUser()->getAttribute('eduuniversitaria_accion')=='editar'){
        $eduuniversitaria = Doctrine::getTable('Funcionarios_EducacionUniversitaria')->findOneById(sfContext::getInstance()->getUser()->getAttribute('eduuniversitaria_id'));
        if ($eduuniversitaria!="") {
           
            $this->widgetSchema['pais_id']->setDefault($eduuniversitaria->getPaisId());
            $this->widgetSchema['organismo_educativo_id']->setDefault($eduuniversitaria->getOrganismoEducativoId());
            $this->widgetSchema['carrera_id']->setDefault($eduuniversitaria->getCarreraId());
            $this->widgetSchema['nivel_academico_id']->setDefault($eduuniversitaria->getNivelAcademicoId());
            $this->widgetSchema['f_ingreso']->setDefault($eduuniversitaria->getFIngreso());
            $this->widgetSchema['f_graduado']->setDefault($eduuniversitaria->getFGraduado());
             if ($eduuniversitaria->getEstudiandoActualmente() != 1){ $this->widgetSchema['estudiando_actualmente']->setDefault(0);}
            
            $this->widgetSchema['segmento']->setDefault($eduuniversitaria->getSegmento());
        }
     } else {
         $eduuniversitaria = "";
     }  
  }
}
