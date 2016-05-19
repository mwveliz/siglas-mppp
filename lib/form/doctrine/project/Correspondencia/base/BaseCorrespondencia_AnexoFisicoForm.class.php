<?php

/**
 * Correspondencia_AnexoFisico form base class.
 *
 * @method Correspondencia_AnexoFisico getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondencia_AnexoFisicoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'correspondencia_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'), 'add_empty' => false)),
      'tipo_anexo_fisico_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_TipoAnexoFisico'), 'add_empty' => false)),
      'observacion'          => new sfWidgetFormTextarea(),
      'id_update'            => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'correspondencia_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_Correspondencia'))),
      'tipo_anexo_fisico_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondencia_TipoAnexoFisico'))),
      'observacion'          => new sfValidatorString(array('required' => false)),
      'id_update'            => new sfValidatorInteger(),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondencia_anexo_fisico[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondencia_AnexoFisico';
  }

}
