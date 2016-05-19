<?php

/**
 * Correspondencia_FuncionarioUnidad form.
 *
 * @package    sigla-(institution)
 * @subpackage form
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Correspondencia_FuncionarioUnidadForm extends BaseCorrespondencia_FuncionarioUnidadForm {

    public function configure() {
        $this->setValidator('autorizada_unidad_id', new sfValidatorInteger(array(
                'required' => false,
            )));
        
        unset($this['permitido_funcionario']);
    }

}
