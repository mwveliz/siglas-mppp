<?php

/**
 * Public_MensajesParticipantes form.
 *
 * @package    siglas-(institucion)
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Public_MensajesParticipantesForm extends BasePublic_MensajesParticipantesForm
{
  public function configure()
  {
      unset($this['mensajes_grupo_id']);
  }
}
