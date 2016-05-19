<?php


class Proveedores_TipoEmpresaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Proveedores_TipoEmpresa');
    }
}