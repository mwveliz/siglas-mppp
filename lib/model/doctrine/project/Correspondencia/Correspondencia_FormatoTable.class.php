<?php


class Correspondencia_FormatoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_Formato');
    }
    
    public function filtrarPorCorrespondencia($correspondencia_id)
    {
            $q = Doctrine_Query::create()
                ->select('cad.*,tad.nombre as tadnombre')
                ->from('Correspondencia_Formato cad')
                ->innerjoin('cad.Correspondencia_TipoFormato tad')
                ->where('cad.correspondencia_id = ?', $correspondencia_id)
                ->limit(1)
                ->useResultCache(true, 3600, 'correspondencia_enviada_list_formato_'.$correspondencia_id);

            return $q->execute();
    }

    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
            $q = Doctrine_Query::create()
                ->select('cad.*,tad.nombre as tadnombre')
                ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = cad.id_update LIMIT 1) as user_update')
                ->from('Correspondencia_Formato cad')
                ->innerjoin('cad.Correspondencia_TipoFormato tad')
                ->where('cad.correspondencia_id = ?', sfContext::getInstance()->getUser()->getAttribute('correspondencia_id'))
                ->orderBy('tad.nombre')
                ->useResultCache(true, 3600, 'correspondencia_formato_list_'.sfContext::getInstance()->getUser()->getAttribute('correspondencia_id'));

            return $q;

    }
}