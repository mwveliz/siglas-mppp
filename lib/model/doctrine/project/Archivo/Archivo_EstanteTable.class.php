<?php


class Archivo_EstanteTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_Estante');
    }
    
    public function getTramos()
    {
        for($i=1;$i<=30;$i++) $tramos[$i]=$i;
        return $tramos;
    }
    
    public function estantesDeSerieDeUnidadesDuenas($unidades_ids,$serie_id)
    {
            $q = Doctrine_Query::create()
                ->select('e.*')
                ->from('Archivo_Estante e')
                ->whereIn('e.unidad_duena_id', $unidades_ids)
                ->andWhere('e.id IN (SELECT al.estante_id FROM Archivo_Almacenamiento al 
                            WHERE al.serie_documental_id = '.$serie_id.')');

            return $q->execute();
    }
    
    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('e.*')
            ->from('Archivo_Estante e')
            ->where('e.unidad_duena_id = ?', sfContext::getInstance()->getUser()->getAttribute('funcionario_unidad_id'))
            ->orderBy('e.identificador');

        return $q;
    }
    
    public function estanteUnidad($unidad_id)
    {
        $q = Doctrine_Query::create()
            ->select('e.*')
            ->from('Archivo_Estante e')
            ->where('e.unidad_duena_id = ?', $unidad_id)
            ->orderBy('e.identificador')
            ->execute();

        return $q;
    }
}