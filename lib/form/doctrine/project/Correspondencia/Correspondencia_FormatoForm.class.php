<?php

/**
 * Correspondencia_Formato form.
 *
 * @package    sigla-(institution)
 * @subpackage form
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Correspondencia_FormatoForm extends BaseCorrespondencia_FormatoForm
{
  public function configure()
  {
     $this->setValidators(array(
          'id'                 => new sfValidatorInteger(array('required' => false)),
          'correspondencia_id' => new sfValidatorInteger(array('required' => false)),
          'tipo_formato_id' => new sfValidatorInteger(array('required' => true)),
          'campo_uno'           => new sfValidatorString(array('required' => false)),
          'campo_dos'           => new sfValidatorString(array('required' => false)),
          'campo_tres'          => new sfValidatorString(array('required' => false)),
          'campo_cuatro'        => new sfValidatorString(array('required' => false)),
          'campo_cinco'         => new sfValidatorString(array('required' => false)),
          'campo_seis'          => new sfValidatorString(array('required' => false)),
          'campo_siete'         => new sfValidatorString(array('required' => false)),
          'campo_ocho'          => new sfValidatorString(array('required' => false)),
          'campo_nueve'         => new sfValidatorString(array('required' => false)),
          'campo_diez'          => new sfValidatorString(array('required' => false)),
          'campo_once'          => new sfValidatorString(array('required' => false)),
          'campo_doce'          => new sfValidatorString(array('required' => false)),
          'campo_trece'         => new sfValidatorString(array('required' => false)),
          'campo_catorce'       => new sfValidatorString(array('required' => false)),
          'campo_quince'        => new sfValidatorString(array('required' => false)),
     ));
  }
}
