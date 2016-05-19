<?php

/**
 * Organigrama_CargoGrado form base class.
 *
 * @method Organigrama_CargoGrado getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrganigrama_CargoGradoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'nombre'                      => new sfWidgetFormInputText(),
      'siglas'                      => new sfWidgetFormInputText(),
      'orden'                       => new sfWidgetFormInputText(),
      'status'                      => new sfWidgetFormInputText(),
      'id_update'                   => new sfWidgetFormInputText(),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
      'organigrama_cargo_tipo_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Organigrama_CargoTipo')),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'nombre'                      => new sfValidatorString(array('max_length' => 255)),
      'siglas'                      => new sfValidatorString(array('max_length' => 50)),
      'orden'                       => new sfValidatorInteger(array('required' => false)),
      'status'                      => new sfValidatorString(array('max_length' => 1)),
      'id_update'                   => new sfValidatorInteger(),
      'created_at'                  => new sfValidatorDateTime(),
      'updated_at'                  => new sfValidatorDateTime(),
      'organigrama_cargo_tipo_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Organigrama_CargoTipo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('organigrama_cargo_grado[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organigrama_CargoGrado';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['organigrama_cargo_tipo_list']))
    {
      $this->setDefault('organigrama_cargo_tipo_list', $this->object->Organigrama_CargoTipo->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveOrganigrama_CargoTipoList($con);

    parent::doSave($con);
  }

  public function saveOrganigrama_CargoTipoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['organigrama_cargo_tipo_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Organigrama_CargoTipo->getPrimaryKeys();
    $values = $this->getValue('organigrama_cargo_tipo_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Organigrama_CargoTipo', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Organigrama_CargoTipo', array_values($link));
    }
  }

}
