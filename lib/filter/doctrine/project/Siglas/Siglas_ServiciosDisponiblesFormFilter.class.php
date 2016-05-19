<?php

/**
 * Siglas_ServiciosDisponibles filter form.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Siglas_ServiciosDisponiblesFormFilter extends BaseSiglas_ServiciosDisponiblesFormFilter
{
  public function configure()
  {
    $tipo = array('' => 'Todos','consulta' => 'Consulta','actualizacion'=> 'Actualización');
    $this->widgetSchema['tipo'] = new sfWidgetFormChoice(array(
        'choices' => $tipo, 
        'multiple' => false, 
        'expanded' => false,
    ));  
    
    $status = array('A' => 'Activas','I'=> 'Inactivas');
    $this->widgetSchema['status'] = new sfWidgetFormChoice(array(
        'choices' => $status, 
        'multiple' => false, 
        'expanded' => false,
    )); 
  }
  
    public function addTipoColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values != '') {
            $a = $query->getRootAlias();
            $query->andWhere($a . ".tipo = ?", $values);
        }
    }
    
    public function addStatusColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values != '') {
            $a = $query->getRootAlias();
            $query->andWhere($a . ".status = ?", $values);
        }
    }
}
