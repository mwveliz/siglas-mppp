<?php

/**
 * Correspondencia_AnexoFisico form.
 *
 * @package    sigla-(institution)
 * @subpackage form
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Correspondencia_AnexoFisicoForm extends BaseCorrespondencia_AnexoFisicoForm
{
  public function configure()
  {
     $this->setValidators(array(
          'id'                 => new sfValidatorInteger(array('required' => false)),
          'correspondencia_id' => new sfValidatorInteger(array('required' => false)),
          'tipo_anexo_fisico_id' => new sfValidatorInteger(array('required' => true)),
          'observacion'    => new sfValidatorString(array('required' => false)),
     ));
  }
}
