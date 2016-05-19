<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Correspondencia_AnexoFisico', 'doctrine');

/**
 * BaseCorrespondencia_AnexoFisico
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $correspondencia_id
 * @property integer $tipo_anexo_fisico_id
 * @property string $observacion
 * @property integer $id_update
 * @property Correspondencia_Correspondencia $Correspondencia_Correspondencia
 * @property Correspondencia_TipoAnexoFisico $Correspondencia_TipoAnexoFisico
 * 
 * @method integer                         getId()                              Returns the current record's "id" value
 * @method integer                         getCorrespondenciaId()               Returns the current record's "correspondencia_id" value
 * @method integer                         getTipoAnexoFisicoId()               Returns the current record's "tipo_anexo_fisico_id" value
 * @method string                          getObservacion()                     Returns the current record's "observacion" value
 * @method integer                         getIdUpdate()                        Returns the current record's "id_update" value
 * @method Correspondencia_Correspondencia getCorrespondenciaCorrespondencia()  Returns the current record's "Correspondencia_Correspondencia" value
 * @method Correspondencia_TipoAnexoFisico getCorrespondenciaTipoAnexoFisico()  Returns the current record's "Correspondencia_TipoAnexoFisico" value
 * @method Correspondencia_AnexoFisico     setId()                              Sets the current record's "id" value
 * @method Correspondencia_AnexoFisico     setCorrespondenciaId()               Sets the current record's "correspondencia_id" value
 * @method Correspondencia_AnexoFisico     setTipoAnexoFisicoId()               Sets the current record's "tipo_anexo_fisico_id" value
 * @method Correspondencia_AnexoFisico     setObservacion()                     Sets the current record's "observacion" value
 * @method Correspondencia_AnexoFisico     setIdUpdate()                        Sets the current record's "id_update" value
 * @method Correspondencia_AnexoFisico     setCorrespondenciaCorrespondencia()  Sets the current record's "Correspondencia_Correspondencia" value
 * @method Correspondencia_AnexoFisico     setCorrespondenciaTipoAnexoFisico()  Sets the current record's "Correspondencia_TipoAnexoFisico" value
 * 
 * @package    siglas
 * @subpackage model
 * @author     Livio Lopez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCorrespondencia_AnexoFisico extends BaseDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('correspondencia.anexo_fisico');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'correspondencia.anexo_fisico_id',
             'length' => 4,
             ));
        $this->hasColumn('correspondencia_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('tipo_anexo_fisico_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('observacion', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('id_update', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Correspondencia_Correspondencia', array(
             'local' => 'correspondencia_id',
             'foreign' => 'id'));

        $this->hasOne('Correspondencia_TipoAnexoFisico', array(
             'local' => 'tipo_anexo_fisico_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}