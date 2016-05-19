<?php


class Correspondencia_TipoFormatoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_TipoFormato');
    }
    
    static public $boolean = array(
        'S' => 'SI',
        'N' => 'NO',
    );

    public function getPrivado(){
        return self::$boolean;
    }

    static public $tipo = array(
        'C' => 'Formato manejado por la aplicacion de correspondencia',
        'M' => 'Formato manejado por un modulo maestro especializado',
    );

    public function getTipo(){
        return self::$tipo;
    }
    
    public function innerList() {
        $q = Doctrine_Query::create()
            ->select('tp.*')
            ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = tp.id_update LIMIT 1) as user_update')
            ->from('Correspondencia_TipoFormato tp')
            ->orderBy('tp.id');

        return $q;
    }
    
    public function tiposActivos() {
        $q = Doctrine_Query::create()
            ->select('t.id, t.nombre')
            ->from('Correspondencia_TipoFormato t')
            ->where('t.status = ?','A')
            ->orderBy('t.nombre')
            ->useResultCache(true, 3600, 'tipo_formato_activos')
            ->execute();

        return $q;
    }
    
    public function tiposActivosUnidad($unidades_ids) {
        $q = Doctrine_Query::create()
            ->select('tf.id, tf.nombre')
            ->from('Correspondencia_TipoFormato tf')
            ->innerJoin('tf.Correspondencia_CorrelativosFormatos cf')
            ->innerJoin('cf.Correspondencia_UnidadCorrelativo uc')
            ->where('tf.status = ?','A')
            ->andWhereIn('uc.unidad_id',$unidades_ids)
            ->orderBy('tf.nombre')
            ->execute();

        return $q;
    }
    
    public function tipoFormatoCacheado($tipo_formato_id)
    {
            $q = Doctrine_Query::create()
                ->select('tf.*')
                ->from('Correspondencia_TipoFormato tf')
                ->where('tf.id = ?', $tipo_formato_id)
                ->limit(1);
//                ->useResultCache(true, 3600, 'correspondencia_tipo_formato_'.$tipo_formato_id);

            return $q->execute();
    }
    
    public function tiposFormato()
    {
        $q = Doctrine_Query::create()
            ->select('t.*')
            ->from('Correspondencia_TipoFormato t')
            ->orderBy('t.id')
            ->execute();

        return $q;
    }
}

