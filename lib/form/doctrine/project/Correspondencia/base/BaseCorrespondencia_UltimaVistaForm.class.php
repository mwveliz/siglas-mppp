<?php

/**
 * Correspondencia_UltimaVista form base class.
 *
 * @method Correspondencia_UltimaVista getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_UltimaVistaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'funcionario_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'correspondencia_enviada_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_UltimaVistaEnviada'), 'add_empty' => true)),
      'correspondencia_recibida_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_UltimaVistaRecibida'), 'add_empty' => true)),
      'correspondencia_externa_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_UltimaVistaExterna'), 'add_empty' => true)),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'funcionario_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'correspondencia_enviada_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_UltimaVistaEnviada'), 'required' => false)),
      'correspondencia_recibida_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_UltimaVistaRecibida'), 'required' => false)),
      'correspondencia_externa_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_UltimaVistaExterna'), 'required' => false)),
      'created_at'                  => new sfValidatorDateTime(),
      'updated_at'                  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_ultima_vista[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_UltimaVista';
  }

}
