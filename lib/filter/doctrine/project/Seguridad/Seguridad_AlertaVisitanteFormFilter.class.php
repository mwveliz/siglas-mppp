<?php

/**
 * Seguridad_AlertaVisitante filter form.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Seguridad_AlertaVisitanteFormFilter extends BaseSeguridad_AlertaVisitanteFormFilter
{
  public function configure()
  {
    $this->widgetSchema['status'] = new sfWidgetFormChoice(array(
                'choices' => Doctrine::getTable('Seguridad_AlertaVisitante')->getStatus(),
                'multiple' => false, 'expanded' => false,
            ),array('name'=>'seguridad_alerta_visitante_filters[status][text]',));
  }
}
