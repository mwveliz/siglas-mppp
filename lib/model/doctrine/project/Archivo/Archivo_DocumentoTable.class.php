<?php


class Archivo_DocumentoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_Documento');
    }
    
    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('d.*')
            ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = d.id_update LIMIT 1) as user_update')
            ->from('Archivo_Documento d')
            ->where('d.expediente_id = ?', sfContext::getInstance()->getUser()->getAttribute('expediente_id'))
            ->andWhere('d.status = ?','A')
            ->orderBy('d.correlativo');

        return $q;
    }
}