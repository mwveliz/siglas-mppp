<?php

/**
 * Funcionarios_Funcionario filter form.
 *
 * @package    sigla-(institution)
 * @subpackage filter
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Funcionarios_FuncionarioFormFilter extends BaseFuncionarios_FuncionarioFormFilter
{
    public function insensitiveSearch($word,$type='basic') {
        $herramientas = new herramientas();
        return $herramientas->insensitiveSearch($word, $type);
    }
    
    public function configure()
    {

    }
  
    public function addPrimerNombreColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $values['text'] = $this->insensitiveSearch(trim($values['text']));
            $a = $query->getRootAlias();
            $query->andWhere($a . ".primer_nombre ~* ?", $values['text']);
        }
    }
    
    public function addSegundoNombreColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $values['text'] = $this->insensitiveSearch(trim($values['text']));
            $a = $query->getRootAlias();
            $query->andWhere($a . ".segundo_nombre ~* ?", $values['text']);
        }
    }
    
    public function addPrimerApellidoColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $values['text'] = $this->insensitiveSearch(trim($values['text']));
            $a = $query->getRootAlias();
            $query->andWhere($a . ".primer_apellido ~* ?", $values['text']);
        }
    }
    
    public function addSegundoApellidoColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $values['text'] = $this->insensitiveSearch(trim($values['text']));
            $a = $query->getRootAlias();
            $query->andWhere($a . ".segundo_apellido ~* ?", $values['text']);
        }
    }
}