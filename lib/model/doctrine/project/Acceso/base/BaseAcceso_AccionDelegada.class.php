<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Acceso_AccionDelegada', 'doctrine');

/**
 * BaseAcceso_AccionDelegada
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $usuario_delega_id
 * @property integer $usuario_delegado_id
 * @property date $f_expiracion
 * @property string $accion
 * @property string $parametros
 * @property string $status
 * @property integer $id_update
 * @property string $ip_update
 * @property Acceso_Usuario $Acceso_UsuarioDelega
 * @property Acceso_Usuario $Acceso_UsuarioDelegado
 * @property Doctrine_Collection $Correspondencia_FuncionarioEmisor
 * 
 * @method integer               getId()                                Returns the current record's "id" value
 * @method integer               getUsuarioDelegaId()                   Returns the current record's "usuario_delega_id" value
 * @method integer               getUsuarioDelegadoId()                 Returns the current record's "usuario_delegado_id" value
 * @method date                  getFExpiracion()                       Returns the current record's "f_expiracion" value
 * @method string                getAccion()                            Returns the current record's "accion" value
 * @method string                getParametros()                        Returns the current record's "parametros" value
 * @method string                getStatus()                            Returns the current record's "status" value
 * @method integer               getIdUpdate()                          Returns the current record's "id_update" value
 * @method string                getIpUpdate()                          Returns the current record's "ip_update" value
 * @method Acceso_Usuario        getAccesoUsuarioDelega()               Returns the current record's "Acceso_UsuarioDelega" value
 * @method Acceso_Usuario        getAccesoUsuarioDelegado()             Returns the current record's "Acceso_UsuarioDelegado" value
 * @method Doctrine_Collection   getCorrespondenciaFuncionarioEmisor()  Returns the current record's "Correspondencia_FuncionarioEmisor" collection
 * @method Acceso_AccionDelegada setId()                                Sets the current record's "id" value
 * @method Acceso_AccionDelegada setUsuarioDelegaId()                   Sets the current record's "usuario_delega_id" value
 * @method Acceso_AccionDelegada setUsuarioDelegadoId()                 Sets the current record's "usuario_delegado_id" value
 * @method Acceso_AccionDelegada setFExpiracion()                       Sets the current record's "f_expiracion" value
 * @method Acceso_AccionDelegada setAccion()                            Sets the current record's "accion" value
 * @method Acceso_AccionDelegada setParametros()                        Sets the current record's "parametros" value
 * @method Acceso_AccionDelegada setStatus()                            Sets the current record's "status" value
 * @method Acceso_AccionDelegada setIdUpdate()                          Sets the current record's "id_update" value
 * @method Acceso_AccionDelegada setIpUpdate()                          Sets the current record's "ip_update" value
 * @method Acceso_AccionDelegada setAccesoUsuarioDelega()               Sets the current record's "Acceso_UsuarioDelega" value
 * @method Acceso_AccionDelegada setAccesoUsuarioDelegado()             Sets the current record's "Acceso_UsuarioDelegado" value
 * @method Acceso_AccionDelegada setCorrespondenciaFuncionarioEmisor()  Sets the current record's "Correspondencia_FuncionarioEmisor" collection
 * 
 * @package    siglas
 * @subpackage model
 * @author     Livio Lopez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAcceso_AccionDelegada extends BaseDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('acceso.accion_delegada');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'acceso.accion_delegada_id',
             'length' => 4,
             ));
        $this->hasColumn('usuario_delega_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('usuario_delegado_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('f_expiracion', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('accion', 'string', 255, array(
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
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('status', 'string', 1, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
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
        $this->hasOne('Acceso_Usuario as Acceso_UsuarioDelega', array(
             'local' => 'usuario_delega_id',
             'foreign' => 'id'));

        $this->hasOne('Acceso_Usuario as Acceso_UsuarioDelegado', array(
             'local' => 'usuario_delegado_id',
             'foreign' => 'id'));

        $this->hasMany('Correspondencia_FuncionarioEmisor', array(
             'local' => 'id',
             'foreign' => 'accion_delegada_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}