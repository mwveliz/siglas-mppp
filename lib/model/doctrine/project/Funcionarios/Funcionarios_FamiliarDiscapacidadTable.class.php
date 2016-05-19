<?php


class Funcionarios_FamiliarDiscapacidadTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_FamiliarDiscapacidad');
    }
    
    public function datosDiscapacidadFamiliar($familiar_id)
    {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Funcionarios_FamiliarDiscapacidad c')
            ->where('c.familiar_id = ?', $familiar_id)
            ->andWhereIn('c.status', array('A','V'))
            ->orderBy('c.id DESC');

        return $q->execute();
    } 
    
}