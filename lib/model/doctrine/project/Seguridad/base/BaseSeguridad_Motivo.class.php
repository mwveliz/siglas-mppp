<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Seguridad_Motivo', 'doctrine');

/**
 * BaseSeguridad_Motivo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $descripcion
 * @property integer $id_update
 * @property string $ip_update
 * @property Doctrine_Collection $Seguridad_Ingreso
 * @property Doctrine_Collection $Seguridad_Preingreso
 * @property Doctrine_Collection $Public_Eventos
 * 
 * @method integer             getId()                   Returns the current record's "id" value
 * @method string              getDescripcion()          Returns the current record's "descripcion" value
 * @method integer             getIdUpdate()             Returns the current record's "id_update" value
 * @method string              getIpUpdate()             Returns the current record's "ip_update" value
 * @method Doctrine_Collection getSeguridadIngreso()     Returns the current record's "Seguridad_Ingreso" collection
 * @method Doctrine_Collection getSeguridadPreingreso()  Returns the current record's "Seguridad_Preingreso" collection
 * @method Doctrine_Collection getPublicEventos()        Returns the current record's "Public_Eventos" collection
 * @method Seguridad_Motivo    setId()                   Sets the current record's "id" value
 * @method Seguridad_Motivo    setDescripcion()          Sets the current record's "descripcion" value
 * @method Seguridad_Motivo    setIdUpdate()             Sets the current record's "id_update" value
 * @method Seguridad_Motivo    setIpUpdate()             Sets the current record's "ip_update" value
 * @method Seguridad_Motivo    setSeguridadIngreso()     Sets the current record's "Seguridad_Ingreso" collection
 * @method Seguridad_Motivo    setSeguridadPreingreso()  Sets the current record's "Seguridad_Preingreso" collection
 * @method Seguridad_Motivo    setPublicEventos()        Sets the current record's "Public_Eventos" collection
 * 
 * @package    siglas
 * @subpackage model
 * @author     Livio Lopez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSeguridad_Motivo extends BaseDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('seguridad.motivo');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'seguridad.motivo_id',
             'length' => 4,
             ));
        $this->hasColumn('descripcion', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
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
        $this->hasMany('Seguridad_Ingreso', array(
             'local' => 'id',
             'foreign' => 'motivo_id'));

        $this->hasMany('Seguridad_Preingreso', array(
             'local' => 'id',
             'foreign' => 'motivo_id'));

        $this->hasMany('Public_Eventos', array(
             'local' => 'id',
             'foreign' => 'motivo_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}