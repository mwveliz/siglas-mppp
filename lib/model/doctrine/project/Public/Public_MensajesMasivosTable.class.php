<?php


class Public_MensajesMasivosTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_MensajesMasivos');
    }
    
    public function listadoNumeros($mensaje_id)
    {
            $q = Doctrine_Query::create()
                ->select('mm.*')
                ->from('Public_MensajesMasivos mm')
                ->where('mm.mensajes_id = ?', $mensaje_id)
                ->execute();

            return $q;
    }    
    
    public function destinatariosTotalEnvio($mensaje_id)
    {
            $q = Doctrine_Query::create()
                ->select('SUM(mm.destinatarios) as total')
                ->from('Public_MensajesMasivos mm')
                ->where('mm.mensajes_id = ?', $mensaje_id)
                ->useResultCache(true, 3600, 'mensajes_destinatarios_'.$mensaje_id);
                
            return $q->execute();
    }    
    
    public function mensajesTotalEnvio($mensaje_id)
    {
            $q = Doctrine_Query::create()
                ->select('SUM(mm.total) as total')
                ->from('Public_MensajesMasivos mm')
                ->where('mm.mensajes_id = ?', $mensaje_id)
                ->useResultCache(true, 3600, 'mensajes_total_'.$mensaje_id);
                
            return $q->execute();
    }
    
    public function modemDisponible()
    {
            $q = Doctrine_Query::create()
                ->select('mm.modem_emisor as modem, SUM(mm.total) as sumt')
                ->from('Public_MensajesMasivos mm')
                ->where('mm.status = ?', 'A')
                ->groupBy('modem')
                ->orderBy('modem ASC');

            return $q->execute();
    }
}