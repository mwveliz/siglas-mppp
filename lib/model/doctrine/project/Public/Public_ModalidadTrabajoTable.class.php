<?php


class Public_ModalidadTrabajoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_ModalidadTrabajo');
    }
}