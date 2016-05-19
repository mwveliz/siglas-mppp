<?php

/**
 * Archivo_FuncionarioUnidad form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Archivo_FuncionarioUnidadForm extends BaseArchivo_FuncionarioUnidadForm
{
  public function configure()
  {
        unset($this['permitido_funcionario']);
      
        $this->setValidator('autorizada_unidad_id', new sfValidatorInteger(array(
                'required' => false,
            )));
  }
}
