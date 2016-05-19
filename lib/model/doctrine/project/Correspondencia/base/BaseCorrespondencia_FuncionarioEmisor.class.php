<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Correspondencia_FuncionarioEmisor', 'doctrine');

/**
 * BaseCorrespondencia_FuncionarioEmisor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $correspondencia_id
 * @property integer $funcionario_id
 * @property integer $funcionario_cargo_id
 * @property string $firma
 * @property integer $accion_delegada_id
 * @property integer $funcionario_delegado_id
 * @property integer $funcionario_delegado_cargo_id
 * @property integer $id_update
 * @property string $ip_update
 * @property string $proteccion
 * @property Correspondencia_Correspondencia $Correspondencia_Correspondencia
 * @property Funcionarios_Funcionario $Funcionarios_Funcionario
 * @property Funcionarios_FuncionarioCargo $Funcionarios_FuncionarioCargo
 * @property Funcionarios_Funcionario $Funcionarios_FuncionarioDelegado
 * @property Funcionarios_FuncionarioCargo $Funcionarios_FuncionarioCargoDelegado
 * @property Acceso_AccionDelegada $Acceso_AccionDelegada
 * 
 * @method integer                           getId()                                    Returns the current record's "id" value
 * @method integer                           getCorrespondenciaId()                     Returns the current record's "correspondencia_id" value
 * @method integer                           getFuncionarioId()                         Returns the current record's "funcionario_id" value
 * @method integer                           getFuncionarioCargoId()                    Returns the current record's "funcionario_cargo_id" value
 * @method string                            getFirma()                                 Returns the current record's "firma" value
 * @method integer                           getAccionDelegadaId()                      Returns the current record's "accion_delegada_id" value
 * @method integer                           getFuncionarioDelegadoId()                 Returns the current record's "funcionario_delegado_id" value
 * @method integer                           getFuncionarioDelegadoCargoId()            Returns the current record's "funcionario_delegado_cargo_id" value
 * @method integer                           getIdUpdate()                              Returns the current record's "id_update" value
 * @method string                            getIpUpdate()                              Returns the current record's "ip_update" value
 * @method string                            getProteccion()                            Returns the current record's "proteccion" value
 * @method Correspondencia_Correspondencia   getCorrespondenciaCorrespondencia()        Returns the current record's "Correspondencia_Correspondencia" value
 * @method Funcionarios_Funcionario          getFuncionariosFuncionario()               Returns the current record's "Funcionarios_Funcionario" value
 * @method Funcionarios_FuncionarioCargo     getFuncionariosFuncionarioCargo()          Returns the current record's "Funcionarios_FuncionarioCargo" value
 * @method Funcionarios_Funcionario          getFuncionariosFuncionarioDelegado()       Returns the current record's "Funcionarios_FuncionarioDelegado" value
 * @method Funcionarios_FuncionarioCargo     getFuncionariosFuncionarioCargoDelegado()  Returns the current record's "Funcionarios_FuncionarioCargoDelegado" value
 * @method Acceso_AccionDelegada             getAccesoAccionDelegada()                  Returns the current record's "Acceso_AccionDelegada" value
 * @method Correspondencia_FuncionarioEmisor setId()                                    Sets the current record's "id" value
 * @method Correspondencia_FuncionarioEmisor setCorrespondenciaId()                     Sets the current record's "correspondencia_id" value
 * @method Correspondencia_FuncionarioEmisor setFuncionarioId()                         Sets the current record's "funcionario_id" value
 * @method Correspondencia_FuncionarioEmisor setFuncionarioCargoId()                    Sets the current record's "funcionario_cargo_id" value
 * @method Correspondencia_FuncionarioEmisor setFirma()                                 Sets the current record's "firma" value
 * @method Correspondencia_FuncionarioEmisor setAccionDelegadaId()                      Sets the current record's "accion_delegada_id" value
 * @method Correspondencia_FuncionarioEmisor setFuncionarioDelegadoId()                 Sets the current record's "funcionario_delegado_id" value
 * @method Correspondencia_FuncionarioEmisor setFuncionarioDelegadoCargoId()            Sets the current record's "funcionario_delegado_cargo_id" value
 * @method Correspondencia_FuncionarioEmisor setIdUpdate()                              Sets the current record's "id_update" value
 * @method Correspondencia_FuncionarioEmisor setIpUpdate()                              Sets the current record's "ip_update" value
 * @method Correspondencia_FuncionarioEmisor setProteccion()                            Sets the current record's "proteccion" value
 * @method Correspondencia_FuncionarioEmisor setCorrespondenciaCorrespondencia()        Sets the current record's "Correspondencia_Correspondencia" value
 * @method Correspondencia_FuncionarioEmisor setFuncionariosFuncionario()               Sets the current record's "Funcionarios_Funcionario" value
 * @method Correspondencia_FuncionarioEmisor setFuncionariosFuncionarioCargo()          Sets the current record's "Funcionarios_FuncionarioCargo" value
 * @method Correspondencia_FuncionarioEmisor setFuncionariosFuncionarioDelegado()       Sets the current record's "Funcionarios_FuncionarioDelegado" value
 * @method Correspondencia_FuncionarioEmisor setFuncionariosFuncionarioCargoDelegado()  Sets the current record's "Funcionarios_FuncionarioCargoDelegado" value
 * @method Correspondencia_FuncionarioEmisor setAccesoAccionDelegada()                  Sets the current record's "Acceso_AccionDelegada" value
 * 
 * @package    siglas
 * @subpackage model
 * @author     Livio Lopez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCorrespondencia_FuncionarioEmisor extends BaseDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('correspondencia.funcionario_emisor');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'correspondencia.funcionario_emisor_id',
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
        $this->hasColumn('funcionario_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('funcionario_cargo_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('firma', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('accion_delegada_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('funcionario_delegado_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('funcionario_delegado_cargo_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
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
             'notnull' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('proteccion', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Correspondencia_Correspondencia', array(
             'local' => 'correspondencia_id',
             'foreign' => 'id'));

        $this->hasOne('Funcionarios_Funcionario', array(
             'local' => 'funcionario_id',
             'foreign' => 'id'));

        $this->hasOne('Funcionarios_FuncionarioCargo', array(
             'local' => 'funcionario_cargo_id',
             'foreign' => 'id'));

        $this->hasOne('Funcionarios_Funcionario as Funcionarios_FuncionarioDelegado', array(
             'local' => 'funcionario_delegado_id',
             'foreign' => 'id'));

        $this->hasOne('Funcionarios_FuncionarioCargo as Funcionarios_FuncionarioCargoDelegado', array(
             'local' => 'funcionario_delegado_cargo_id',
             'foreign' => 'id'));

        $this->hasOne('Acceso_AccionDelegada', array(
             'local' => 'accion_delegada_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}