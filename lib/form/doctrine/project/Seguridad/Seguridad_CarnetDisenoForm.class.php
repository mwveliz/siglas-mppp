<?php

/**
 * Seguridad_CarnetDiseno form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Seguridad_CarnetDisenoForm extends BaseSeguridad_CarnetDisenoForm
{
  public function configure()
  {
        $this->setWidget('imagen_fondo', new sfWidgetFormInputFileEditable(array(
            'file_src' => '<a href="/uploads/carnet/' . $this->getObject()->getImagenFondo() . '">' . $this->getObject()->getImagenFondo() . '</a>',
            'is_image' => false,
            'template' => '<div>%file%<br/>%input%</div>',
        )));
  }
}
