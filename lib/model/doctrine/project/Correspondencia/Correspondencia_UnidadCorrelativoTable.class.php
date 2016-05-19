<?php


class Correspondencia_UnidadCorrelativoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_UnidadCorrelativo');
    }

    public function getNomenclador()
    {
        $nomencladores = sfYaml::load(sfConfig::get("sf_root_dir")."/config/siglas/nomencladores.yml");
        
        $nomencladores_activos = array();
        foreach ($nomencladores['correspondencia'] as $nomenclador => $status) {
            if($status==true){
                $nomencladores_activos[$nomenclador]=$nomenclador;
            }
        }
        
        return $nomencladores_activos;
    }

    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
            if(sfContext::getInstance()->getUser()->getAttribute('pae_funcionario_unidad_id'))
                $funcionario_unidad_id= sfContext::getInstance()->getUser()->getAttribute('pae_funcionario_unidad_id');
            else
                $funcionario_unidad_id= sfContext::getInstance()->getUser()->getAttribute('funcionario_unidad_id');

            $q = Doctrine_Query::create()
                ->select('cuc.*')
                ->from('Correspondencia_UnidadCorrelativo cuc')
                ->where('cuc.unidad_id = ?', $funcionario_unidad_id)
                ->andWhere('cuc.status = ?','A');

            return $q;
    }
    
    public function correlativosUnidad($unidad_id) 
    {
            $q = Doctrine_Query::create()
                ->select('cuc.*')
                ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = cuc.id_update LIMIT 1) as user_update')
                ->from('Correspondencia_UnidadCorrelativo cuc')
                ->where('cuc.unidad_id = ?', $unidad_id)
                ->andWhere('cuc.status = ?','A')
                ->orderBy('cuc.letra')
                ->execute();

            return $q;
    }
    
    public function actualUnidadFormato($unidad_id,$tipo_formato_id) {
        $q = Doctrine_Query::create()
            ->select('uc.id, uc.ultimo_correlativo')
            ->from('Correspondencia_UnidadCorrelativo uc')
            ->innerJoin('uc.Correspondencia_CorrelativosFormatos cf')
            ->where('uc.unidad_id = ?',$unidad_id)
            ->andWhere('cf.tipo_formato_id = ?',$tipo_formato_id)
            ->execute();

        return $q;
    }
    
    public function allCorrelativosReport($unidad_id) {
        $q = Doctrine_Query::create()
            ->select('COUNT(uc.id) as total')
            ->from('Correspondencia_UnidadCorrelativo uc')
            ->where('uc.unidad_id = ?',$unidad_id)
            ->andWhere('uc.status = ?', 'A')
            ->execute(array(), Doctrine::HYDRATE_NONE);

        return $q;
    }
    
    public function correlativosUnidades($unidad_ids,$tipos_hijos=null) {
        $q = Doctrine_Query::create()
            ->select('cf.id, uc.id as unidad_correlativo, uc.unidad_id as unidad_id, uc.descripcion as descripcion_correlativo, cf.tipo_formato_id as tipo_formato_id, tf.nombre as tipo_formato')
            ->from('Correspondencia_CorrelativosFormatos cf')
            ->innerJoin('cf.Correspondencia_UnidadCorrelativo uc')
            ->innerJoin('cf.Correspondencia_TipoFormato tf')
            ->whereIn('uc.unidad_id',$unidad_ids)
            ->andWhere('uc.tipo = ?','E')
            ->andWhere('uc.status = ?','A')
            ->andWhere('tf.tipo = ?','C')
            ->orderBy('tf.nombre');

        if($tipos_hijos!=null)
            $q->andWhereIn('cf.tipo_formato_id',$tipos_hijos);
        else
            $q->andWhere('tf.principal = ?',true);
       
        return $q->execute();
    }
}