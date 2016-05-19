<?php

/**
 * Funcionarios_FuncionarioCargo form.
 *
 * @package    sigla-(institution)
 * @subpackage form
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Funcionarios_FuncionarioCargoForm extends BaseFuncionarios_FuncionarioCargoForm
{
  public function configure()
  {
     unset($this['funcionario_id']);

//    $this->widgetSchema['unidad_funcional_id'] = new sfWidgetFormChoice(array(
//      'choices'  => Doctrine::getTable('Organigrama_Unidad')->combounidad(),
//      'expanded' => false, 'multiple' => false
//    ));

//    $this->widgetSchema['cargo_id'] = new sfWidgetFormDoctrineDependentSelect(array(
//        'model'     => 'Organigrama_Cargo',
//        'depends'   => 'unidad_funcional_id',
//        'add_empty' => 'Seleccione el Cargo',
//        'table_method' => 'cargosVacios',
//    ));

    $years = range(1980, date('Y'));
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

    $years = range(1980, date('Y'));
    $this->widgetSchema['f_retiro'] = new sfWidgetFormJQueryDate(array(
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
    
    $this->widgetSchema['motivo_retiro'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine::getTable('Funcionarios_FuncionarioCargo')->getMotivoRetiro(),
      'multiple' => false, 'expanded' => false
    ));
  }
}
