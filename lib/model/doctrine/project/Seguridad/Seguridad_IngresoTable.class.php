<?php


class Seguridad_IngresoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Seguridad_Ingreso');
    }
    
    public function innerList() {

        $q = Doctrine_Query::create()
            ->select('i.*, p.ci as cedula,
                      p.primer_nombre as persona_primer_nombre, p.segundo_nombre as persona_segundo_nombre,
                      p.primer_apellido as persona_primer_apellido, p.segundo_apellido as persona_segundo_apellido,
                      p.f_nacimiento as f_nacimiento, m.descripcion as motivo_clasificado,
                      u.nombre as unidad, 
                      f.primer_nombre as funcionario_primer_nombre, f.segundo_nombre as funcionario_segundo_nombre,
                      f.primer_apellido as funcionario_primer_apellido, f.segundo_apellido as funcionario_segundo_apellido,')
            ->addSelect('(SELECT ur.nombre FROM Acceso_Usuario ur WHERE ur.id = i.registrador_id LIMIT 1) as registrador')
            ->addSelect('(SELECT ud.nombre FROM Acceso_Usuario ud WHERE ud.id = i.despachador_id LIMIT 1) as despachador')
            ->from('Seguridad_Ingreso i')
            ->innerJoin('i.Seguridad_Persona p')
            ->innerJoin('i.Seguridad_Motivo m')
            ->innerJoin('i.Organigrama_Unidad u')
            ->leftJoin('i.Funcionarios_Funcionario f')
            ->where('i.status = ?','A')
            ->orderBy('i.f_ingreso desc');
        
        if (!sfContext::getInstance()->getUser()->hasCredential(array('Administrador','Root','Seguridad y Recepción'),false)) {
            
            $session_cargos = sfContext::getInstance()->getUser()->getAttribute('session_cargos');
            foreach ($session_cargos as $session_cargo) {
                $unidad_ids[] = $session_cargo['unidad_id'];
            }
            
            $q->andWhereIn('u.id', $unidad_ids);   
        }

        return $q;
    }
    
    public function ingresosAnteriores($persona_id, $status) {

        $q = Doctrine_Query::create()
            ->select('i.*, m.descripcion as motivo_clasificado, u.nombre as unidad, 
                      f.primer_nombre as funcionario_primer_nombre,
                      f.primer_apellido as funcionario_primer_apellido')
            ->addSelect('(SELECT ur.nombre FROM Acceso_Usuario ur WHERE ur.id = i.registrador_id LIMIT 1) as registrador') 
            ->from('Seguridad_Ingreso i')
            ->innerJoin('i.Seguridad_Motivo m')
            ->innerJoin('i.Organigrama_Unidad u')
            ->leftJoin('i.Funcionarios_Funcionario f')
            ->where('i.persona_id = ?',$persona_id)
            ->andWhere('i.status = ?',$status)
            ->orderBy('i.id desc')
            ->execute();

        return $q;
    }
    
    public function preingresos($persona_id, $status) {

        $q = Doctrine_Query::create()
            ->select('i.*, m.descripcion as motivo_clasificado, u.nombre as unidad, 
                      f.primer_nombre as funcionario_primer_nombre,
                      f.primer_apellido as funcionario_primer_apellido,
                      pi.f_ingreso_posible_inicio as f_ingreso_posible_inicio, pi.f_ingreso_posible_final as f_ingreso_posible_final')
            ->addSelect('(SELECT uc.nombre FROM Acceso_Usuario uc WHERE uc.id = pi.id_create LIMIT 1) as user_create')
            ->from('Seguridad_Ingreso i')
            ->innerJoin('i.Seguridad_Motivo m')
            ->innerJoin('i.Seguridad_Preingreso pi')
            ->innerJoin('i.Organigrama_Unidad u')
            ->leftJoin('i.Funcionarios_Funcionario f')
            ->where('i.persona_id = ?',$persona_id)
            ->andWhere('i.status = ?',$status)
            ->orderBy('i.id desc')
            ->limit(1)
            ->execute();

        return $q;
    }
    
    public function personasPreingreso($preingreso_id,$personas_saltadas = array(0)) {

        $q = Doctrine_Query::create()
            ->select('i.*, p.ci as ci, p.primer_nombre as primer_nombre, p.primer_apellido as primer_apellido,
                      p.f_nacimiento as f_nacimiento, p.nacionalidad as nacionalidad, p.telefono as telefono,
                      p.correo_electronico as correo_electronico')
            ->from('Seguridad_Ingreso i')
            ->innerJoin('i.Seguridad_Persona p')
            ->where('i.preingreso_id = ?',$preingreso_id)
            ->andWhere('i.status = ?','P')
            ->andWhereNotIn('i.persona_id',$personas_saltadas) 
            ->orderBy('i.id desc')
            ->execute();

        return $q;
    }
    
    
    
    public function getStatisticMotivos($fecha_inicio,$fecha_final) {
        $visitas = Doctrine_Query::create()
                ->select("m.id, m.descripcion")

                ->addSelect("(SELECT COUNT(i.id)
                             FROM Seguridad_Ingreso i
                             WHERE i.motivo_id = m.id
                             AND i.created_at >= '".$fecha_inicio."' 
                             AND i.created_at <= '".$fecha_final."') as total")

                ->from('Seguridad_Motivo m')
                ->where('m.id <> 100000')
                ->execute(array(), Doctrine::HYDRATE_NONE); 

        $motivos=array();
        foreach ($visitas as $visita) {
            if($visita[2]>0){
                $motivos[$visita[1]] = $visita[2];
            }
        }
        
        return $motivos;
    }
    
    public function getStatisticUnidades($fecha_inicio,$fecha_final) {
        $visitas = Doctrine_Query::create()
                ->select("u.id, u.nombre")

                ->addSelect("(SELECT COUNT(i.id)
                             FROM Seguridad_Ingreso i
                             WHERE i.unidad_id = u.id
                             AND i.created_at >= '".$fecha_inicio."' 
                             AND i.created_at <= '".$fecha_final."') as total")

                ->from('Organigrama_Unidad u')
                ->where('u.status = ?','A')
                ->execute(array(), Doctrine::HYDRATE_NONE); 

        $unidades=array();
        foreach ($visitas as $visita) {
            if($visita[2]>0){
                $unidades[$visita[1]] = $visita[2];
            }
        }
        
        return $unidades;
    }
    
    public function getStatisticFechas($fecha_inicio,$fecha_final) {
        $fechas_ingreso = Doctrine_Query::create()
                ->select("to_date(to_char(i.created_at, 'YYYY/MM/DD'), 'YYYY/MM/DD') as fecha, COUNT(i.id) as total")
                ->from('Seguridad_Ingreso i')
                ->where('i.status = ?','A')
                ->andWhere("i.created_at >= '".$fecha_inicio."'")
                ->andWhere("i.created_at <= '".$fecha_final."'")
                ->groupBy('fecha')
                ->orderBy('fecha')
                ->execute(array(), Doctrine::HYDRATE_NONE); 

        
        $recibida_historico=array();
        foreach ($fechas_ingreso as $fecha_ingreso) {
            $fecha = date('d-m-Y', strtotime($fecha_ingreso[0]));
            $recibida_historico[$fecha] = $fecha_ingreso[1];
        }        
       
        return $recibida_historico;
    }
    
    public function getStatisticVigilantes($fecha_inicio,$fecha_final) {
        $vigilantes = Doctrine_Query::create()
                ->select("i.registrador_id, COUNT(i.id) as total")
                ->from('Seguridad_Ingreso i')
                ->where('i.status = ?','A')
                ->andWhere('i.f_ingreso >= ?',$fecha_inicio)
                ->andWhere('i.f_ingreso <= ?',$fecha_final)
                ->groupBy('i.registrador_id')
                ->orderBy('total desc')
                ->execute(array(), Doctrine::HYDRATE_NONE); 
        
        $registrados_por=array();
        foreach ($vigilantes as $vigilante) {

            $funcionario = Doctrine_Query::create()
                ->select("f.id, f.ci, f.primer_nombre, f.primer_apellido")
                ->from('Funcionarios_Funcionario f')
                ->where('f.id IN 
                         (SELECT u.usuario_enlace_id 
                          FROM Acceso_Usuario u 
                          WHERE u.id = '.$vigilante[0].')')
                ->execute(array(), Doctrine::HYDRATE_NONE); 

            $registrados_por[$funcionario[0][0]] = array(
                'cedula' => $funcionario[0][1],
                'nombre' => $funcionario[0][2].' '.$funcionario[0][3],
                'total' => $vigilante[1]
                );
        }  
        
        return $registrados_por;
    }
    
    public function getStatisticPersonas($fecha_inicio,$fecha_final) {   
        
        // BUSCANDO LOS TOTALES DE VISITAS ORDENADOS
        $visitantes_totales = Doctrine_Query::create()
                ->select("i.persona_id, COUNT(i.id) as total")
                ->from('Seguridad_Ingreso i')
                ->where('i.status = ?','A')
                ->andWhere('i.f_ingreso >= ?',$fecha_inicio)
                ->andWhere('i.f_ingreso <= ?',$fecha_final)
                ->groupBy('i.persona_id')
                ->orderBy('total desc')
                ->execute(array(), Doctrine::HYDRATE_NONE); 
        
        $personas_visitas=array();
        foreach ($visitantes_totales as $visitante_total) {

            $personas_visitas[$visitante_total[0]] = array();
            $personas_visitas[$visitante_total[0]]['total'] = $visitante_total[1];
        }  
        
        // BUSCANDO LOS DETALLES DE LA VISITA
        $visitantes_detalles = Doctrine_Query::create()
                ->select("i.persona_id, i.imagen, i.f_ingreso, i.f_egreso, 
                          p.ci, p.primer_nombre, p.primer_apellido, 
                          u.nombre,
                          m.descripcion")
                ->from('Seguridad_Ingreso i')
                ->innerJoin('i.Seguridad_Persona p')
                ->innerJoin('i.Organigrama_Unidad u')
                ->innerJoin('i.Seguridad_Motivo m')
                ->where('i.status = ?','A')
                ->andWhere('i.f_ingreso >= ?',$fecha_inicio)
                ->andWhere('i.f_ingreso <= ?',$fecha_final)
                ->orderBy('i.id desc')
                ->execute(array(), Doctrine::HYDRATE_NONE); 
        
        foreach ($visitantes_detalles as $visitante_detalle) {
            $personas_visitas[$visitante_detalle[0]]['ci'] = $visitante_detalle[4];
            $personas_visitas[$visitante_detalle[0]]['nombre'] = $visitante_detalle[5];
            $personas_visitas[$visitante_detalle[0]]['apellido'] = $visitante_detalle[6];
            
            $visita['foto'] = $visitante_detalle[1];
            $visita['f_ingreso'] = $visitante_detalle[2];
            $visita['f_egreso'] = $visitante_detalle[3];
            $visita['unidad'] = $visitante_detalle[7];
            $visita['motivo'] = $visitante_detalle[8];
            
            $personas_visitas[$visitante_detalle[0]]['visitas'][] = $visita;
        }  
        
        return $personas_visitas;
    }
}