<?php

/**
 * Public_Sitio filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePublic_SitioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sitio_tipo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Public_SitioTipo'), 'add_empty' => true)),
      'latitud'       => new sfWidgetFormFilterInput(),
      'longitud'      => new sfWidgetFormFilterInput(),
      'nombre'        => new sfWidgetFormFilterInput(),
      'status'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'direccion'     => new sfWidgetFormFilterInput(),
      'mostrar'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'color'         => new sfWidgetFormFilterInput(),
      'id_update'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_create'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_create'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'sitio_tipo_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Public_SitioTipo'), 'column' => 'id')),
      'latitud'       => new sfValidatorPass(array('required' => false)),
      'longitud'      => new sfValidatorPass(array('required' => false)),
      'nombre'        => new sfValidatorPass(array('required' => false)),
      'status'        => new sfValidatorPass(array('required' => false)),
      'direccion'     => new sfValidatorPass(array('required' => false)),
      'mostrar'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'color'         => new sfValidatorPass(array('required' => false)),
      'id_update'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_create'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'     => new sfValidatorPass(array('required' => false)),
      'ip_create'     => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('public_sitio_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Public_Sitio';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'sitio_tipo_id' => 'ForeignKey',
      'latitud'       => 'Text',
      'longitud'      => 'Text',
      'nombre'        => 'Text',
      'status'        => 'Text',
      'direccion'     => 'Text',
      'mostrar'       => 'Boolean',
      'color'         => 'Text',
      'id_update'     => 'Number',
      'id_create'     => 'Number',
      'ip_update'     => 'Text',
      'ip_create'     => 'Text',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
