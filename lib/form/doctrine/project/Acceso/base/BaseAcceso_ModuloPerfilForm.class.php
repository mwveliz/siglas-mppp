<?php

/**
 * Acceso_ModuloPerfil form base class.
 *
 * @method Acceso_ModuloPerfil getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAcceso_ModuloPerfilForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'perfil_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_Perfil'), 'add_empty' => false)),
      'modulo_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_Modulo'), 'add_empty' => false)),
      'status'     => new sfWidgetFormInputText(),
      'id_update'  => new sfWidgetFormInputText(),
      'id'         => new sfWidgetFormInputHidden(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'perfil_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_Perfil'))),
      'modulo_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_Modulo'))),
      'status'     => new sfValidatorString(array('max_length' => 1)),
      'id_update'  => new sfValidatorInteger(),
      'id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('acceso_modulo_perfil[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Acceso_ModuloPerfil';
  }

}
