<?php


class Acceso_AutorizacionModuloTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Acceso_AutorizacionModulo');
    }
    
    public function innerList()
    {
        if(sfContext::getInstance()->getUser()->getAttribute('autorizacion')=='punto_cuenta')
            $modulo = 5;
        
        $q = Doctrine_Query::create()
            ->select('am.*, concat(f.primer_nombre, \' \', f.primer_apellido) as funcionario')
            ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = am.id_update LIMIT 1) as user_update')
            ->from('Acceso_AutorizacionModulo am')
            ->innerjoin('am.Funcionarios_Funcionario f')
            ->where('am.modulo_id = ?', $modulo);

        return $q;
    }
}