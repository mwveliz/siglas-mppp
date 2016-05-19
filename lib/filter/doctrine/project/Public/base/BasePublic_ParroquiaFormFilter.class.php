<?php

/**
 * Public_Parroquia filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePublic_ParroquiaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'municipio_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_Municipio'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'       => new sfValidatorPass(array('required' => false)),
      'municipio_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Public_Municipio'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('public_parroquia_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_Parroquia';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Text',
      'nombre'       => 'Text',
      'municipio_id' => 'ForeignKey',
    );
  }
}
