<?php

/**
 * Funcionarios_Residencia form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Funcionarios_ResidenciaForm extends BaseFuncionarios_ResidenciaForm
{
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
    echo sfContext::getInstance()->getUser()->getAttribute('residencia_accion');
    
    if (sfContext::getInstance()->getUser()->getAttribute('residencia_accion')=='editar'){
        $residencia = Doctrine::getTable('Funcionarios_Residencia')->findOneById(sfContext::getInstance()->getUser()->getAttribute('res_id'));
        if ($residencia!="") {
            $this->widgetSchema['estado_id']->setDefault($residencia->getEstadoId());
            $this->widgetSchema['municipio_id']->setDefault($residencia->getMunicipioId());
            $this->widgetSchema['parroquia_id']->setDefault($residencia->getParroquiaId());
        }
     } else {
         $residencia = "";
     }           
  }
}
