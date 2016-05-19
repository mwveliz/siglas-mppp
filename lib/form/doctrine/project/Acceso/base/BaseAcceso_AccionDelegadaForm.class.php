<?php

/**
 * Acceso_AccionDelegada form base class.
 *
 * @method Acceso_AccionDelegada getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAcceso_AccionDelegadaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'usuario_delega_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_UsuarioDelega'), 'add_empty' => false)),
      'usuario_delegado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_UsuarioDelegado'), 'add_empty' => false)),
      'f_expiracion'        => new sfWidgetFormDate(),
      'accion'              => new sfWidgetFormInputText(),
      'parametros'          => new sfWidgetFormTextarea(),
      'status'              => new sfWidgetFormInputText(),
      'id_update'           => new sfWidgetFormInputText(),
      'ip_update'           => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'usuario_delega_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_UsuarioDelega'))),
      'usuario_delegado_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_UsuarioDelegado'))),
      'f_expiracion'        => new sfValidatorDate(array('required' => false)),
      'accion'              => new sfValidatorString(array('max_length' => 255)),
      'parametros'          => new sfValidatorString(array('required' => false)),
      'status'              => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'id_update'           => new sfValidatorInteger(),
      'ip_update'           => new sfValidatorString(array('max_length' => 50)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('acceso_accion_delegada[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Acceso_AccionDelegada';
  }

}
