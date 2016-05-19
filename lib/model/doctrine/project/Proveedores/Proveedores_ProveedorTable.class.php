<?php


class Proveedores_ProveedorTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Proveedores_Proveedor');
    }
}