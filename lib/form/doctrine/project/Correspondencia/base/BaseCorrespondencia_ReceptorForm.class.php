<?php

/**
 * Correspondencia_Receptor form base class.
 *
 * @method Correspondencia_Receptor getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_ReceptorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                            => new sfWidgetFormInputHidden(),
      'correspondencia_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'), 'add_empty' => false)),
      'unidad_id'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => false)),
      'cargo_id'                      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Cargo'), 'add_empty' => true)),
      'funcionario_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'f_recepcion'                   => new sfWidgetFormDateTime(),
      'copia'                         => new sfWidgetFormInputText(),
      'establecido'                   => new sfWidgetFormInputText(),
      'respuesta_correspondencia_ids' => new sfWidgetFormTextarea(),
      'privado'                       => new sfWidgetFormInputText(),
      'id_update'                     => new sfWidgetFormInputText(),
      'created_at'                    => new sfWidgetFormDateTime(),
      'updated_at'                    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'correspondencia_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'))),
      'unidad_id'                     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'))),
      'cargo_id'                      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Cargo'), 'required' => false)),
      'funcionario_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'f_recepcion'                   => new sfValidatorDateTime(array('required' => false)),
      'copia'                         => new sfValidatorString(array('max_length' => 1)),
      'establecido'                   => new sfValidatorString(array('max_length' => 1)),
      'respuesta_correspondencia_ids' => new sfValidatorString(array('required' => false)),
      'privado'                       => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'id_update'                     => new sfValidatorInteger(),
      'created_at'                    => new sfValidatorDateTime(),
      'updated_at'                    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_receptor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_Receptor';
  }

}
