<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Comunicaciones_Operador', 'doctrine');

/**
 * BaseComunicaciones_Operador
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property string $apn
 * @property string $status
 * @property integer $id_update
 * @property integer $id_create
 * @property string $ip_update
 * @property string $ip_create
 * @property Doctrine_Collection $Vehiculos_GpsVehiculo
 * 
 * @method integer                 getId()                    Returns the current record's "id" value
 * @method string                  getNombre()                Returns the current record's "nombre" value
 * @method string                  getApn()                   Returns the current record's "apn" value
 * @method string                  getStatus()                Returns the current record's "status" value
 * @method integer                 getIdUpdate()              Returns the current record's "id_update" value
 * @method integer                 getIdCreate()              Returns the current record's "id_create" value
 * @method string                  getIpUpdate()              Returns the current record's "ip_update" value
 * @method string                  getIpCreate()              Returns the current record's "ip_create" value
 * @method Doctrine_Collection     getVehiculosGpsVehiculo()  Returns the current record's "Vehiculos_GpsVehiculo" collection
 * @method Comunicaciones_Operador setId()                    Sets the current record's "id" value
 * @method Comunicaciones_Operador setNombre()                Sets the current record's "nombre" value
 * @method Comunicaciones_Operador setApn()                   Sets the current record's "apn" value
 * @method Comunicaciones_Operador setStatus()                Sets the current record's "status" value
 * @method Comunicaciones_Operador setIdUpdate()              Sets the current record's "id_update" value
 * @method Comunicaciones_Operador setIdCreate()              Sets the current record's "id_create" value
 * @method Comunicaciones_Operador setIpUpdate()              Sets the current record's "ip_update" value
 * @method Comunicaciones_Operador setIpCreate()              Sets the current record's "ip_create" value
 * @method Comunicaciones_Operador setVehiculosGpsVehiculo()  Sets the current record's "Vehiculos_GpsVehiculo" collection
 * 
 * @package    siglas
 * @subpackage model
 * @author     Livio Lopez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseComunicaciones_Operador extends BaseDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('comunicaciones.operador');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'comunicaciones.operador_id',
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('apn', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('status', 'string', 1, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('id_update', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_create', 'integer', 4, array(
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
             'notnull' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('ip_create', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Vehiculos_GpsVehiculo', array(
             'local' => 'id',
             'foreign' => 'operador_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}