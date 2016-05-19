<?php


class Public_TipoGrupoSocialTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_TipoGrupoSocial');
    }
}