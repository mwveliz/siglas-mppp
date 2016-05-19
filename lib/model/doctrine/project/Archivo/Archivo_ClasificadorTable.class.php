<?php


class Archivo_ClasificadorTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_Clasificador');
    }
    
    public function detallesClasificadores($serie_id)
    {
            $q = Doctrine_Query::create()
                ->select('c.*')
                ->addSelect('(SELECT COUNT(ec.id) FROM Archivo_ExpedienteClasificador ec WHERE ec.clasificador_id = c.id) as clasificados')
                ->from('Archivo_Clasificador c')
                ->where('c.serie_documental_id = ?', $serie_id)
                ->orderBy('c.orden');

            return $q->execute();
    }
}