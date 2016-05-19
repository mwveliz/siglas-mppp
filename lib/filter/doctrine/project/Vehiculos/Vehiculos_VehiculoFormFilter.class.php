<?php

/**
 * Vehiculos_Vehiculo filter form.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Vehiculos_VehiculoFormFilter extends BaseVehiculos_VehiculoFormFilter
{
    public function insensitiveSearch($word,$type='basic') {
        $herramientas = new herramientas();
        return $herramientas->insensitiveSearch($word, $type);
    }
    
    public function configure()
    {
        $this->widgetSchema['serviciosPendientes'] = new sfWidgetFormInputCheckbox();
        
        $this->validatorSchema['serviciosPendientes'] = new sfValidatorPass(array('required' => false));
    }
  
    public function getFields() {
        return parent::getFields() + array(
            'serviciosPendientes' => 'Number',
        );
    }
    
    public function addKilometrajeActualColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        $valores= (is_array($values))? $values['text'] : $values;
        if ($valores != '' && is_numeric($valores)) {
            $a = $query->getRootAlias();
            $query->andWhere($a . ".kilometraje_actual ". $values['param'] ." ?", $valores);
        }
    }
    
    public function addServiciosPendientesColumnQuery(Doctrine_Query $query, $field, $values) {
        if($values['check'] == 'on' && count($values['list']) > 0) {
            $a = $query->getRootAlias();
            $query->innerJoin($a . '.Vehiculos_Mantenimiento m')
                    ->andWhereIn("m.mantenimiento_tipo_id", $values['list'])
                    ->andWhere('m.fecha <= ?', date("Y-m-d H:i:s", time()))
                    ->andWhere('m.status =?', 'A');
        }
    }
}
