<?php

/**
 * Public_MensajesGrupo form.
 *
 * @package    siglas-(institucion)
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Public_MensajesGrupoForm extends BasePublic_MensajesGrupoForm
{
  public function configure()
  {
    unset($this['funcionario_id']);
  }
}
