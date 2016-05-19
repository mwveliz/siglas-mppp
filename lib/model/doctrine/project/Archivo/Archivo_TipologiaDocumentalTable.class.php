<?php


class Archivo_TipologiaDocumentalTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_TipologiaDocumental');
    }
    
    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('td.*,cd.id as cuerpo_id, cd.nombre as cuerpo, 
                     (CASE WHEN td.cuerpo_documental_id is null THEN 0 ELSE cd.orden END) as cuerpo_orden')
            ->from('Archivo_TipologiaDocumental td')
            ->leftJoin('td.Archivo_CuerpoDocumental cd')
            ->where('td.serie_documental_id = ?', sfContext::getInstance()->getUser()->getAttribute('serie_documental_id'))
            ->andWhere('td.status = ?','A')
            ->orderBy('cuerpo_orden, cd.id, td.orden, td.nombre');

        return $q; 
    }
    
    public function tipologiasDeSerie($serie_id, $cuerpos='todos',$expediente_id=0)
    {
        
        $q = Doctrine_Query::create()
            ->select('td.*,cd.id as cuerpo_id, cd.nombre as cuerpo, 
                     (CASE WHEN td.cuerpo_documental_id is null THEN 0 ELSE cd.orden END) as cuerpo_orden')
            ->from('Archivo_TipologiaDocumental td')
            ->leftJoin('td.Archivo_CuerpoDocumental cd')
            ->where('td.serie_documental_id = ?', $serie_id)
            ->andWhere('td.status = ?','A')
            ->orderBy('cuerpo_orden, cd.id, td.orden, td.nombre');

        if($cuerpos!='todos'){
            if($cuerpos!='permitidos'){
                $q->andWhere('td.cuerpo_documental_id is '.$cuerpos);
            } else {
                $q->andWhere('td.cuerpo_documental_id IN 
                              (SELECT ecd.cuerpo_documental_id 
                              FROM Archivo_ExpedienteCuerpoDocumental ecd
                              WHERE ecd.expediente_id = '.$expediente_id.')');
            }
        }
            
        return $q->execute();
    }
}