<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Vehiculos_Gps', 'doctrine');

/**
 * BaseVehiculos_Gps
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $marca
 * @property string $modelo
 * @property string $descripcion
 * @property boolean $mic
 * @property boolean $cam
 * @property boolean $sd
 * @property string $status
 * @property integer $id_update
 * @property integer $id_create
 * @property string $ip_update
 * @property string $ip_create
 * @property Doctrine_Collection $Vehiculos_Comando
 * @property Doctrine_Collection $Vehiculos_GpsVehiculo
 * 
 * @method integer             getId()                    Returns the current record's "id" value
 * @method string              getMarca()                 Returns the current record's "marca" value
 * @method string              getModelo()                Returns the current record's "modelo" value
 * @method string              getDescripcion()           Returns the current record's "descripcion" value
 * @method boolean             getMic()                   Returns the current record's "mic" value
 * @method boolean             getCam()                   Returns the current record's "cam" value
 * @method boolean             getSd()                    Returns the current record's "sd" value
 * @method string              getStatus()                Returns the current record's "status" value
 * @method integer             getIdUpdate()              Returns the current record's "id_update" value
 * @method integer             getIdCreate()              Returns the current record's "id_create" value
 * @method string              getIpUpdate()              Returns the current record's "ip_update" value
 * @method string              getIpCreate()              Returns the current record's "ip_create" value
 * @method Doctrine_Collection getVehiculosComando()      Returns the current record's "Vehiculos_Comando" collection
 * @method Doctrine_Collection getVehiculosGpsVehiculo()  Returns the current record's "Vehiculos_GpsVehiculo" collection
 * @method Vehiculos_Gps       setId()                    Sets the current record's "id" value
 * @method Vehiculos_Gps       setMarca()                 Sets the current record's "marca" value
 * @method Vehiculos_Gps       setModelo()                Sets the current record's "modelo" value
 * @method Vehiculos_Gps       setDescripcion()           Sets the current record's "descripcion" value
 * @method Vehiculos_Gps       setMic()                   Sets the current record's "mic" value
 * @method Vehiculos_Gps       setCam()                   Sets the current record's "cam" value
 * @method Vehiculos_Gps       setSd()                    Sets the current record's "sd" value
 * @method Vehiculos_Gps       setStatus()                Sets the current record's "status" value
 * @method Vehiculos_Gps       setIdUpdate()              Sets the current record's "id_update" value
 * @method Vehiculos_Gps       setIdCreate()              Sets the current record's "id_create" value
 * @method Vehiculos_Gps       setIpUpdate()              Sets the current record's "ip_update" value
 * @method Vehiculos_Gps       setIpCreate()              Sets the current record's "ip_create" value
 * @method Vehiculos_Gps       setVehiculosComando()      Sets the current record's "Vehiculos_Comando" collection
 * @method Vehiculos_Gps       setVehiculosGpsVehiculo()  Sets the current record's "Vehiculos_GpsVehiculo" collection
 * 
 * @package    siglas
 * @subpackage model
 * @author     Livio Lopez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseVehiculos_Gps extends BaseDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('vehiculos.gps');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'vehiculos.gps_id',
             'length' => 4,
             ));
        $this->hasColumn('marca', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('modelo', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('descripcion', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('mic', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('cam', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('sd', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 1,
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
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_create', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
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
        $this->hasColumn('ip_create', 'string', 50, array(
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
        $this->hasMany('Vehiculos_Comando', array(
             'local' => 'id',
             'foreign' => 'gps_id'));

        $this->hasMany('Vehiculos_GpsVehiculo', array(
             'local' => 'id',
             'foreign' => 'gps_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}