<?php

/**
 * Archivo_Expediente form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Archivo_ExpedienteForm extends BaseArchivo_ExpedienteForm
{
  public function configure()
  {
    unset($this['unidad_id'],$this['expediente_modelo_id'],$this['porcentaje_ocupado']);
  }
}
