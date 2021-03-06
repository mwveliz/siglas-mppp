<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Archivo_CompartirFuncionario', 'doctrine');

/**
 * BaseArchivo_CompartirFuncionario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $compartir_id
 * @property integer $funcionario_id
 * @property timestamp $updated_at
 * @property integer $id_update
 * @property Archivo_Compartir $Archivo_Compartir
 * @property Funcionarios_Funcionario $Funcionarios_Funcionario
 * 
 * @method integer                      getId()                       Returns the current record's "id" value
 * @method integer                      getCompartirId()              Returns the current record's "compartir_id" value
 * @method integer                      getFuncionarioId()            Returns the current record's "funcionario_id" value
 * @method timestamp                    getUpdatedAt()                Returns the current record's "updated_at" value
 * @method integer                      getIdUpdate()                 Returns the current record's "id_update" value
 * @method Archivo_Compartir            getArchivoCompartir()         Returns the current record's "Archivo_Compartir" value
 * @method Funcionarios_Funcionario     getFuncionariosFuncionario()  Returns the current record's "Funcionarios_Funcionario" value
 * @method Archivo_CompartirFuncionario setId()                       Sets the current record's "id" value
 * @method Archivo_CompartirFuncionario setCompartirId()              Sets the current record's "compartir_id" value
 * @method Archivo_CompartirFuncionario setFuncionarioId()            Sets the current record's "funcionario_id" value
 * @method Archivo_CompartirFuncionario setUpdatedAt()                Sets the current record's "updated_at" value
 * @method Archivo_CompartirFuncionario setIdUpdate()                 Sets the current record's "id_update" value
 * @method Archivo_CompartirFuncionario setArchivoCompartir()         Sets the current record's "Archivo_Compartir" value
 * @method Archivo_CompartirFuncionario setFuncionariosFuncionario()  Sets the current record's "Funcionarios_Funcionario" value
 * 
 * @package    siglas
 * @subpackage model
 * @author     Livio Lopez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseArchivo_CompartirFuncionario extends BaseDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('archivo.compartir_funcionario');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'archivo.compartir_funcionario_id',
             'length' => 4,
             ));
        $this->hasColumn('compartir_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
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
        $this->hasColumn('updated_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 25,
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
        $this->hasOne('Archivo_Compartir', array(
             'local' => 'compartir_id',
             'foreign' => 'id'));

        $this->hasOne('Funcionarios_Funcionario', array(
             'local' => 'funcionario_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}