<?php

/**
 * Correspondencia_UnidadCorrelativo form.
 *
 * @package    sigla-(institution)
 * @subpackage form
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Correspondencia_UnidadCorrelativoForm extends BaseCorrespondencia_UnidadCorrelativoForm
{
  public function configure()
  {
      unset($this['descripcion']);

    $this->widgetSchema['nomenclador'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine::getTable('Correspondencia_UnidadCorrelativo')->getNomenclador(),
      'multiple' => false, 'expanded' => false
    ));
    
//    $this->validatorSchema->setPostValidator(
//            new sfValidatorDoctrineUnique(array('model' => 'Correspondencia_UnidadCorrelativo', 'column' => array('unidad_id')),
//            array('invalid' => 'Ya fue registrado el número de cedula') )
//    );
  }
}
