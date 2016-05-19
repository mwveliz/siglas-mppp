<?php


class Archivo_CompartirTable extends BaseDoctrineTable
{

    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_Compartir');
    }

    public function seriesCompartidas()
    {
        //Seleccion de serie documental en filtro, adaptado a bandeja
            $q = Doctrine_Query::create()
            ->select('sd.id as id, sd.nombre as nombre, e.id')
            ->from('Archivo_Expediente e')
            ->innerJoin('e.Archivo_SerieDocumental sd')
            ->Where('e.unidad_id IN
                (SELECT c.unidad_id FROM Archivo_Compartir c
                 INNERJOIN c.Archivo_CompartirFuncionario cf
                 WHERE cf.funcionario_id = ?)',sfContext::getInstance()->getUser()->getAttribute('funcionario_id'))
            ->andWhere('e.status = ?','A')
            ->execute();

            return $q;
    }
}