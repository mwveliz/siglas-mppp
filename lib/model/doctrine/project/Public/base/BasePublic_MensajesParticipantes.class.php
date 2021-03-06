<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Public_MensajesParticipantes', 'doctrine');

/**
 * BasePublic_MensajesParticipantes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $mensajes_grupo_id
 * @property integer $funcionario_id
 * @property Public_MensajesGrupo $Public_MensajesGrupo
 * @property Funcionarios_Funcionario $Funcionarios_Funcionario
 * 
 * @method integer                      getId()                       Returns the current record's "id" value
 * @method integer                      getMensajesGrupoId()          Returns the current record's "mensajes_grupo_id" value
 * @method integer                      getFuncionarioId()            Returns the current record's "funcionario_id" value
 * @method Public_MensajesGrupo         getPublicMensajesGrupo()      Returns the current record's "Public_MensajesGrupo" value
 * @method Funcionarios_Funcionario     getFuncionariosFuncionario()  Returns the current record's "Funcionarios_Funcionario" value
 * @method Public_MensajesParticipantes setId()                       Sets the current record's "id" value
 * @method Public_MensajesParticipantes setMensajesGrupoId()          Sets the current record's "mensajes_grupo_id" value
 * @method Public_MensajesParticipantes setFuncionarioId()            Sets the current record's "funcionario_id" value
 * @method Public_MensajesParticipantes setPublicMensajesGrupo()      Sets the current record's "Public_MensajesGrupo" value
 * @method Public_MensajesParticipantes setFuncionariosFuncionario()  Sets the current record's "Funcionarios_Funcionario" value
 * 
 * @package    siglas
 * @subpackage model
 * @author     Livio Lopez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePublic_MensajesParticipantes extends BaseDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('public.mensajes_participantes');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'public.mensajes_participantes_id',
             'length' => 4,
             ));
        $this->hasColumn('mensajes_grupo_id', 'integer', 4, array(
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
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Public_MensajesGrupo', array(
             'local' => 'mensajes_grupo_id',
             'foreign' => 'id'));

        $this->hasOne('Funcionarios_Funcionario', array(
             'local' => 'funcionario_id',
             'foreign' => 'id'));
    }
}