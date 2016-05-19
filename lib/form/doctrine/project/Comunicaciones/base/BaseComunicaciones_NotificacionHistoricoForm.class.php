<?php

/**
 * Comunicaciones_NotificacionHistorico form base class.
 *
 * @method Comunicaciones_NotificacionHistorico getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseComunicaciones_NotificacionHistoricoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'funcionario_id' => new sfWidgetFormInputText(),
      'aplicacion_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_Aplicacion'), 'add_empty' => false)),
      'forma_entrega'  => new sfWidgetFormInputText(),
      'metodo_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Comunicaciones_Metodo'), 'add_empty' => false)),
      'f_entrega'      => new sfWidgetFormDateTime(),
      'parametros'     => new sfWidgetFormTextarea(),
      'mensaje'        => new sfWidgetFormTextarea(),
      'status'         => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'id_update'      => new sfWidgetFormInputText(),
      'ip_update'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'funcionario_id' => new sfValidatorInteger(),
      'aplicacion_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_Aplicacion'))),
      'forma_entrega'  => new sfValidatorString(array('max_length' => 15)),
      'metodo_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Comunicaciones_Metodo'))),
      'f_entrega'      => new sfValidatorDateTime(),
      'parametros'     => new sfValidatorString(array('required' => false)),
      'mensaje'        => new sfValidatorString(),
      'status'         => new sfValidatorString(array('max_length' => 1)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
      'id_update'      => new sfValidatorInteger(),
      'ip_update'      => new sfValidatorString(array('max_length' => 30)),
    ));

    $this->widgetSchema->setNameFormat('comunicaciones_notificacion_historico[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comunicaciones_NotificacionHistorico';
  }

}
