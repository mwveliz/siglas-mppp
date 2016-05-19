<?php


class Correspondencia_CorrelativosFormatosTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_CorrelativosFormatos');
    }
    
    public function filtralPorUnidad($unidad_id) {
        $q = Doctrine_Query::create()
            ->select('cf.*')
            ->from('Correspondencia_CorrelativosFormatos cf')
            ->where('cf.unidad_correlativo_id in
                        (SELECT uc.id FROM Correspondencia_UnidadCorrelativo uc
                        WHERE uc.unidad_id = '.$unidad_id.')')
            ->execute();

        return $q;
    }
}