<?php

/**
 * Organigrama_CargoTipo form base class.
 *
 * @method Organigrama_CargoTipo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrganigrama_CargoTipoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                           => new sfWidgetFormInputHidden(),
      'nombre'                       => new sfWidgetFormInputText(),
      'descripcion'                  => new sfWidgetFormTextarea(),
      'principal'                    => new sfWidgetFormInputCheckbox(),
      'status'                       => new sfWidgetFormInputText(),
      'id_update'                    => new sfWidgetFormInputText(),
      'cargo_condicion_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoCondicion'), 'add_empty' => true)),
      'masculino'                    => new sfWidgetFormInputText(),
      'femenino'                     => new sfWidgetFormInputText(),
      'orden'                        => new sfWidgetFormInputText(),
      'created_at'                   => new sfWidgetFormDateTime(),
      'updated_at'                   => new sfWidgetFormDateTime(),
      'organigrama_cargo_grado_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Organigrama_CargoGrado')),
    ));

    $this->setValidators(array(
      'id'                           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'nombre'                       => new sfValidatorString(array('max_length' => 255)),
      'descripcion'                  => new sfValidatorString(),
      'principal'                    => new sfValidatorBoolean(),
      'status'                       => new sfValidatorString(array('max_length' => 1)),
      'id_update'                    => new sfValidatorInteger(),
      'cargo_condicion_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoCondicion'), 'required' => false)),
      'masculino'                    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'femenino'                     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'orden'                        => new sfValidatorInteger(array('required' => false)),
      'created_at'                   => new sfValidatorDateTime(),
      'updated_at'                   => new sfValidatorDateTime(),
      'organigrama_cargo_grado_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Organigrama_CargoGrado', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('organigrama_cargo_tipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organigrama_CargoTipo';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['organigrama_cargo_grado_list']))
    {
      $this->setDefault('organigrama_cargo_grado_list', $this->object->Organigrama_CargoGrado->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveOrganigrama_CargoGradoList($con);

    parent::doSave($con);
  }

  public function saveOrganigrama_CargoGradoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['organigrama_cargo_grado_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Organigrama_CargoGrado->getPrimaryKeys();
    $values = $this->getValue('organigrama_cargo_grado_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Organigrama_CargoGrado', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Organigrama_CargoGrado', array_values($link));
    }
  }

}
