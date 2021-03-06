<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Rrhh_Configuraciones', 'doctrine');

/**
 * BaseRrhh_Configuraciones
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $modulo
 * @property string $parametros
 * @property string $indexado
 * @property string $status
 * @property integer $id_update
 * @property string $ip_update
 * @property Doctrine_Collection $Rrhh_Reposos
 * @property Doctrine_Collection $Rrhh_Vacaciones
 * @property Doctrine_Collection $Rrhh_Permisos
 * 
 * @method integer              getId()              Returns the current record's "id" value
 * @method string               getModulo()          Returns the current record's "modulo" value
 * @method string               getParametros()      Returns the current record's "parametros" value
 * @method string               getIndexado()        Returns the current record's "indexado" value
 * @method string               getStatus()          Returns the current record's "status" value
 * @method integer              getIdUpdate()        Returns the current record's "id_update" value
 * @method string               getIpUpdate()        Returns the current record's "ip_update" value
 * @method Doctrine_Collection  getRrhhReposos()     Returns the current record's "Rrhh_Reposos" collection
 * @method Doctrine_Collection  getRrhhVacaciones()  Returns the current record's "Rrhh_Vacaciones" collection
 * @method Doctrine_Collection  getRrhhPermisos()    Returns the current record's "Rrhh_Permisos" collection
 * @method Rrhh_Configuraciones setId()              Sets the current record's "id" value
 * @method Rrhh_Configuraciones setModulo()          Sets the current record's "modulo" value
 * @method Rrhh_Configuraciones setParametros()      Sets the current record's "parametros" value
 * @method Rrhh_Configuraciones setIndexado()        Sets the current record's "indexado" value
 * @method Rrhh_Configuraciones setStatus()          Sets the current record's "status" value
 * @method Rrhh_Configuraciones setIdUpdate()        Sets the current record's "id_update" value
 * @method Rrhh_Configuraciones setIpUpdate()        Sets the current record's "ip_update" value
 * @method Rrhh_Configuraciones setRrhhReposos()     Sets the current record's "Rrhh_Reposos" collection
 * @method Rrhh_Configuraciones setRrhhVacaciones()  Sets the current record's "Rrhh_Vacaciones" collection
 * @method Rrhh_Configuraciones setRrhhPermisos()    Sets the current record's "Rrhh_Permisos" collection
 * 
 * @package    siglas
 * @subpackage model
 * @author     Livio Lopez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRrhh_Configuraciones extends BaseDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('rrhh.configuraciones');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'rrhh.configuraciones_id',
             'length' => 4,
             ));
        $this->hasColumn('modulo', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('parametros', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('indexado', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
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
        $this->hasMany('Rrhh_Reposos', array(
             'local' => 'id',
             'foreign' => 'configuraciones_reposos_id'));

        $this->hasMany('Rrhh_Vacaciones', array(
             'local' => 'id',
             'foreign' => 'configuraciones_vacaciones_id'));

        $this->hasMany('Rrhh_Permisos', array(
             'local' => 'id',
             'foreign' => 'configuraciones_permisos_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}