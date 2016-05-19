<?php

/**
 * Seguridad_Ingreso filter form.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Seguridad_IngresoFormFilter extends BaseSeguridad_IngresoFormFilter
{
  public function configure()
  {
      unset($this['n_pase']);
      $this->widgetSchema['funcionario_id'] = new sfWidgetFormDoctrineJQueryAutocompleter(array(
            'url'    => $_SERVER['SCRIPT_NAME'].'/'.sfContext::getInstance()->getModuleName()."/getFuncionarios",
            'model' => "Funcionarios_Funcionario",
            'config' => '{
                     scrollHeight: 450 ,
                     autoFill: false }'
        ),array('size'=>40, 'maxlength' => 60)); 
      $this->validatorSchema['funcionario_id'] = new sfValidatorString(array('max_length' => 100,'required' => false),
                                                               array('max_length' => 'introduzca maximo 100 caracteres',
                                                                   'required'=>'Campo requerido'));
        
      $this->widgetSchema['persona_id'] = new sfWidgetFormDoctrineJQueryAutocompleter(array(
            'url'    => $_SERVER['SCRIPT_NAME'].'/'.sfContext::getInstance()->getModuleName()."/getPersonas",
            'model' => "Seguridad_Persona",
            'config' => '{
                     scrollHeight: 450 ,
                     autoFill: false }'
        ),array('size'=>40, 'maxlength' => 60)); 
      $this->validatorSchema['persona_id'] = new sfValidatorString(array('max_length' => 100,'required' => false),
                                                               array('max_length' => 'introduzca maximo 100 caracteres',
                                                                   'required'=>'Campo requerido'));
      
      //Campo created_at
      $years = range(date('Y'), date('Y')-1 );
      $this->widgetSchema['f_ingreso'] = new sfWidgetFormFilterDate(array(
                 'from_date' =>new sfWidgetFormI18nDate(array('years' => array_combine($years, $years),
                                            'format' => '%day% %month% %year%',
                                            'culture' => 'es',
                                            'empty_values' => array('day' => '<- Día ->', 'month' => '<- Mes ->', 'year' => '<- Año ->'),
                                     )),
                 'to_date' => new sfWidgetFormI18nDate(array('years' => array_combine($years, $years),
                                            'format' => '%day% %month% %year%',
                                            'culture' => 'es',
                                            'empty_values' => array('day' => '<- Día ->', 'month' => '<- Mes ->', 'year' => '<- Año ->'),
                                     )),
                 'with_empty' => 0,                   // Para que no salga el checkbox
                 'template' => 'desde : %from_date% <br>hasta :&nbsp; %to_date%'
                ));
    
      $this->widgetSchema['f_egreso'] = new sfWidgetFormFilterDate(array(
                 'from_date' =>new sfWidgetFormI18nDate(array('years' => array_combine($years, $years),
                                            'format' => '%day% %month% %year%',
                                            'culture' => 'es',
                                            'empty_values' => array('day' => '<- Día ->', 'month' => '<- Mes ->', 'year' => '<- Año ->'),
                                     )),
                 'to_date' => new sfWidgetFormI18nDate(array('years' => array_combine($years, $years),
                                            'format' => '%day% %month% %year%',
                                            'culture' => 'es',
                                            'empty_values' => array('day' => '<- Día ->', 'month' => '<- Mes ->', 'year' => '<- Año ->'),
                                     )),
                 'with_empty' => 1,                   // Para que no salga el checkbox
                 'template' => 'desde : %from_date% <br>hasta :&nbsp; %to_date%'
                ));
      
      $this->widgetSchema['unidad_id'] = new sfWidgetFormChoice(array(
            'choices'  => Doctrine::getTable('Organigrama_Unidad')->combounidad(),
            'expanded' => false, 'multiple' => false
          ));
      
      $this->widgetSchema->setLabels(array(
  	'f_ingreso'=>'Fecha de Ingreso :',
        'f_egreso'=>'Fecha de Egreso :',
        'motivo_id'=>'Motivo de la visita :',  
        'persona_id' => 'Visitante :',
        'funcionario_id' => 'Funcionario :',
	));
  }
}
