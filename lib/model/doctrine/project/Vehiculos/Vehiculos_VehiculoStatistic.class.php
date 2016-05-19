<?php

class Vehiculos_VehiculoStatistic {
   
     public function servicios($fecha_inicio,$fecha_final) {
            $fecha_actual= date('Y-m-d H:i:s');
            
            $servicios_total = Doctrine_Query::create()
                    ->select("u.id")
                    //PENDIENTE
                    ->addSelect("(SELECT COUNT(c3.id)
                                 FROM Vehiculos_Mantenimiento c3
                                 WHERE c3.vehiculo_id = u.id
                                 AND c3.status IN ('A')
                                 AND (c3.fecha <= '".$fecha_actual."' OR c3.kilometraje <= u.kilometraje_actual) 
                                 AND c3.created_at >= '".$fecha_inicio."' 
                                 AND c3.created_at <= '".$fecha_final."') as pendientes")
                    //PROGRAMADO
                    ->addSelect("(SELECT COUNT(c4.id)
                                 FROM Vehiculos_Mantenimiento c4
                                 WHERE c4.vehiculo_id = u.id
                                 AND c4.status IN ('A')
                                 AND (c4.fecha > '".$fecha_actual."' OR c4.kilometraje > u.kilometraje_actual) 
                                 AND c4.created_at >= '".$fecha_inicio."' 
                                 AND c4.created_at <= '".$fecha_final."') as programadas")
                    //EFECTUADO
                    ->addSelect("(SELECT COUNT(c5.id)
                                 FROM Vehiculos_Mantenimiento c5
                                 WHERE c5.vehiculo_id = u.id
                                 AND c5.status IN ('C')
                                 AND (c5.fecha <= '".$fecha_actual."' OR c5.kilometraje <= u.kilometraje_actual)
                                 AND c5.created_at >= '".$fecha_inicio."' 
                                 AND c5.created_at <= '".$fecha_final."') as efectuadas")
                    
                    ->from('Vehiculos_Vehiculo u')
                    ->innerJoin('u.Vehiculos_GpsVehiculo gv')
                    ->where('u.status = ?', 'A')
                    ->andWhere('gv.status = ?', 'A')
                    ->execute(array(), Doctrine::HYDRATE_NONE);

            $ar= array();
            foreach($servicios_total as $val) {
                $ar['pendientes'][]= $val[1];
                $ar['programados'][]= $val[2];
                $ar['efectuados'][]= $val[3];
            }
            
        return $ar;
    }
}
