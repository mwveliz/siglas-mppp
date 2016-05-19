<?php


class Archivo_DocumentoEtiquetaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_DocumentoEtiqueta');
    }
    
    public function valoresEtiquetas($documento_id)
    {
            $q = Doctrine_Query::create()
                ->select('de.*, e.id as etiqueta_id, e.nombre as etiqueta')
                ->from('Archivo_DocumentoEtiqueta de')
                ->innerJoin('de.Archivo_Etiqueta e')
                ->where('de.documento_id = ?', $documento_id)
                ->orderBy('e.orden');

            return $q->execute();
    }
}