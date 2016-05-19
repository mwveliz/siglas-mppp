<?php

class Inventario_ArticuloStatistic
{
    public function linearIngresosEgresos($articulo)
    {
        $graph = array();
        $fechaEgreso = '';
        $fechaIngreso = '';
        $ingresos = Doctrine_Query::create()
                ->select("iai.f_ingreso,ii.cantidad_actual,ia.nombre")
                ->from("Inventario_ArticuloIngreso iai,
                        Inventario_Inventario ii,
                        Inventario_Articulo ia")
                ->where("ia.id = ?", $articulo)
                ->andWhere("ia.id = ii.articulo_id")
                ->andWhere("ii.articulo_ingreso_id = iai.id")
                ->execute(array(), Doctrine::HYDRATE_NONE); 
        
        $egresos = Doctrine_Query::create()
                ->select("iae.f_egreso,iae.cantidad,iae.articulo_id")
                ->from("Inventario_ArticuloEgreso iae")
                ->where("iae.articulo_id = ?",$articulo)
                ->execute(array(), Doctrine::HYDRATE_NONE); 

        foreach($egresos as $egreso)
        {
            if($fechaEgreso == (date('Y-m',  strtotime($egreso[0]))))
            {
                $graph["egresos"][$fechaEgreso] += $egreso[1];
            }
            else
            {
                $graph['datos']['id'] = $egreso[2];
                $fechaEgreso = date('Y-m',  strtotime($egreso[0]));
                $graph["egresos"][$fechaEgreso] = $egreso[1];
            }
        }
        
        foreach($ingresos as $ingreso)
        {
            if($fechaIngreso == (date('Y-m',  strtotime($ingreso[0]))))
            {
                $graph["ingresos"][$fechaIngreso] += $ingreso[1];
            }
            else
            {
                $fechaIngreso = date('Y-m',  strtotime($ingreso[0]));
                $graph["ingresos"]["$fechaIngreso"] = $ingreso[1];
                $graph['datos']['nombre'] = $ingreso[2];
            }
        }
        
        return $graph;
        
    }
}
?>

