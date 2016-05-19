<?php

/**
 * Acceso_Usuario form base class.
 *
 * @method Acceso_Usuario getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAcceso_UsuarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'usuario_enlace_id' => new sfWidgetFormInputText(),
      'enlace_id'         => new sfWidgetFormInputText(),
      'nombre'            => new sfWidgetFormInputText(),
      'ldap'              => new sfWidgetFormInputText(),
      'clave'             => new sfWidgetFormInputText(),
      'clave_temporal'    => new sfWidgetFormInputText(),
      'visitas'           => new sfWidgetFormInputText(),
      'ultimaconexion'    => new sfWidgetFormDateTime(),
      'ultimo_status'     => new sfWidgetFormDateTime(),
      'ultimocambioclave' => new sfWidgetFormDateTime(),
      'tema'              => new sfWidgetFormInputText(),
      'acceso_global'     => new sfWidgetFormInputCheckbox(),
      'status'            => new sfWidgetFormInputText(),
      'id_update'         => new sfWidgetFormInputText(),
      'ip_update'         => new sfWidgetFormInputText(),
      'ip'                => new sfWidgetFormTextarea(),
      'pc'                => new sfWidgetFormTextarea(),
      'puerta'            => new sfWidgetFormTextarea(),
      'so'                => new sfWidgetFormTextarea(),
      'agente'            => new sfWidgetFormTextarea(),
      'variables_entorno' => new sfWidgetFormTextarea(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'usuario_enlace_id' => new sfValidatorInteger(),
      'enlace_id'         => new sfValidatorInteger(),
      'nombre'            => new sfValidatorString(array('max_length' => 255)),
      'ldap'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'clave'             => new sfValidatorString(array('max_length' => 255)),
      'clave_temporal'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'visitas'           => new sfValidatorInteger(),
      'ultimaconexion'    => new sfValidatorDateTime(),
      'ultimo_status'     => new sfValidatorDateTime(array('required' => false)),
      'ultimocambioclave' => new sfValidatorDateTime(),
      'tema'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'acceso_global'     => new sfValidatorBoolean(),
      'status'            => new sfValidatorString(array('max_length' => 1)),
      'id_update'         => new sfValidatorInteger(),
      'ip_update'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ip'                => new sfValidatorString(array('required' => false)),
      'pc'                => new sfValidatorString(array('required' => false)),
      'puerta'            => new sfValidatorString(array('required' => false)),
      'so'                => new sfValidatorString(array('required' => false)),
      'agente'            => new sfValidatorString(array('required' => false)),
      'variables_entorno' => new sfValidatorString(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('acceso_usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Acceso_Usuario';
  }

}
