<?php

/**
 * Funcionarios_EducacionAdicional form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Funcionarios_EducacionAdicionalForm extends BaseFuncionarios_EducacionAdicionalForm
{
 public function configure()
  {
      
    $this->widgetSchema['pais_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'     => 'Public_Pais',
        'add_empty' => 'Seleccione pais',
        'default'   => '239',
    ));   
    
    $this->widgetSchema['tipo_educacion_adicional_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'     => 'Public_TipoEducacionAdicional',
        'add_empty' => 'Seleccione tipo',
    ));  
    
    $this->widgetSchema['organismo_educativo_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'     => 'Organismos_Organismo',
        'table_method' => 'getOrganismoEducativos',
        'add_empty' => 'Seleccione organismo',
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
            
     echo sfContext::getInstance()->getUser()->getAttribute('eduadicional_accion');
    
    if (sfContext::getInstance()->getUser()->getAttribute('eduadicional_accion')=='editar'){
        $eduadicional = Doctrine::getTable('Funcionarios_EducacionAdicional')->findOneById(sfContext::getInstance()->getUser()->getAttribute('eduadicional_id'));
        if ($eduadicional!="") {
           
            $this->widgetSchema['pais_id']->setDefault($eduadicional->getPaisId());
            $this->widgetSchema['organismo_educativo_id']->setDefault($eduadicional->getOrganismoEducativoId());
            $this->widgetSchema['nombre']->setDefault($eduadicional->getNombre());
            $this->widgetSchema['tipo_educacion_adicional_id']->setDefault($eduadicional->getTipoEducacionAdicionalId());
            $this->widgetSchema['f_ingreso']->setDefault($eduadicional->getFIngreso());
        }
     } else {
         $eduadicional = "";
     }  
  }
}
