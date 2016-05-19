<?php

/**
 * Organigrama_CargoGradoTipo filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrganigrama_CargoGradoTipoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cargo_tipo_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoTipo'), 'add_empty' => true)),
      'cargo_grado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoGrado'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'cargo_tipo_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_CargoTipo'), 'column' => 'id')),
      'cargo_grado_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_CargoGrado'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('organigrama_cargo_grado_tipo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organigrama_CargoGradoTipo';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'cargo_tipo_id'  => 'ForeignKey',
      'cargo_grado_id' => 'ForeignKey',
    );
  }
}
