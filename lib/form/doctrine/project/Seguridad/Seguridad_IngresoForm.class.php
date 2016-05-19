<?php

/**
 * Seguridad_Ingreso form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Seguridad_IngresoForm extends BaseSeguridad_IngresoForm
{
  public function configure()
  {
      if(sfContext::getInstance()->getActionName()=== 'processIngreso' OR sfContext::getInstance()->getActionName()=== 'index' OR sfContext::getInstance()->getActionName()=== 'new' OR sfContext::getInstance()->getActionName() === 'create'){
        $this->widgetSchema['imagen'] = new sfWidgetFormInputHidden(array('label' => 'Fotografia :',), array());
        $this->widgetSchema['persona_id'] = new sfWidgetFormInputHidden(array('label' => 'Visitante :',), array());
        $this->validatorSchema['persona_id'] = new sfValidatorString(array('max_length' => 20,'required' => true),
                                                                 array('max_length' => 'introduzca maximo 20 caracteres',
                                                                     'required'=>'Campo requerido'));
        unset($this['f_egreso']);
        unset($this['persona_visita']);
        
        $this->widgetSchema['piso_id'] = new sfWidgetFormDoctrineChoice(array(
              'model'     => 'Organigrama_Unidad',
              'add_empty' => '<- Seleccione ->',
              'table_method'=>'getPisos',
              'label' => 'Pisos :',
              ));

        $this->validatorSchema['piso_id'] = new sfValidatorDoctrineChoice(array(
                  'model' => 'Organigrama_Unidad',
                  'column' => 'dir_piso',
                  'required' => true
              ),array('required'=>'Campo requerido'));

        $this->widgetSchema['unidad_id'] = new sfWidgetFormArrayDependentSelect(array(
                  'callable' => array('Organigrama_UnidadTable', 'getUnidadByPiso'),
                  'depends' => 'piso_id',
                  'add_empty' => false,
                  'label' => 'Unidades / Oficinas :',
              ));
        $this->validatorSchema['unidad_id'] = new sfValidatorDoctrineChoice(array(
            'model' => 'Organigrama_Unidad',
            'column' => 'id',
            'required' => true
        ),array('required'=>'Campo requerido'));
        
       $this->widgetSchema['funcionario_id'] = new sfWidgetFormArrayDependentSelect(array(
                  'callable' => array('Funcionarios_FuncionarioTable', 'getFuncionarioByUnidad'),
                  'depends' => 'unidad_id',
                  'add_empty' => false,
                  'label' => 'Funcionarios :',
              ));
        $this->validatorSchema['funcionario_id'] = new sfValidatorDoctrineChoice(array(
            'model' => 'Funcionarios_Funcionario',
            'column' => 'id',
            'required' => true
        ),array('required'=>'Campo requerido'));
        
        $this->widgetSchema['llave_ingreso_id'] = new sfWidgetFormDoctrineJQueryAutocompleter(array(
            'url'    => $_SERVER['SCRIPT_NAME'].'/'.sfContext::getInstance()->getModuleName()."/getNPases",
            'model' => "Seguridad_LlaveIngreso",
            'config' => '{
                     scrollHeight: 450 ,
                     autoFill: true }'
        ),array('size'=>10, 'maxlength' => 4)); 
        
        $this->validatorSchema['llave_ingreso_id'] = new sfValidatorString(array('max_length' => 4,'required' => true),
                                                               array('max_length' => 'El numero de pase es de maximo 4 numeros',
                                                                   'required'=>'Campo requerido'));
        
        $this->widgetSchema['llave_ingreso_x'] = new sfWidgetFormDoctrineJQueryAutocompleter(array(
            'url'    => $_SERVER['SCRIPT_NAME'].'/'.sfContext::getInstance()->getModuleName()."/getNPases",
            'model' => "Seguridad_LlaveIngreso",
            'config' => '{
                     scrollHeight: 450 ,
                     autoFill: true }'
        ),array('size'=>10, 'maxlength' => 4)); 
        
        $this->validatorSchema['llave_ingreso_x'] = new sfValidatorString(array('max_length' => 4,'required' => true),
                                                               array('max_length' => 'El numero de pase es de maximo 4 numeros',
                                                                   'required'=>'Campo requerido'));
        
        /*$this->widgetSchema['persona_visita'] = new sfWidgetFormInputText(array('label'=>'Persona que visita :'),array('size'=>40, 'maxlength' => 60));
        $this->validatorSchema['persona_visita'] = new sfValidatorString(array('max_length' => 60,'required' => true),
                                                                 array('max_length' => 'introduzca maximo 60 caracteres',
                                                                     'required'=>'Campo requerido'));*/
        
        $this->widgetSchema['motivo_visita'] = new sfWidgetFormTextarea(array('label'=>'Motivo de visita'),array('cols'=>38, 'rows' => 4));
        $this->validatorSchema['motivo_visita'] = new sfValidatorString(array('required' => false),
                                                               array('required'=>'Campo requerido'));
        
        //ingreso de equipos
        $this->widgetSchema['marca_id'] = new sfWidgetFormDoctrineChoice(array(
            'model'     => 'Seguridad_Marca',
            'add_empty' => '<- Seleccione marca ->',
            'method' => 'getDescripcion',
            'label' => 'Marca del equipo',
        ));
        
        $this->validatorSchema['marca_id'] = new sfValidatorDoctrineChoice(array(
            'model' => 'Seguridad_Marca',
            'column' => 'id',
            'required' => false
        ),array('required'=>'Campo requerido'));
        
        $this->widgetSchema['tipo_id'] = new sfWidgetFormDoctrineChoice(array(
            'model'     => 'Seguridad_Tipo',
            'add_empty' => '<- Seleccione tipo ->',
            'method' => 'getDescripcion',
            'label' => 'Tipo de equipo',
        ));
        
        $this->validatorSchema['tipo_id'] = new sfValidatorDoctrineChoice(array(
            'model' => 'Seguridad_Tipo',
            'column' => 'id',
            'required' => false
        ),array('required'=>'Campo requerido'));
        
        $this->widgetSchema['serial'] = new sfWidgetFormInputText(array('label'=>'Serial del equipo'),array('size'=>60, 'maxlength' => 60));
        $this->validatorSchema['serial'] = new sfValidatorString(array('max_length' => 60,'required' => false),
                                                                 array('max_length' => 'introduzca maximo 60 caracteres',
                                                                     'required'=>'Campo requerido'));
        
        $this->widgetSchema['list_funcionario'] = new sfWidgetFormDoctrineJQueryAutocompleter(array(
            'url'    => $_SERVER['SCRIPT_NAME'].'/'.sfContext::getInstance()->getModuleName()."/getFuncionarios",
            'model' => "Funcionarios_Funcionario",
            'config' => '{
                     scrollHeight: 450 ,
                     autoFill: false }'
        ),array('size'=>40, 'maxlength' => 60)); 
        $this->validatorSchema['list_funcionario'] = new sfValidatorString(array('max_length' => 100,'required' => false),
                                                               array('max_length' => 'introduzca maximo 100 caracteres',
                                                                   'required'=>'Campo requerido'));
        
      }
      
      if(sfContext::getInstance()->getActionName()=== 'edit' OR sfContext::getInstance()->getActionName() === 'update'){  
          $this->widgetSchema['persona_id'] = new sfWidgetFormInputHidden(array(), array());
          $this->widgetSchema['imagen'] = new sfWidgetFormInputHidden(array(), array());
          $this->widgetSchema['piso_id'] = new sfWidgetFormInputHidden(array(), array());
          $this->widgetSchema['unidad_id'] = new sfWidgetFormInputHidden(array(), array());
          $this->widgetSchema['llave_ingreso_id'] = new sfWidgetFormInputHidden(array(), array());
          $this->widgetSchema['f_ingreso'] = new sfWidgetFormInputHidden(array(), array());
          $this->widgetSchema['persona_visita'] = new sfWidgetFormInputHidden(array(), array());
          $this->widgetSchema['motivo_visita'] = new sfWidgetFormInputHidden(array(), array());
      }
      
      $this->widgetSchema->setLabels(array(
          
  	'f_ingreso'=>'Fecha y hora de ingreso',
        'f_egreso'=>'Egreso',
        'motivo_id'=>'Motivo de la visita',  
        'motivo_visita'=>'Detalles de la visita',  
	)); 
         
  }
}
