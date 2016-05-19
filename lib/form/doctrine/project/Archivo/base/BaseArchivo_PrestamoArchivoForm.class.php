<?php

/**
 * Archivo_PrestamoArchivo form base class.
 *
 * @method Archivo_PrestamoArchivo getObject() Returns the current form's model object
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArchivo_PrestamoArchivoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                            => new sfWidgetFormInputHidden(),
      'correspondencia_solicitud_id'  => new sfWidgetFormInputText(),
      'unidad_id'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'), 'add_empty' => false)),
      'funcionario_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'), 'add_empty' => false)),
      'expediente_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Expediente'), 'add_empty' => false)),
      'documentos_ids'                => new sfWidgetFormTextarea(),
      'f_expiracion'                  => new sfWidgetFormDate(),
      'f_entrega_fisico'              => new sfWidgetFormDateTime(),
      'receptor_entrega_fisico_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioReceptorEntregaFisico'), 'add_empty' => true)),
      'codigo_prestamo_fisico'        => new sfWidgetFormInputText(),
      'reentrega_fisico'              => new sfWidgetFormInputCheckbox(),
      'f_devolucion_fisico'           => new sfWidgetFormDateTime(),
      'receptor_devolucion_fisico_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioReceptorDevolucionFisico'), 'add_empty' => true)),
      'digital'                       => new sfWidgetFormInputCheckbox(),
      'fisico'                        => new sfWidgetFormInputCheckbox(),
      'status'                        => new sfWidgetFormInputText(),
      'id_update'                     => new sfWidgetFormInputText(),
      'ip_update'                     => new sfWidgetFormInputText(),
      'created_at'                    => new sfWidgetFormDateTime(),
      'updated_at'                    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'correspondencia_solicitud_id'  => new sfValidatorInteger(array('required' => false)),
      'unidad_id'                     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organigrama_Unidad'))),
      'funcionario_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_Funcionario'))),
      'expediente_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Archivo_Expediente'))),
      'documentos_ids'                => new sfValidatorString(),
      'f_expiracion'                  => new sfValidatorDate(),
      'f_entrega_fisico'              => new sfValidatorDateTime(array('required' => false)),
      'receptor_entrega_fisico_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioReceptorEntregaFisico'), 'required' => false)),
      'codigo_prestamo_fisico'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'reentrega_fisico'              => new sfValidatorBoolean(array('required' => false)),
      'f_devolucion_fisico'           => new sfValidatorDateTime(array('required' => false)),
      'receptor_devolucion_fisico_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Funcionarios_FuncionarioReceptorDevolucionFisico'), 'required' => false)),
      'digital'                       => new sfValidatorBoolean(),
      'fisico'                        => new sfValidatorBoolean(),
      'status'                        => new sfValidatorString(array('max_length' => 1)),
      'id_update'                     => new sfValidatorInteger(),
      'ip_update'                     => new sfValidatorString(array('max_length' => 50)),
      'created_at'                    => new sfValidatorDateTime(),
      'updated_at'                    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('archivo_prestamo_archivo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo_PrestamoArchivo';
  }

}
