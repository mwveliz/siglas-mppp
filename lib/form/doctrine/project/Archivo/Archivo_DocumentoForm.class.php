<?php

/**
 * Archivo_Documento form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Archivo_DocumentoForm extends BaseArchivo_DocumentoForm
{
  public function configure()
  {
        unset($this['expediente_id'],$this['correlativo'],$this['unidad_id'],$this['unidad_correlativos_id'],
                $this['nombre_original'],$this['ruta'],$this['tipo_archivo'],$this['contenido_automatico'],
                $this['usuario_validador_id'],$this['correspondencia_id']
                );

        $mime_types = array
            (
            'application/pdf',
            'application/x-pdf',
            'image/bmp',
            'image/jpeg',
            'image/gif',
            'image/pjpeg',
            'image/x-png',
        );
      
        $this->setWidget('ruta', new sfWidgetFormInputFileEditable(array(
            'file_src' => '<a href="/uploads/archivo/' . $this->getObject()->getRuta() . '">' . $this->getObject()->getNombreOriginal() . '</a>',
            'is_image' => false,
            'template' => '<div>%file%<br/>%input%</div>',
        )));

        $this->setValidator('ruta', new sfValidatorFile(array(
            'mime_types' => $mime_types,
            'path' => sfConfig::get('sf_upload_dir') . '/archivo/',
            'required' => false,
        )));
  }
}
