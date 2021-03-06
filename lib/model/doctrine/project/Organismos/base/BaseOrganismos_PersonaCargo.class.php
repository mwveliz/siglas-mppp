<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Organismos_PersonaCargo', 'doctrine');

/**
 * BaseOrganismos_PersonaCargo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $persona_id
 * @property string $nombre
 * @property string $status
 * @property integer $id_update
 * @property Organismos_Persona $Organismos_Persona
 * @property Doctrine_Collection $Correspondencia_ReceptorOrganismo
 * @property Doctrine_Collection $Correspondencia_Correspondencia
 * 
 * @method integer                 getId()                                Returns the current record's "id" value
 * @method integer                 getPersonaId()                         Returns the current record's "persona_id" value
 * @method string                  getNombre()                            Returns the current record's "nombre" value
 * @method string                  getStatus()                            Returns the current record's "status" value
 * @method integer                 getIdUpdate()                          Returns the current record's "id_update" value
 * @method Organismos_Persona      getOrganismosPersona()                 Returns the current record's "Organismos_Persona" value
 * @method Doctrine_Collection     getCorrespondenciaReceptorOrganismo()  Returns the current record's "Correspondencia_ReceptorOrganismo" collection
 * @method Doctrine_Collection     getCorrespondenciaCorrespondencia()    Returns the current record's "Correspondencia_Correspondencia" collection
 * @method Organismos_PersonaCargo setId()                                Sets the current record's "id" value
 * @method Organismos_PersonaCargo setPersonaId()                         Sets the current record's "persona_id" value
 * @method Organismos_PersonaCargo setNombre()                            Sets the current record's "nombre" value
 * @method Organismos_PersonaCargo setStatus()                            Sets the current record's "status" value
 * @method Organismos_PersonaCargo setIdUpdate()                          Sets the current record's "id_update" value
 * @method Organismos_PersonaCargo setOrganismosPersona()                 Sets the current record's "Organismos_Persona" value
 * @method Organismos_PersonaCargo setCorrespondenciaReceptorOrganismo()  Sets the current record's "Correspondencia_ReceptorOrganismo" collection
 * @method Organismos_PersonaCargo setCorrespondenciaCorrespondencia()    Sets the current record's "Correspondencia_Correspondencia" collection
 * 
 * @package    siglas
 * @subpackage model
 * @author     Livio Lopez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOrganismos_PersonaCargo extends BaseDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('organismos.persona_cargo');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'organismos.persona_cargo_id',
             'length' => 4,
             ));
        $this->hasColumn('persona_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
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
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Organismos_Persona', array(
             'local' => 'persona_id',
             'foreign' => 'id'));

        $this->hasMany('Correspondencia_ReceptorOrganismo', array(
             'local' => 'id',
             'foreign' => 'persona_cargo_id'));

        $this->hasMany('Correspondencia_Correspondencia', array(
             'local' => 'id',
             'foreign' => 'emisor_persona_cargo_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}