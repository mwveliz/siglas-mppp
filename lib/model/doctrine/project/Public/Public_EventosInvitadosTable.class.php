<?php


class Public_EventosInvitadosTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_EventosInvitados');
    }
}