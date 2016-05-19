<?php

/**
 * Funcionarios_FamiliarDiscapacidad form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Funcionarios_FamiliarDiscapacidadForm extends BaseFuncionarios_FamiliarDiscapacidadForm
{
  public function configure()
  {    
         
    $this->widgetSchema['discapacidad_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'     => 'Public_Discapacidad',
        'add_empty' => 'Seleccione tipo',
    ));  
   
  }
}
