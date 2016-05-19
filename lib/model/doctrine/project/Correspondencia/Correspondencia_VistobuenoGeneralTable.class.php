<?php


class Correspondencia_VistobuenoGeneralTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_VistobuenoGeneral');
    }
    
    public function vistobuenoGeneral($vistobueno_general_config_id) {
        $q = Doctrine_Query::create()
            ->select('vg.*')
            ->from('Correspondencia_VistobuenoGeneral vg')
            ->where('vg.vistobueno_general_config_id = ?', $vistobueno_general_config_id)
            ->andWhere('vg.status = ?', 'A')
            ->orderby('vg.orden DESC')
            ->execute();

        return $q;
    }
}