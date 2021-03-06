<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Organigrama_TelefonoCargo', 'doctrine');

/**
 * BaseOrganigrama_TelefonoCargo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $cargo_id
 * @property string $telefono
 * @property integer $id_update
 * @property string $status
 * @property Organigrama_Cargo $Organigrama_Cargo
 * 
 * @method integer                   getId()                Returns the current record's "id" value
 * @method integer                   getCargoId()           Returns the current record's "cargo_id" value
 * @method string                    getTelefono()          Returns the current record's "telefono" value
 * @method integer                   getIdUpdate()          Returns the current record's "id_update" value
 * @method string                    getStatus()            Returns the current record's "status" value
 * @method Organigrama_Cargo         getOrganigramaCargo()  Returns the current record's "Organigrama_Cargo" value
 * @method Organigrama_TelefonoCargo setId()                Sets the current record's "id" value
 * @method Organigrama_TelefonoCargo setCargoId()           Sets the current record's "cargo_id" value
 * @method Organigrama_TelefonoCargo setTelefono()          Sets the current record's "telefono" value
 * @method Organigrama_TelefonoCargo setIdUpdate()          Sets the current record's "id_update" value
 * @method Organigrama_TelefonoCargo setStatus()            Sets the current record's "status" value
 * @method Organigrama_TelefonoCargo setOrganigramaCargo()  Sets the current record's "Organigrama_Cargo" value
 * 
 * @package    siglas
 * @subpackage model
 * @author     Livio Lopez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOrganigrama_TelefonoCargo extends BaseDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('organigrama.telefono_cargo');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'organigrama.telefono_cargo_id',
             'length' => 4,
             ));
        $this->hasColumn('cargo_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('telefono', 'string', 11, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 11,
             ));
        $this->hasColumn('id_update', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('status', 'string', 1, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Organigrama_Cargo', array(
             'local' => 'cargo_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}