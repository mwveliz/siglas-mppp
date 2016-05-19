<?php


class Inventario_InventarioTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Inventario_Inventario');
    }
    
    public function articulosComprados($ingreso_id) 
    {
        $q = Doctrine_Query::create()
            ->select('i.*, a.nombre as articulo, um.nombre as unidad_medida')
            ->from('Inventario_Inventario i')
            ->innerJoin('i.Inventario_Articulo a')
            ->innerJoin('a.Inventario_UnidadMedida um')
            ->where('i.articulo_ingreso_id = ?',$ingreso_id)
            ->orderBy('a.nombre')
            ->execute();

        return $q;
    }
    
    public function disponiblesPorArticulo($articulo_id) 
    {
        $q = Doctrine_Query::create()
            ->select('i.*, ai.f_ingreso as f_ingreso')
            ->from('Inventario_Inventario i')
            ->innerJoin('i.Inventario_ArticuloIngreso ai')
            ->where('i.articulo_id = ?',$articulo_id)
            ->orderBy('ai.f_ingreso')
            ->execute();

        return $q;
    }
    
    
}