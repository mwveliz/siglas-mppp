<?php


class Funcionarios_InformacionCorporalFamiliarTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_InformacionCorporalFamiliar');
    }
    
       public function datosCorporalFamiliar($familiar_id)
    {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Funcionarios_InformacionCorporalFamiliar c')
            ->where('c.familiar_id = ?', $familiar_id)
            ->andWhereIn('c.status', array('A','V'))
            ->orderBy('c.id DESC');

        return $q->execute();
    }
}