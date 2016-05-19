<?php

/**
 * Archivo_Documento form base class.
 *
 * @method Archivo_Documento getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArchivo_DocumentoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'unidad_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => true)),
      'expediente_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Expediente'), 'add_empty' => true)),
      'correspondencia_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'), 'add_empty' => true)),
      'correlativo'             => new sfWidgetFormInputText(),
      'unidad_correlativos_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_UnidadCorrelativos'), 'add_empty' => true)),
      'tipologia_documental_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_TipologiaDocumental'), 'add_empty' => false)),
      'copia_fisica'            => new sfWidgetFormInputCheckbox(),
      'copia_digital'           => new sfWidgetFormInputCheckbox(),
      'contenido_automatico'    => new sfWidgetFormTextarea(),
      'ruta'                    => new sfWidgetFormTextarea(),
      'nombre_original'         => new sfWidgetFormTextarea(),
      'tipo_archivo'            => new sfWidgetFormInputText(),
      'usuario_validador_id'    => new sfWidgetFormInputText(),
      'status'                  => new sfWidgetFormInputText(),
      'id_update'               => new sfWidgetFormInputText(),
      'ip_update'               => new sfWidgetFormTextarea(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'unidad_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'required' => false)),
      'expediente_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Expediente'), 'required' => false)),
      'correspondencia_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'), 'required' => false)),
      'correlativo'             => new sfValidatorString(array('max_length' => 255)),
      'unidad_correlativos_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_UnidadCorrelativos'), 'required' => false)),
      'tipologia_documental_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_TipologiaDocumental'))),
      'copia_fisica'            => new sfValidatorBoolean(),
      'copia_digital'           => new sfValidatorBoolean(),
      'contenido_automatico'    => new sfValidatorString(array('required' => false)),
      'ruta'                    => new sfValidatorString(array('required' => false)),
      'nombre_original'         => new sfValidatorString(array('required' => false)),
      'tipo_archivo'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'usuario_validador_id'    => new sfValidatorInteger(),
      'status'                  => new sfValidatorString(array('max_length' => 1)),
      'id_update'               => new sfValidatorInteger(),
      'ip_update'               => new sfValidatorString(),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('archivo_documento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_Documento';
  }

}
