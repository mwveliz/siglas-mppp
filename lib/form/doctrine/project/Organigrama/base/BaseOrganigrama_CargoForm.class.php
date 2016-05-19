<?php

/**
 * Organigrama_Cargo form base class.
 *
 * @method Organigrama_Cargo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrganigrama_CargoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'unidad_funcional_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_UnidadFuncional'), 'add_empty' => false)),
      'unidad_administrativa_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_UnidadAdministrativa'), 'add_empty' => false)),
      'padre_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Cargo'), 'add_empty' => true)),
      'codigo_nomina'            => new sfWidgetFormInputText(),
      'cargo_tipo_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoTipo'), 'add_empty' => false)),
      'cargo_condicion_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoCondicion'), 'add_empty' => false)),
      'cargo_grado_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoGrado'), 'add_empty' => false)),
      'descripcion'              => new sfWidgetFormTextarea(),
      'f_ingreso'                => new sfWidgetFormDate(),
      'f_retiro'                 => new sfWidgetFormDate(),
      'motivo_retiro'            => new sfWidgetFormInputText(),
      'perfil_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_Perfil'), 'add_empty' => true)),
      'status'                   => new sfWidgetFormInputText(),
      'id_update'                => new sfWidgetFormInputText(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'unidad_funcional_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_UnidadFuncional'))),
      'unidad_administrativa_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_UnidadAdministrativa'))),
      'padre_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Cargo'), 'required' => false)),
      'codigo_nomina'            => new sfValidatorInteger(array('required' => false)),
      'cargo_tipo_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoTipo'))),
      'cargo_condicion_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoCondicion'))),
      'cargo_grado_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_CargoGrado'))),
      'descripcion'              => new sfValidatorString(array('required' => false)),
      'f_ingreso'                => new sfValidatorDate(),
      'f_retiro'                 => new sfValidatorDate(array('required' => false)),
      'motivo_retiro'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'perfil_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Acceso_Perfil'), 'required' => false)),
      'status'                   => new sfValidatorString(array('max_length' => 1)),
      'id_update'                => new sfValidatorInteger(),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('organigrama_cargo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organigrama_Cargo';
  }

}
