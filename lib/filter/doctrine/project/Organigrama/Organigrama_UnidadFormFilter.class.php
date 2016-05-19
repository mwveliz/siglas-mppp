<?php

/**
 * Organigrama_Unidad filter form.
 *
 * @package    sigla-(institution)
 * @subpackage filter
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Organigrama_UnidadFormFilter extends BaseOrganigrama_UnidadFormFilter
{
    public function insensitiveSearch($word,$type='basic') {
        $herramientas = new herramientas();
        return $herramientas->insensitiveSearch($word, $type);
    }
    
    public function configure() 
    {
    $this->widgetSchema['estado_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'     => 'Public_Estado',
        'add_empty' => 'Seleccione estado',
    ));
     $this->widgetSchema['municipio_id'] = new sfWidgetFormDoctrineDependentSelect(array(
        'model'     => 'Public_Municipio',
        'depends'   => 'Estado',
        'add_empty' => 'Seleccione municipio',
        'ajax'      => true,
    ));
    $this->widgetSchema['parroquia_id'] = new sfWidgetFormDoctrineDependentSelect(array(
        'model'     => 'Public_Parroquia',
        'depends'   => 'Municipio',
        'add_empty' => 'Seleccione Parroquia',
        'ajax'      => true,
    ));
    }
    
    public function addNombreColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $values['text'] = $this->insensitiveSearch($values['text']);
            $a = $query->getRootAlias();
            $query->andWhere($a . ".nombre ~* ?", $values['text']);
        }
    }
}
