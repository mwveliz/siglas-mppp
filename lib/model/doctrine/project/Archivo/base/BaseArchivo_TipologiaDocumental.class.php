<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Archivo_TipologiaDocumental', 'doctrine');

/**
 * BaseArchivo_TipologiaDocumental
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $serie_documental_id
 * @property integer $cuerpo_documental_id
 * @property string $nombre
 * @property integer $orden
 * @property string $status
 * @property integer $id_update
 * @property Archivo_SerieDocumental $Archivo_SerieDocumental
 * @property Archivo_CuerpoDocumental $Archivo_CuerpoDocumental
 * @property Doctrine_Collection $Archivo_Documento
 * @property Doctrine_Collection $Archivo_Etiqueta
 * 
 * @method integer                     getId()                       Returns the current record's "id" value
 * @method integer                     getSerieDocumentalId()        Returns the current record's "serie_documental_id" value
 * @method integer                     getCuerpoDocumentalId()       Returns the current record's "cuerpo_documental_id" value
 * @method string                      getNombre()                   Returns the current record's "nombre" value
 * @method integer                     getOrden()                    Returns the current record's "orden" value
 * @method string                      getStatus()                   Returns the current record's "status" value
 * @method integer                     getIdUpdate()                 Returns the current record's "id_update" value
 * @method Archivo_SerieDocumental     getArchivoSerieDocumental()   Returns the current record's "Archivo_SerieDocumental" value
 * @method Archivo_CuerpoDocumental    getArchivoCuerpoDocumental()  Returns the current record's "Archivo_CuerpoDocumental" value
 * @method Doctrine_Collection         getArchivoDocumento()         Returns the current record's "Archivo_Documento" collection
 * @method Doctrine_Collection         getArchivoEtiqueta()          Returns the current record's "Archivo_Etiqueta" collection
 * @method Archivo_TipologiaDocumental setId()                       Sets the current record's "id" value
 * @method Archivo_TipologiaDocumental setSerieDocumentalId()        Sets the current record's "serie_documental_id" value
 * @method Archivo_TipologiaDocumental setCuerpoDocumentalId()       Sets the current record's "cuerpo_documental_id" value
 * @method Archivo_TipologiaDocumental setNombre()                   Sets the current record's "nombre" value
 * @method Archivo_TipologiaDocumental setOrden()                    Sets the current record's "orden" value
 * @method Archivo_TipologiaDocumental setStatus()                   Sets the current record's "status" value
 * @method Archivo_TipologiaDocumental setIdUpdate()                 Sets the current record's "id_update" value
 * @method Archivo_TipologiaDocumental setArchivoSerieDocumental()   Sets the current record's "Archivo_SerieDocumental" value
 * @method Archivo_TipologiaDocumental setArchivoCuerpoDocumental()  Sets the current record's "Archivo_CuerpoDocumental" value
 * @method Archivo_TipologiaDocumental setArchivoDocumento()         Sets the current record's "Archivo_Documento" collection
 * @method Archivo_TipologiaDocumental setArchivoEtiqueta()          Sets the current record's "Archivo_Etiqueta" collection
 * 
 * @package    siglas
 * @subpackage model
 * @author     Livio Lopez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseArchivo_TipologiaDocumental extends BaseDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('archivo.tipologia_documental');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'archivo.tipologia_documental_id',
             'length' => 4,
             ));
        $this->hasColumn('serie_documental_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('cuerpo_documental_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('orden', 'integer', 4, array(
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
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Archivo_SerieDocumental', array(
             'local' => 'serie_documental_id',
             'foreign' => 'id'));

        $this->hasOne('Archivo_CuerpoDocumental', array(
             'local' => 'cuerpo_documental_id',
             'foreign' => 'id'));

        $this->hasMany('Archivo_Documento', array(
             'local' => 'id',
             'foreign' => 'tipologia_documental_id'));

        $this->hasMany('Archivo_Etiqueta', array(
             'local' => 'id',
             'foreign' => 'tipologia_documental_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}