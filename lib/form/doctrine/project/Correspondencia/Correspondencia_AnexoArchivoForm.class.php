<?php

/**
 * Correspondencia_AnexoArchivo form.
 *
 * @package    sigla-(institution)
 * @subpackage form
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Correspondencia_AnexoArchivoForm extends BaseCorrespondencia_AnexoArchivoForm {

    public function configure() {
        unset($this['correspondencia_id'], $this['nombre_original']);

        $mime_types = array
            (
            'application/excel',
            'application/vnd.ms-excel',
            'application/msword',
            'application/vnd.ms-powerpoint',
            'application/x-msexcel',
            'application/x-msword',
            'application/vnd.oasis.opendocument.text',
            'application/vnd.oasis.opendocument.formula',
            'application/vnd.oasis.opendocument.spreadsheet',
            'application/pdf',
            'application/x-pdf',
            'application/x-gtar',
            'application/x-gzip',
            'application/x-tar',
            'application/zip',
            'audio/mpeg',
            'image/bmp',
            'image/jpeg',
            'image/gif',
            'image/pjpeg',
            'image/x-png',
            'text/comma-separated-values',
            'video/mpeg',
            'video/x-msvideo',
        );

//        $this->widgetSchema['ruta'] = new
//                sfWidgetFormInputFileEditable(array(
//                    'file_src' => sfConfig::get('sf_upload_dir') . '/correspondencia/' . $this->getObject()->getId(),
//                    'is_image' => false,
//                    'edit_mode' => !$this->isNew(),
//                    'with_delete' => false,
//                ));
//        


//        $this->validatorSchema['ruta'] = new sfValidatorFile(
//                        array('required' => true,
//                            'mime_types' => $mime_types,
//                            'path' => sfConfig::get('sf_upload_dir') . '/correspondencia',),
//                        array('required' => 'Archivo requerido',
//                            'mime_types' => 'El archivo que intenta adjuntar es de un formato no autorizado'));

$this->setWidget('ruta', new sfWidgetFormInputFileEditable(array(
        'label'     => 'Ruta:',
        'file_src'  =>
'<a href="/uploads/correspondencia/'.$this->getObject()->getRuta().'">'.$this->getObject()->getNombreOriginal().'</a>',
        'is_image'  => false,

        'template'  =>
'<div>%file%<br/>%input%</div>',)));

//luego hago el validator
$this->setValidator('ruta', new sfValidatorFile(array(
        'mime_types' => $mime_types,
        'path' => sfConfig::get('sf_upload_dir').'/correspondencia',
        'required' => false,
     )));

//al final coloco una validacion para el tag de eliminar
// $this->validatorSchema['ruta_delete'] = new sfValidatorBoolean(); 


    }

}

