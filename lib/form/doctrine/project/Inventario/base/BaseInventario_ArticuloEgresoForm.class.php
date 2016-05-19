<?php

/**
 * Inventario_ArticuloEgreso form base class.
 *
 * @method Inventario_ArticuloEgreso getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInventario_ArticuloEgresoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                            => new sfWidgetFormInputHidden(),
      'correspondencia_solicitud_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_CorrespondenciaSolicitud'), 'add_empty' => false)),
      'correspondencia_aprobacion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_CorrespondenciaAprobacion'), 'add_empty' => false)),
      'unidad_id'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => false)),
      'inventario_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Inventario_Inventario'), 'add_empty' => false)),
      'articulo_id'                   => new sfWidgetFormInputText(),
      'cantidad'                      => new sfWidgetFormInputText(),
      'f_egreso'                      => new sfWidgetFormDate(),
      'status'                        => new sfWidgetFormInputText(),
      'id_update'                     => new sfWidgetFormInputText(),
      'ip_update'                     => new sfWidgetFormInputText(),
      'created_at'                    => new sfWidgetFormDateTime(),
      'updated_at'                    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'correspondencia_solicitud_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_CorrespondenciaSolicitud'))),
      'correspondencia_aprobacion_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_CorrespondenciaAprobacion'))),
      'unidad_id'                     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'))),
      'inventario_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Inventario_Inventario'))),
      'articulo_id'                   => new sfValidatorInteger(),
      'cantidad'                      => new sfValidatorNumber(),
      'f_egreso'                      => new sfValidatorDate(array('required' => false)),
      'status'                        => new sfValidatorString(array('max_length' => 1)),
      'id_update'                     => new sfValidatorInteger(),
      'ip_update'                     => new sfValidatorString(array('max_length' => 50)),
      'created_at'                    => new sfValidatorDateTime(),
      'updated_at'                    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('inventario_articulo_egreso[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Inventario_ArticuloEgreso';
  }

}
