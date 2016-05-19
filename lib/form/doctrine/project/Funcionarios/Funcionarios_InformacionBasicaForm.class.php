<?php

/**
 * Funcionarios_InformacionBasica form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Funcionarios_InformacionBasicaForm extends BaseFuncionarios_InformacionBasicaForm
{
  public function configure()
  {
    $basica = Doctrine::getTable('Funcionarios_InformacionBasica')->findOneByFuncionarioIdAndStatus(sfContext::getInstance()->getUser()->getAttribute('funcionario_id'),'A');
      
    $edo_civil = array('s' => 'Soltero(a)','c'=> 'Casado(a)','v'=> 'Viudo(a)','d'=> 'Divorciado(a)');
    $this->widgetSchema['basica_estado_civil'] = new sfWidgetFormChoice(array(
        'choices' => $edo_civil, 
        'multiple' => false, 
        'expanded' => false        
    ));      
      
    $sexo = array('m' => 'Masculino','f'=> 'Femenino');
    $this->widgetSchema['basica_sexo'] = new sfWidgetFormChoice(array(
        'choices' => $sexo, 
        'multiple' => false, 
        'expanded' => false
    ));
                 
    $this->widgetSchema['basica_estado_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'     => 'Public_Estado',
        'add_empty' => 'Seleccione estado',

    ));  
           
    $years = range(date('Y')-100, date('Y'));
    $this->widgetSchema['basica_f_nacimiento'] = new sfWidgetFormJQueryDate(array(
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
     
    $licencias = array('' => 'N/A','1' => '1','2' => '2','3' => '3','4' => '4','5' => '5');
    $this->widgetSchema['lincencia_uno'] = new sfWidgetFormChoice(array(
        'choices' => $licencias, 
        'multiple' => false, 
        'expanded' => false
    ));
    
    $this->widgetSchema['lincencia_dos'] = new sfWidgetFormChoice(array(
        'choices' => $licencias, 
        'multiple' => false, 
        'expanded' => false
    ));
    
     if ($basica!=""){
        $this->widgetSchema['basica_estado_civil']->setDefault($basica->getEdoCivil());
        $this->widgetSchema['basica_sexo']->setDefault($basica->getSexo()); 
        $this->widgetSchema['basica_estado_id']->setDefault($basica->getEstadoNacimientoId());
        $this->widgetSchema['basica_f_nacimiento']->setDefault($basica->getFNacimiento());
        $this->widgetSchema['lincencia_uno']->setDefault($basica->getLicenciaConducirUnoGrado());
        $this->widgetSchema['lincencia_dos']->setDefault($basica->getLicenciaConducirDosGrado());
         
         
     }
  }
}
