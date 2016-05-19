<?php

/**
 * Archivo_Documento filter form.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Archivo_DocumentoFormFilter extends BaseArchivo_DocumentoFormFilter
{
    public function insensitiveSearch($word,$type='basic') {
        $herramientas = new herramientas();
        return $herramientas->insensitiveSearch($word, $type);
    }
    
    public function addContenidoAutomaticoColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $a = $query->getRootAlias();
            $query->andWhere($a . ".contenido_automatico ~* ?", $this->insensitiveSearch($values['text']));
        }
    }
    
    public function addNombreOriginalColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $a = $query->getRootAlias();
            $query->andWhere($a . ".nombre_original ~* ?", $this->insensitiveSearch($values['text']));
        }
    }
}
