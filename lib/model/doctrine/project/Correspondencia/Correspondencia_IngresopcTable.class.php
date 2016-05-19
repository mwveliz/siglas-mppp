<?php

class Correspondencia_IngresopcTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_Ingresopc');
    }
    
    public function obteneridingreso($correspondencia_id)
    {
            $q = Doctrine_Query::create()
                ->select('i.*')
                ->from('Correspondencia_Ingresopc i')
                ->where('i.correspondencia_id = ?', $correspondencia_id);
              
             return $q->execute();

          
    }
}
