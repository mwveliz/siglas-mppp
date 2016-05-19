<?php


class Archivo_ExpedienteClasificadorTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_ExpedienteClasificador');
    }

    public function valoresClasificadores($expediente_id)
    {
            $q = Doctrine_Query::create()
                ->select('ec.*, c.nombre as clasificador')
                ->from('Archivo_ExpedienteClasificador ec')
                ->innerJoin('ec.Archivo_Clasificador c')
                ->where('ec.expediente_id = ?', $expediente_id)
                ->orderBy('c.orden');

            return $q->execute();
    }
}