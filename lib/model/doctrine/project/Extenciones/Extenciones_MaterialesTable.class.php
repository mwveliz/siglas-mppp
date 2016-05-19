<?php


class Extenciones_MaterialesTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Extenciones_Materiales');
    }
    
    public function comboMateriales()
    {
        $q = Doctrine_Query::create()
            ->select('mc.*')
            ->from('Extenciones_MaterialClasificacion mc')
            ->orderby('mc.nombre')
            ->execute();

            //->useResultCache(true, 3600, 'cache_materiales_combo_'.$material_clasificacion_id);

        $opciones=array(''=>'');
        foreach ($q as $clasificacion) {
            $materiales=$this->porClasificacion($clasificacion->getId());
            
            $pre_opciones=array();
            foreach ($materiales as $material) {
                $pre_opciones[$material->getId()]=$material->getNombre().' --- '.$material->getUnidadMedida();
            }
            $opciones[$clasificacion->getNombre()]=$pre_opciones;
        }

        //$opciones = array_unique($opciones);
        return $opciones;
    }
    
    public function porClasificacion($material_clasificacion_id)
    {
        $q = Doctrine_Query::create()
            ->select('m.*, um.nombre as unidad_medida')
            ->from('Extenciones_Materiales m')
            ->innerJoin('m.Extenciones_UnidadMedida um')
            ->where('m.material_clasificacion_id = ?',$material_clasificacion_id)
            ->orderby('m.nombre');

            //->useResultCache(true, 3600, 'cache_materiales_combo_'.$material_clasificacion_id);

        return $q->execute();
    }    
}