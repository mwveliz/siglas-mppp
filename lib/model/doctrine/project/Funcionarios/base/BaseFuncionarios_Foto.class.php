<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Funcionarios_Foto', 'doctrine');

/**
 * BaseFuncionarios_Foto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $funcionario_id
 * @property string $ruta
 * @property string $observacion
 * @property timestamp $f_validado
 * @property integer $id_validado
 * @property string $status
 * @property integer $id_update
 * @property string $ip_update
 * @property Funcionarios_Funcionario $Funcionarios_Funcionario
 * 
 * @method integer                  getId()                       Returns the current record's "id" value
 * @method integer                  getFuncionarioId()            Returns the current record's "funcionario_id" value
 * @method string                   getRuta()                     Returns the current record's "ruta" value
 * @method string                   getObservacion()              Returns the current record's "observacion" value
 * @method timestamp                getFValidado()                Returns the current record's "f_validado" value
 * @method integer                  getIdValidado()               Returns the current record's "id_validado" value
 * @method string                   getStatus()                   Returns the current record's "status" value
 * @method integer                  getIdUpdate()                 Returns the current record's "id_update" value
 * @method string                   getIpUpdate()                 Returns the current record's "ip_update" value
 * @method Funcionarios_Funcionario getFuncionariosFuncionario()  Returns the current record's "Funcionarios_Funcionario" value
 * @method Funcionarios_Foto        setId()                       Sets the current record's "id" value
 * @method Funcionarios_Foto        setFuncionarioId()            Sets the current record's "funcionario_id" value
 * @method Funcionarios_Foto        setRuta()                     Sets the current record's "ruta" value
 * @method Funcionarios_Foto        setObservacion()              Sets the current record's "observacion" value
 * @method Funcionarios_Foto        setFValidado()                Sets the current record's "f_validado" value
 * @method Funcionarios_Foto        setIdValidado()               Sets the current record's "id_validado" value
 * @method Funcionarios_Foto        setStatus()                   Sets the current record's "status" value
 * @method Funcionarios_Foto        setIdUpdate()                 Sets the current record's "id_update" value
 * @method Funcionarios_Foto        setIpUpdate()                 Sets the current record's "ip_update" value
 * @method Funcionarios_Foto        setFuncionariosFuncionario()  Sets the current record's "Funcionarios_Funcionario" value
 * 
 * @package    siglas
 * @subpackage model
 * @author     Livio Lopez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFuncionarios_Foto extends BaseDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('funcionarios.foto');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'funcionarios.foto_id',
             'length' => 4,
             ));
        $this->hasColumn('funcionario_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('ruta', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('observacion', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('f_validado', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_validado', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
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
        $this->hasColumn('id_update', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('ip_update', 'string', 40, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 40,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Funcionarios_Funcionario', array(
             'local' => 'funcionario_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}