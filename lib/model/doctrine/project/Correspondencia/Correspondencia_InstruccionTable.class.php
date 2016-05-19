<?php


class Correspondencia_InstruccionTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_Instruccion');
    }
    
    public function instruccionesUnidad($unidad_id) 
    {
            $q = Doctrine_Query::create()
                ->select('i.*')
                ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = i.id_update LIMIT 1) as user_update')
                ->from('Correspondencia_Instruccion i')
                ->where('i.unidad_id = ?', $unidad_id)
                ->orderBy('i.descripcion')
                ->execute();

            return $q;
    }
}