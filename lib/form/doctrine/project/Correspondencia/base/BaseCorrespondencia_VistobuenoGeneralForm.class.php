<?php

/**
 * Correspondencia_VistobuenoGeneral form base class.
 *
 * @method Correspondencia_VistobuenoGeneral getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_VistobuenoGeneralForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                           => new sfWidgetFormInputHidden(),
      'vistobueno_general_config_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_VistobuenoGeneralConfig'), 'add_empty' => false)),
      'funcionario_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'funcionario_cargo_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Cargo'), 'add_empty' => false)),
      'orden'                        => new sfWidgetFormInputText(),
      'status'                       => new sfWidgetFormInputText(),
      'id_update'                    => new sfWidgetFormInputText(),
      'id_create'                    => new sfWidgetFormInputText(),
      'ip_update'                    => new sfWidgetFormInputText(),
      'ip_create'                    => new sfWidgetFormInputText(),
      'created_at'                   => new sfWidgetFormDateTime(),
      'updated_at'                   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'vistobueno_general_config_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_VistobuenoGeneralConfig'))),
      'funcionario_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'funcionario_cargo_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Cargo'))),
      'orden'                        => new sfValidatorInteger(),
      'status'                       => new sfValidatorString(array('max_length' => 1)),
      'id_update'                    => new sfValidatorInteger(),
      'id_create'                    => new sfValidatorInteger(),
      'ip_update'                    => new sfValidatorString(array('max_length' => 50)),
      'ip_create'                    => new sfValidatorString(array('max_length' => 50)),
      'created_at'                   => new sfValidatorDateTime(),
      'updated_at'                   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_vistobueno_general[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_VistobuenoGeneral';
  }

}
