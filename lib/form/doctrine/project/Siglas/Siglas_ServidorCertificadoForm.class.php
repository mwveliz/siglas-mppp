<?php

/**
 * Siglas_ServidorCertificado form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Siglas_ServidorCertificadoForm extends BaseSiglas_ServidorCertificadoForm
{
  public function configure()
  {
      unset($this['puerta'],$this['so'],$this['agente'],$this['pc']);
  }
}
