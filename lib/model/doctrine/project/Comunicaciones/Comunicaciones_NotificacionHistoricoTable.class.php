<?php


class Comunicaciones_NotificacionHistoricoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Comunicaciones_NotificacionHistorico');
    }
}