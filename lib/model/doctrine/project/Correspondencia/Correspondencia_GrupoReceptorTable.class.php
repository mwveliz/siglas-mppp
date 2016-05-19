<?php


class Correspondencia_GrupoReceptorTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_GrupoReceptor');
    }
    
    public function getNombres($tipo)
    {
        $unidadId = sfContext::getInstance()->getUser()->getAttribute('funcionario_unidad_id');
        
        $q = Doctrine_Query::create()
             ->select('gr.nombre, gr.id, gr.grupo_id, gr.grupo_id as id')
             ->from('Correspondencia_GrupoReceptor gr')
             ->where('gr.unidad_duena_id = ?', $unidadId)
             ->andWhere('gr.tipo = ?', $tipo)
             ->groupBy('gr.id, gr.grupo_id, gr.nombre')
             ->execute();
        
        return $q;
    }

    public function getReceptores($grupo_id)
    {
        $unidadId = sfContext::getInstance()->getUser()->getAttribute('funcionario_unidad_id');
        
        $q = Doctrine_Query::create()
             ->select('gr.unidad_receptor_id, gr.cargo_receptor_id')
             ->from('Correspondencia_GrupoReceptor gr')
             ->where('gr.unidad_duena_id = ?', $unidadId)
             ->andWhere('gr.grupo_id = ?', $grupo_id)
             ->execute();
        
        return $q;
    }
}