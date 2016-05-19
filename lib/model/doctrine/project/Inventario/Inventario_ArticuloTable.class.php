<?php


class Inventario_ArticuloTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Inventario_Articulo');
    }
    
    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('a.*, um.nombre as unidad_medida')
            ->addSelect('(SELECT SUM(i.cantidad_actual) FROM Inventario_Inventario i WHERE i.articulo_id = a.id) as cantidad_actual')
            ->from('Inventario_Articulo a')
            ->innerJoin('a.Inventario_UnidadMedida um')
            ->orderBy('a.nombre');

        return $q;
    }
    
    public function articulosActivosOrden($orden)
    {
        $q = Doctrine_Query::create()
            ->select('a.*, um.nombre as unidad_medida')
//            ->addSelect('(SELECT SUM(i.cantidad_actual) FROM Inventario_Inventario i WHERE i.articulo_id = a.id) as cantidad_actual')
            ->from('Inventario_Articulo a')
            ->innerJoin('a.Inventario_UnidadMedida um')
            ->orderBy('a.'.$orden)
            ->execute();

        return $q;
    }
    
    public function cantidadActualArticulos($articulo_ids)
    {
        $q = Doctrine_Query::create()
            ->select('a.*, um.nombre as unidad_medida')
            ->addSelect('(SELECT SUM(i.cantidad_actual) FROM Inventario_Inventario i WHERE i.articulo_id = a.id) as cantidad_actual')
            ->from('Inventario_Articulo a')
            ->innerJoin('a.Inventario_UnidadMedida um')
            ->whereIn('a.id',$articulo_ids)
            ->execute();

        return $q;
    }
}