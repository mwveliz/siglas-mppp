<?php


class Archivo_PrestamoArchivoTable extends BaseDoctrineTable
{

    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_PrestamoArchivo');
    }

    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('pa.*')
            ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = pa.id_update LIMIT 1) as user_update')
            ->from('Archivo_PrestamoArchivo pa')
            ->where('pa.expediente_id = ?', sfContext::getInstance()->getUser()->getAttribute('expediente_id'))
            ->orderBy('id desc');

        return $q;
    }

    public function prestamosActivos($expediente_id)
    {
            $q = Doctrine_Query::create()
                ->select('pa.*')
                ->from('Archivo_PrestamoArchivo pa')
                ->Where('pa.expediente_id = ?', $expediente_id)
                ->andWhereIn('pa.status', array('A','E'))
                ->execute();

            return $q;
    }

    public function seriesPrestadas()
    {
        //Seleccion de serie documental en filtro, adaptado a bandeja
            $q = Doctrine_Query::create()
                ->select('sd.id as id, sd.nombre as nombre, pa.id, e.id')
                ->from('Archivo_PrestamoArchivo pa')
                ->innerJoin('pa.Archivo_Expediente e')
                ->innerJoin('e.Archivo_SerieDocumental sd')
                ->Where('pa.funcionario_id = ?', sfContext::getInstance()->getUser()->getAttribute('funcionario_id'))
                ->andWhereIn('pa.status', array('A','E'))
                ->execute();

            return $q;
    }
}