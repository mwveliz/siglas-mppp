<?php

/**
 * Project form base class.
 *
 * @package    sigla-(institution)
 * @subpackage form
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{
  public function setup()
  {
    unset($this['created_at'],$this['updated_at'],$this['id_create'],$this['id_update'],$this['ip_create'],$this['ip_update'],$this['status']);
  }
}
