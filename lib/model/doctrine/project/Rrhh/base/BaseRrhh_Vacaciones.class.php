<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Rrhh_Vacaciones', 'doctrine');

/**
 * BaseRrhh_Vacaciones
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $configuraciones_vacaciones_id
 * @property integer $funcionario_id
 * @property date $f_cumplimiento
 * @property string $periodo_vacacional
 * @property integer $anios_laborales
 * @property integer $dias_disfrute_establecidos
 * @property integer $dias_disfrute_adicionales
 * @property integer $dias_disfrute_totales
 * @property integer $dias_disfrute_pendientes
 * @property boolean $pagadas
 * @property date $f_abono
 * @property float $monto_abonado_concepto
 * @property string $status
 * @property integer $id_update
 * @property string $ip_update
 * @property Rrhh_Configuraciones $Rrhh_Configuraciones
 * @property Funcionarios_Funcionario $Funcionarios_Funcionario
 * @property Doctrine_Collection $Rrhh_VacacionesDisfrutadas
 * 
 * @method integer                  getId()                            Returns the current record's "id" value
 * @method integer                  getConfiguracionesVacacionesId()   Returns the current record's "configuraciones_vacaciones_id" value
 * @method integer                  getFuncionarioId()                 Returns the current record's "funcionario_id" value
 * @method date                     getFCumplimiento()                 Returns the current record's "f_cumplimiento" value
 * @method string                   getPeriodoVacacional()             Returns the current record's "periodo_vacacional" value
 * @method integer                  getAniosLaborales()                Returns the current record's "anios_laborales" value
 * @method integer                  getDiasDisfruteEstablecidos()      Returns the current record's "dias_disfrute_establecidos" value
 * @method integer                  getDiasDisfruteAdicionales()       Returns the current record's "dias_disfrute_adicionales" value
 * @method integer                  getDiasDisfruteTotales()           Returns the current record's "dias_disfrute_totales" value
 * @method integer                  getDiasDisfrutePendientes()        Returns the current record's "dias_disfrute_pendientes" value
 * @method boolean                  getPagadas()                       Returns the current record's "pagadas" value
 * @method date                     getFAbono()                        Returns the current record's "f_abono" value
 * @method float                    getMontoAbonadoConcepto()          Returns the current record's "monto_abonado_concepto" value
 * @method string                   getStatus()                        Returns the current record's "status" value
 * @method integer                  getIdUpdate()                      Returns the current record's "id_update" value
 * @method string                   getIpUpdate()                      Returns the current record's "ip_update" value
 * @method Rrhh_Configuraciones     getRrhhConfiguraciones()           Returns the current record's "Rrhh_Configuraciones" value
 * @method Funcionarios_Funcionario getFuncionariosFuncionario()       Returns the current record's "Funcionarios_Funcionario" value
 * @method Doctrine_Collection      getRrhhVacacionesDisfrutadas()     Returns the current record's "Rrhh_VacacionesDisfrutadas" collection
 * @method Rrhh_Vacaciones          setId()                            Sets the current record's "id" value
 * @method Rrhh_Vacaciones          setConfiguracionesVacacionesId()   Sets the current record's "configuraciones_vacaciones_id" value
 * @method Rrhh_Vacaciones          setFuncionarioId()                 Sets the current record's "funcionario_id" value
 * @method Rrhh_Vacaciones          setFCumplimiento()                 Sets the current record's "f_cumplimiento" value
 * @method Rrhh_Vacaciones          setPeriodoVacacional()             Sets the current record's "periodo_vacacional" value
 * @method Rrhh_Vacaciones          setAniosLaborales()                Sets the current record's "anios_laborales" value
 * @method Rrhh_Vacaciones          setDiasDisfruteEstablecidos()      Sets the current record's "dias_disfrute_establecidos" value
 * @method Rrhh_Vacaciones          setDiasDisfruteAdicionales()       Sets the current record's "dias_disfrute_adicionales" value
 * @method Rrhh_Vacaciones          setDiasDisfruteTotales()           Sets the current record's "dias_disfrute_totales" value
 * @method Rrhh_Vacaciones          setDiasDisfrutePendientes()        Sets the current record's "dias_disfrute_pendientes" value
 * @method Rrhh_Vacaciones          setPagadas()                       Sets the current record's "pagadas" value
 * @method Rrhh_Vacaciones          setFAbono()                        Sets the current record's "f_abono" value
 * @method Rrhh_Vacaciones          setMontoAbonadoConcepto()          Sets the current record's "monto_abonado_concepto" value
 * @method Rrhh_Vacaciones          setStatus()                        Sets the current record's "status" value
 * @method Rrhh_Vacaciones          setIdUpdate()                      Sets the current record's "id_update" value
 * @method Rrhh_Vacaciones          setIpUpdate()                      Sets the current record's "ip_update" value
 * @method Rrhh_Vacaciones          setRrhhConfiguraciones()           Sets the current record's "Rrhh_Configuraciones" value
 * @method Rrhh_Vacaciones          setFuncionariosFuncionario()       Sets the current record's "Funcionarios_Funcionario" value
 * @method Rrhh_Vacaciones          setRrhhVacacionesDisfrutadas()     Sets the current record's "Rrhh_VacacionesDisfrutadas" collection
 * 
 * @package    siglas
 * @subpackage model
 * @author     Livio Lopez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRrhh_Vacaciones extends BaseDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('rrhh.vacaciones');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'rrhh.vacaciones_id',
             'length' => 4,
             ));
        $this->hasColumn('configuraciones_vacaciones_id', 'integer', 4, array(
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
        $this->hasColumn('f_cumplimiento', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('periodo_vacacional', 'string', 9, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 9,
             ));
        $this->hasColumn('anios_laborales', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('dias_disfrute_establecidos', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('dias_disfrute_adicionales', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('dias_disfrute_totales', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('dias_disfrute_pendientes', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('pagadas', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('f_abono', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('monto_abonado_concepto', 'float', null, array(
             'type' => 'float',
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
        $this->hasOne('Rrhh_Configuraciones', array(
             'local' => 'configuraciones_vacaciones_id',
             'foreign' => 'id'));

        $this->hasOne('Funcionarios_Funcionario', array(
             'local' => 'funcionario_id',
             'foreign' => 'id'));

        $this->hasMany('Rrhh_VacacionesDisfrutadas', array(
             'local' => 'id',
             'foreign' => 'vacaciones_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}