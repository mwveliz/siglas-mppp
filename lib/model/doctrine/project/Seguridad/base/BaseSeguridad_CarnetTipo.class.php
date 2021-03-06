<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Seguridad_CarnetTipo', 'doctrine');

/**
 * BaseSeguridad_CarnetTipo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property string $status
 * @property integer $id_create
 * @property integer $id_update
 * @property string $ip_update
 * @property Doctrine_Collection $Seguridad_CarnetDiseno
 * 
 * @method integer              getId()                     Returns the current record's "id" value
 * @method string               getNombre()                 Returns the current record's "nombre" value
 * @method string               getStatus()                 Returns the current record's "status" value
 * @method integer              getIdCreate()               Returns the current record's "id_create" value
 * @method integer              getIdUpdate()               Returns the current record's "id_update" value
 * @method string               getIpUpdate()               Returns the current record's "ip_update" value
 * @method Doctrine_Collection  getSeguridadCarnetDiseno()  Returns the current record's "Seguridad_CarnetDiseno" collection
 * @method Seguridad_CarnetTipo setId()                     Sets the current record's "id" value
 * @method Seguridad_CarnetTipo setNombre()                 Sets the current record's "nombre" value
 * @method Seguridad_CarnetTipo setStatus()                 Sets the current record's "status" value
 * @method Seguridad_CarnetTipo setIdCreate()               Sets the current record's "id_create" value
 * @method Seguridad_CarnetTipo setIdUpdate()               Sets the current record's "id_update" value
 * @method Seguridad_CarnetTipo setIpUpdate()               Sets the current record's "ip_update" value
 * @method Seguridad_CarnetTipo setSeguridadCarnetDiseno()  Sets the current record's "Seguridad_CarnetDiseno" collection
 * 
 * @package    siglas
 * @subpackage model
 * @author     Livio Lopez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSeguridad_CarnetTipo extends BaseDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('seguridad.carnet_tipo');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'seguridad.carnet_tipo_id',
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('status', 'string', 1, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('id_create', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_update', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('ip_update', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Seguridad_CarnetDiseno', array(
             'local' => 'id',
             'foreign' => 'carnet_tipo_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}