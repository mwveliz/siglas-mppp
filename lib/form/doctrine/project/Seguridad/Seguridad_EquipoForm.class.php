<?php

/**
 * Seguridad_Equipo form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Seguridad_EquipoForm extends BaseSeguridad_EquipoForm
{
  public function configure()
  {
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
  }
}
