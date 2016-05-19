<?php


class Correspondencia_VistobuenoGeneralConfigTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_VistobuenoGeneralConfig');
    }
}