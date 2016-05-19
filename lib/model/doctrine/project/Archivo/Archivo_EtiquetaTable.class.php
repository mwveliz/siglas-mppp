<?php


class Archivo_EtiquetaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_Etiqueta');
    }
    
    public function detallesEtiquetaciones($tipologia_id)
    {
            $q = Doctrine_Query::create()
                ->select('e.*')
                ->addSelect('(SELECT COUNT(de.id) FROM Archivo_DocumentoEtiqueta de WHERE de.etiqueta_id = e.id) as etiquetados')
                ->from('Archivo_Etiqueta e')
                ->where('e.tipologia_documental_id = ?', $tipologia_id)
                ->orderBy('e.orden');

            return $q->execute();
    }
    
    public function etiquetasPerTipologias($tipologias)
    {
            $q = Doctrine_Query::create()
                ->select('e.*')
                ->from('Archivo_Etiqueta e')
                ->whereIn('e.tipologia_documental_id', $tipologias);

            return $q->execute();
    }
}