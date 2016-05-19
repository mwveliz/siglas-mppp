<?php

/**
 * Archivo_TipologiaDocumental form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Archivo_TipologiaDocumentalForm extends BaseArchivo_TipologiaDocumentalForm
{
  public function configure()
  {
    unset($this['serie_documental_id']);
  }
}
