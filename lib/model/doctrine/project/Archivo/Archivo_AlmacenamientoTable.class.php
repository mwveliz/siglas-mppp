<?php


class Archivo_AlmacenamientoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_Almacenamiento');
    }
    
    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('a.*')
            ->from('Archivo_Almacenamiento a')
            ->where('a.estante_id = ?', sfContext::getInstance()->getUser()->getAttribute('estante_id'))
            ->orderBy('a.serie_documental_id');

        return $q;
    }
}