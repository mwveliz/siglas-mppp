<?php

/**
 * Siglas_ServiciosPublicados form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Siglas_ServiciosPublicadosForm extends BaseSiglas_ServiciosPublicadosForm
{
  public function configure()
  {
    unset($this['puerta'],$this['so'],$this['agente'],$this['pc']);
      
    $this->widgetSchema['url'] = new sfWidgetFormInputText(array(),array('size'=>'90')); 
    
      
    $mime_types = array(
//        'application/x-gzip',
        'application/zip',
//        'application/x-zip-compressed',
//        'multipart/x-zip',
    );
        
    $this->setWidget('recursos', new sfWidgetFormInputFileEditable(array(
            'label'     => 'Recursos:',
            'file_src'  => '<a href="/uploads/interoperabilidad/recursos_internos/'.$this->getObject()->getRecursos().'">'.$this->getObject()->getRecursos().'</a>',
            'is_image'  => false,

            'template'  => '<div>%file%<br/>%input%</div>',)));

    $this->setValidator('recursos', new sfValidatorFile(
            array(
                'mime_types' => $mime_types,
                'path' => sfConfig::get('sf_upload_dir').'/interoperabilidad/recursos_internos',
                'required' => true),
            array(
                'mime_types' => 'Solo se permiten archivos .zip'
            )));
  }
}
