<?php


class Public_DiscapacidadTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_Discapacidad');
    }
    
    public function datosDiscapacidadesActivas($discapacidad_id)
    {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Public_Discapacidad c')
            ->where('c.id = ?', $discapacidad_id)
            ->andWhereIn('c.status', array('A','V'));

        return $q->execute();
    }
}