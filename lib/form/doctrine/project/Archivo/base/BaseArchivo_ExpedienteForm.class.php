<?php

/**
 * Archivo_Expediente form base class.
 *
 * @method Archivo_Expediente getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArchivo_ExpedienteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'padre_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Expediente'), 'add_empty' => true)),
      'correlativo'            => new sfWidgetFormInputText(),
      'unidad_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => false)),
      'expediente_modelo_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_ExpedienteModelo'), 'add_empty' => false)),
      'unidad_correlativos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_UnidadCorrelativos'), 'add_empty' => true)),
      'estante_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Estante'), 'add_empty' => true)),
      'tramo'                  => new sfWidgetFormInputText(),
      'caja_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Caja'), 'add_empty' => true)),
      'serie_documental_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_SerieDocumental'), 'add_empty' => false)),
      'porcentaje_ocupado'     => new sfWidgetFormInputText(),
      'status'                 => new sfWidgetFormInputText(),
      'id_update'              => new sfWidgetFormInputText(),
      'ip_update'              => new sfWidgetFormTextarea(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'padre_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Expediente'), 'required' => false)),
      'correlativo'            => new sfValidatorString(array('max_length' => 255)),
      'unidad_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'))),
      'expediente_modelo_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_ExpedienteModelo'))),
      'unidad_correlativos_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_UnidadCorrelativos'), 'required' => false)),
      'estante_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Estante'), 'required' => false)),
      'tramo'                  => new sfValidatorInteger(array('required' => false)),
      'caja_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Caja'), 'required' => false)),
      'serie_documental_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_SerieDocumental'))),
      'porcentaje_ocupado'     => new sfValidatorInteger(),
      'status'                 => new sfValidatorString(array('max_length' => 1)),
      'id_update'              => new sfValidatorInteger(),
      'ip_update'              => new sfValidatorString(),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('archivo_expediente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_Expediente';
  }

}
