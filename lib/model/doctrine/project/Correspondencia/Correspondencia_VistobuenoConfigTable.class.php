<?php


class Correspondencia_VistobuenoConfigTable extends BaseDoctrineTable
{

    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_VistobuenoConfig');
    }

    public function vistobuenoConfigUnidad($id_grupo) {
        $q = Doctrine_Query::create()
            ->select('cv.*')
            ->from('Correspondencia_VistobuenoConfig cv')
            ->where('cv.funcionario_unidad_id = ?', $id_grupo)
            ->orderby('cv.orden DESC')
            ->execute();

        return $q;
    }
}