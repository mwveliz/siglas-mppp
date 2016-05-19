<?php

/**
 * Archivo_PrestamoArchivo filter form base class.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArchivo_PrestamoArchivoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'correspondencia_solicitud_id'  => new sfWidgetFormFilterInput(),
      'unidad_id'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => true)),
      'funcionario_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => true)),
      'expediente_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Expediente'), 'add_empty' => true)),
      'documentos_ids'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'f_expiracion'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'f_entrega_fisico'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'receptor_entrega_fisico_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioReceptorEntregaFisico'), 'add_empty' => true)),
      'codigo_prestamo_fisico'        => new sfWidgetFormFilterInput(),
      'reentrega_fisico'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'f_devolucion_fisico'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'receptor_devolucion_fisico_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioReceptorDevolucionFisico'), 'add_empty' => true)),
      'digital'                       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fisico'                        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'status'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_update'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_update'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'correspondencia_solicitud_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'unidad_id'                     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organigrama_Unidad'), 'column' => 'id')),
      'funcionario_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'column' => 'id')),
      'expediente_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Archivo_Expediente'), 'column' => 'id')),
      'documentos_ids'                => new sfValidatorPass(array('required' => false)),
      'f_expiracion'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'f_entrega_fisico'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'receptor_entrega_fisico_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_FuncionarioReceptorEntregaFisico'), 'column' => 'id')),
      'codigo_prestamo_fisico'        => new sfValidatorPass(array('required' => false)),
      'reentrega_fisico'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'f_devolucion_fisico'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'receptor_devolucion_fisico_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Funcionarios_FuncionarioReceptorDevolucionFisico'), 'column' => 'id')),
      'digital'                       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fisico'                        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'status'                        => new sfValidatorPass(array('required' => false)),
      'id_update'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_update'                     => new sfValidatorPass(array('required' => false)),
      'created_at'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('archivo_prestamo_archivo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_PrestamoArchivo';
  }

  public function getFields()
  {
    return array(
      'id'                            => 'Number',
      'correspondencia_solicitud_id'  => 'Number',
      'unidad_id'                     => 'ForeignKey',
      'funcionario_id'                => 'ForeignKey',
      'expediente_id'                 => 'ForeignKey',
      'documentos_ids'                => 'Text',
      'f_expiracion'                  => 'Date',
      'f_entrega_fisico'              => 'Date',
      'receptor_entrega_fisico_id'    => 'ForeignKey',
      'codigo_prestamo_fisico'        => 'Text',
      'reentrega_fisico'              => 'Boolean',
      'f_devolucion_fisico'           => 'Date',
      'receptor_devolucion_fisico_id' => 'ForeignKey',
      'digital'                       => 'Boolean',
      'fisico'                        => 'Boolean',
      'status'                        => 'Text',
      'id_update'                     => 'Number',
      'ip_update'                     => 'Text',
      'created_at'                    => 'Date',
      'updated_at'                    => 'Date',
    );
  }
}
