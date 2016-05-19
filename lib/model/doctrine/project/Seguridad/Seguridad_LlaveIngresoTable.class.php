<?php


class Seguridad_LlaveIngresoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Seguridad_LlaveIngreso');
    }
    
    public function todasOrdenadas(){
        $q = Doctrine_Query::create()
                ->select('lli.*')
                ->from('Seguridad_LlaveIngreso lli')
                ->orderBy('n_pase asc')
                ->execute();
        return $q;
    }
    
    public function getDataNPaseSimilar($string){
        $q = Doctrine_Query::create()
                ->select('lli.*')
                ->from('Seguridad_LlaveIngreso lli')
                ->where('lli.n_pase ILIKE ?', '%'.$string.'%')
//                ->andWhere('lli.status <> ?','O')
                ->orderBy('n_pase asc') 
                ->execute()
                ->getData();
        return $q;
   } 
}