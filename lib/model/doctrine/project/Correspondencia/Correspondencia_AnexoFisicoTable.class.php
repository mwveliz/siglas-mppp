<?php


class Correspondencia_AnexoFisicoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_AnexoFisico');
    }
    
    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
            $q = Doctrine_Query::create()
                ->select('caf.*,taf.nombre as tafnombre')
                ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = caf.id_update LIMIT 1) as user_update')
                ->from('Correspondencia_AnexoFisico caf')
                ->innerjoin('caf.Correspondencia_TipoAnexoFisico taf')
                ->where('caf.correspondencia_id = ?', sfContext::getInstance()->getUser()->getAttribute('correspondencia_id'))
                ->orderBy('taf.nombre');

            return $q;
    }

    public function filtrarPorCorrespondencia($correspondencia_id)
    {
            $q = Doctrine_Query::create()
                ->select('caf.*,taf.nombre as tafnombre')
                ->from('Correspondencia_AnexoFisico caf')
                ->innerjoin('caf.Correspondencia_TipoAnexoFisico taf')
                ->where('caf.correspondencia_id = ?', $correspondencia_id)
//                ->limit(1)
                ->useResultCache(true, 3600, 'correspondencia_AnexoFisico_correspondencia_id_'.$correspondencia_id);

            return $q->execute();
    }
    
    public function fisicosPorCorrespondencia($correspondencia_id) {
        $q = Doctrine_Query::create()
            ->select('af.*, taf.nombre as nombre')
            ->from('Correspondencia_AnexoFisico af')
            ->innerJoin('af.Correspondencia_TipoAnexoFisico taf')
            ->where('af.correspondencia_id = ?', $correspondencia_id)
            ->execute();

        return $q;
    }
}