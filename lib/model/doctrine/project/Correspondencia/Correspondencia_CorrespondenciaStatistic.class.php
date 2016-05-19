<?php

class Correspondencia_CorrespondenciaStatistic {
   
     public function totalStatusEnviada($unidad_id, $fecha_inicio,$fecha_final) {
            
            $correspondencias_total = Doctrine_Query::create()
                    ->select("u.id")

                    ->addSelect("(SELECT COUNT(c3.id)
                                 FROM Correspondencia_Correspondencia c3
                                 WHERE c3.emisor_unidad_id = u.id
                                 AND c3.status IN ('C')
                                 AND c3.created_at >= '".$fecha_inicio."' 
                                 AND c3.created_at <= '".$fecha_final."') as por_firmar")

                    ->addSelect("(SELECT COUNT(c4.id)
                                 FROM Correspondencia_Correspondencia c4
                                 WHERE c4.emisor_unidad_id = u.id
                                 AND c4.status IN ('E')
                                 AND c4.created_at >= '".$fecha_inicio."' 
                                 AND c4.created_at <= '".$fecha_final."') as enviadas")

                    ->addSelect("(SELECT COUNT(c5.id)
                                 FROM Correspondencia_Correspondencia c5
                                 WHERE c5.emisor_unidad_id = u.id
                                 AND c5.status IN ('L')
                                 AND c5.created_at >= '".$fecha_inicio."' 
                                 AND c5.created_at <= '".$fecha_final."') as entregadas")
                    
                    ->addSelect("(SELECT COUNT(c6.id)
                                 FROM Correspondencia_Correspondencia c6
                                 WHERE c6.emisor_unidad_id = u.id
                                 AND c6.status IN ('P')
                                 AND c6.created_at >= '".$fecha_inicio."' 
                                 AND c6.created_at <= '".$fecha_final."') as pausadas")

                    ->addSelect("(SELECT COUNT(c7.id)
                                 FROM Correspondencia_Correspondencia c7
                                 WHERE c7.emisor_unidad_id = u.id
                                 AND c7.status IN ('D')
                                 AND c7.created_at >= '".$fecha_inicio."' 
                                 AND c7.created_at <= '".$fecha_final."') as devueltas")

                    ->from('Organigrama_Unidad u')
                    ->where("u.id = ?",$unidad_id)
                    ->execute(array(), Doctrine::HYDRATE_NONE); 


            $enviada_total = array();
            foreach ($correspondencias_total as $correspondencia_total) {                
                
                $enviada_total['por_firmar'] = $correspondencia_total[1];
                $enviada_total['enviadas'] = $correspondencia_total[2];
                $enviada_total['entregadas'] = $correspondencia_total[3];
                $enviada_total['pausadas'] = $correspondencia_total[4];
                $enviada_total['devueltas'] = $correspondencia_total[5];
            }
            
        return $enviada_total;
    }
    
    
    
     public function totalStatusEnviadaAOficinas($unidad_id, $fecha_inicio,$fecha_final) {
         
        // INICIO --- GRAFICO DE BARRAS TOTAL DE ENVIADAS POR ESTATUS A OFICINAS
        // INICIO --- GRAFICO DE TORTA TOTAL DE ENVIADAS POR ESTATUS A OFICINAS
        // INICIO --- GRAFICO DE TORTA TOTAL DE ENVIADAS POR ESTATUS A OFICINAS
         
        $correspondencias_internas = Doctrine_Query::create()
                ->select("u.id, u.nombre, u.siglas")

                ->addSelect("(SELECT COUNT(c.id)
                             FROM Correspondencia_Correspondencia c
                             WHERE (c.id IN (SELECT r.correspondencia_id
                                    FROM Correspondencia_Receptor r 
                                    WHERE r.unidad_id = u.id 
                                    AND r.establecido = 'S'))
                             AND c.emisor_unidad_id = ".$unidad_id."
                             AND c.status IN ('C','E','L','P','D')
                             AND c.created_at >= '".$fecha_inicio."' 
                             AND c.created_at <= '".$fecha_final."') as total")

                ->from('Organigrama_Unidad u')
                ->execute(array(), Doctrine::HYDRATE_NONE); 


        $i=0; $enviada_interna=array();
        foreach ($correspondencias_internas as $correspondencia_interna) {
            if($correspondencia_interna[3]>0){


                $correspondencia_interna_unidad = Doctrine_Query::create()
                        ->select("u.id, u.nombre, u.siglas")

                        ->addSelect("(SELECT COUNT(c.id)
                                     FROM Correspondencia_Correspondencia c
                                     WHERE (c.id IN (SELECT r.correspondencia_id
                                            FROM Correspondencia_Receptor r 
                                            WHERE r.unidad_id = u.id 
                                            AND r.establecido = 'S'))
                                     AND c.status IN ('C')
                                     AND c.emisor_unidad_id = ".$unidad_id."
                                     AND c.created_at >= '".$fecha_inicio."' 
                                     AND c.created_at <= '".$fecha_final."') as por_firmar")

                        ->addSelect("(SELECT COUNT(c1.id)
                                     FROM Correspondencia_Correspondencia c1
                                     WHERE (c1.id IN (SELECT r1.correspondencia_id
                                            FROM Correspondencia_Receptor r1 
                                            WHERE r1.unidad_id = u.id 
                                            AND r1.establecido = 'S'))
                                     AND c1.status IN ('E')
                                     AND c1.emisor_unidad_id = ".$unidad_id."
                                     AND c1.created_at >= '".$fecha_inicio."' 
                                     AND c1.created_at <= '".$fecha_final."') as enviadas")

                        ->addSelect("(SELECT COUNT(c2.id)
                                     FROM Correspondencia_Correspondencia c2
                                     WHERE (c2.id IN (SELECT r2.correspondencia_id
                                            FROM Correspondencia_Receptor r2 
                                            WHERE r2.unidad_id = u.id 
                                            AND r2.establecido = 'S'))
                                     AND c2.status IN ('L')
                                     AND c2.emisor_unidad_id = ".$unidad_id."
                                     AND c2.created_at >= '".$fecha_inicio."' 
                                     AND c2.created_at <= '".$fecha_final."') as entregadas")

                        ->addSelect("(SELECT COUNT(c3.id)
                                     FROM Correspondencia_Correspondencia c3
                                     WHERE (c3.id IN (SELECT r3.correspondencia_id
                                            FROM Correspondencia_Receptor r3 
                                            WHERE r3.unidad_id = u.id 
                                            AND r3.establecido = 'S'))
                                     AND c3.status IN ('P')
                                     AND c3.emisor_unidad_id = ".$unidad_id."
                                     AND c3.created_at >= '".$fecha_inicio."' 
                                     AND c3.created_at <= '".$fecha_final."') as pausadas")

                        ->addSelect("(SELECT COUNT(c4.id)
                                     FROM Correspondencia_Correspondencia c4
                                     WHERE (c4.id IN (SELECT r4.correspondencia_id
                                            FROM Correspondencia_Receptor r4 
                                            WHERE r4.unidad_id = u.id 
                                            AND r4.establecido = 'S'))
                                     AND c4.status IN ('D')
                                     AND c4.emisor_unidad_id = ".$unidad_id."
                                     AND c4.created_at >= '".$fecha_inicio."' 
                                     AND c4.created_at <= '".$fecha_final."') as devueltas")

                        ->from('Organigrama_Unidad u')
                        ->where('u.id = ?',$correspondencia_interna[0])
                        ->execute(array(), Doctrine::HYDRATE_NONE); 


                $enviada_interna[$i] = array(
                    'unidad_id' => $correspondencia_interna_unidad[0][0],
                    'unidad_nombre' => $correspondencia_interna_unidad[0][1],
                    'unidad_siglas' => $correspondencia_interna_unidad[0][2],

                    'total' => $correspondencia_interna[3],

                    'por_firmar' => $correspondencia_interna_unidad[0][3],
                    'enviadas' => $correspondencia_interna_unidad[0][4],
                    'entregadas' => $correspondencia_interna_unidad[0][5],
                    'pausadas' => $correspondencia_interna_unidad[0][6],
                    'devueltas' => $correspondencia_interna_unidad[0][7],
                );


                $i++;
            }
        }

        // REALIZE UN ORDENAMIENTO DE MAYOR A MENOR POR EL TOTAL

        return $enviada_interna;
        
        // FIN --- GRAFICO DE TORTA TOTAL DE ENVIADAS POR ESTATUS A OFICINAS
        // FIN --- GRAFICO DE TORTA TOTAL DE ENVIADAS POR ESTATUS A OFICINAS
        // FIN --- GRAFICO DE TORTA TOTAL DE ENVIADAS POR ESTATUS A OFICINAS 
    }
    
    
    
     public function totalStatusEnviadaAOrganismos($unidad_id, $fecha_inicio,$fecha_final) {
            
        // INICIO --- GRAFICO DE BARRAS TOTAL DE ENVIADAS A ORGANISMOS EXTERNOS
        // INICIO --- GRAFICO DE BARRAS TOTAL DE ENVIADAS A ORGANISMOS EXTERNOS
        // INICIO --- GRAFICO DE BARRAS TOTAL DE ENVIADAS A ORGANISMOS EXTERNOS
         
        $correspondencias_externas = Doctrine_Query::create()
               ->select("o.id, o.nombre, o.siglas")

               ->addSelect("(SELECT COUNT(c.id)
                            FROM Correspondencia_Correspondencia c
                            WHERE (c.id IN (SELECT ro.correspondencia_id
                                   FROM Correspondencia_ReceptorOrganismo ro 
                                   WHERE ro.organismo_id = o.id))
                            AND c.emisor_unidad_id = ".$unidad_id."
                            AND c.f_envio >= '".$fecha_inicio."' 
                            AND c.f_envio <= '".$fecha_final."') as total")

               ->from('Organismos_Organismo o')
               ->execute(array(), Doctrine::HYDRATE_NONE); 


       $i=0; $enviada_externa=array();
       foreach ($correspondencias_externas as $correspondencia_externa) {
           if($correspondencia_externa[3]>0){
               $enviada_externa[$i] = array(
                   'organismo_id' => $correspondencia_externa[0],
                   'organismo_nombre' => $correspondencia_externa[1],
                   'organismo_siglas' => $correspondencia_externa[2],
                   'organismo_total' => $correspondencia_externa[3],
               );
               $i++;
           }
       }            
        
        // REALIZE UN ORDENAMIENTO DE MAYOR A MENOR POR EL TOTAL

        return $enviada_externa;

        
        // FIN --- GRAFICO DE BARRAS TOTAL DE ENVIADAS A ORGANISMOS EXTERNOS
        // FIN --- GRAFICO DE BARRAS TOTAL DE ENVIADAS A ORGANISMOS EXTERNOS
        // FIN --- GRAFICO DE BARRAS TOTAL DE ENVIADAS A ORGANISMOS EXTERNOS

    }
    
    
    
     public function totalEnviadaPorDias($unidad_id, $fecha_inicio,$fecha_final) {

        // INICIO --- GRAFICO LINEAL DE TOTAL DE CREADAS EN RANGO DE TIEMPO
        // INICIO --- GRAFICO LINEAL DE TOTAL DE CREADAS EN RANGO DE TIEMPO
        // INICIO --- GRAFICO LINEAL DE TOTAL DE CREADAS EN RANGO DE TIEMPO

        $correspondencias_enviadas_rango_tiempo = Doctrine_Query::create()
               ->select("to_date(to_char(c.created_at, 'YYYY/MM/DD'), 'YYYY/MM/DD') as fecha, COUNT(c.id) as total")
               ->from('Correspondencia_Correspondencia c')
               ->where('c.emisor_unidad_id = ?',$unidad_id)
               ->andWhere("c.created_at >= '".$fecha_inicio."'")
               ->andWhere("c.created_at <= '".$fecha_final."'")
               ->groupBy('fecha')
               ->orderBy('fecha')
               ->execute(array(), Doctrine::HYDRATE_NONE); 

       $enviada_historico=array();
       foreach ($correspondencias_enviadas_rango_tiempo as $correspondencia_enviada_rango_tiempo) {
           $fecha = date('d-m-Y', strtotime($correspondencia_enviada_rango_tiempo[0]));
           $enviada_historico[$fecha] = $correspondencia_enviada_rango_tiempo[1];
       }        

        return $enviada_historico;

        // FIN --- GRAFICO LINEAL DE TOTAL DE CREADAS EN RANGO DE TIEMPO
        // FIN --- GRAFICO LINEAL DE TOTAL DE CREADAS EN RANGO DE TIEMPO
        // FIN --- GRAFICO LINEAL DE TOTAL DE CREADAS EN RANGO DE TIEMPO
    }
    
    
    
     public function totalEnviadaPorCreador($unidad_id, $fecha_inicio,$fecha_final) {
         
        // INICIO --- GRAFICO BARRAS DE TOTAL DE CREADAS POR FUNCIONARIO
        // INICIO --- GRAFICO TORTA DE TOTAL DE CREADAS POR FUNCIONARIO
        // INICIO --- GRAFICO TORTA DE TOTAL DE CREADAS POR FUNCIONARIO
            
        $correspondencias_por_personas = Doctrine_Query::create()
               ->select("c.id_update as id_update, COUNT(c.id_update) as total")
               ->from('Correspondencia_Correspondencia c')
               ->where('c.emisor_unidad_id = ?',$unidad_id)
               ->andWhere("c.created_at >= '".$fecha_inicio."'")
               ->andWhere("c.created_at <= '".$fecha_final."'")
               ->andWhereNotIn('c.status', array('A','S'))
               ->groupBy('id_update')
               ->execute(array(), Doctrine::HYDRATE_NONE); 

       $enviada_por_creador=array();
       foreach ($correspondencias_por_personas as $correspondencia_por_persona) {

           $funcionario = Doctrine_Query::create()
                  ->select("f.id, f.ci, f.primer_nombre, f.primer_apellido")
                  ->from('Funcionarios_Funcionario f')
                  ->where('f.id IN 
                           (SELECT u.usuario_enlace_id 
                            FROM Acceso_Usuario u 
                            WHERE u.id = '.$correspondencia_por_persona[0].')')
                  ->execute(array(), Doctrine::HYDRATE_NONE); 

           $enviada_por_creador[$funcionario[0][0]] = array(
                'cedula' => $funcionario[0][1],
                'nombre' => $funcionario[0][2].' '.$funcionario[0][3],
                'total' => $correspondencia_por_persona[1]
                );
       }    

        return $enviada_por_creador;
        
        // FIN --- GRAFICO TORTA DE TOTAL DE CREADAS POR FUNCIONARIO
        // FIN --- GRAFICO TORTA DE TOTAL DE CREADAS POR FUNCIONARIO
        // FIN --- GRAFICO TORTA DE TOTAL DE CREADAS POR FUNCIONARIO
    }
    
    
// BANDEJA DE RECIBIDAS
// BANDEJA DE RECIBIDAS
// BANDEJA DE RECIBIDAS
// BANDEJA DE RECIBIDAS
// BANDEJA DE RECIBIDAS
    
    public function totalStatusRecibida($unidad_id, $fecha_inicio,$fecha_final) {
            
            $correspondencias_total = Doctrine_Query::create()
                        ->select('c.status as status, COUNT(c.status) as total')
                        ->from('Correspondencia_Correspondencia c')

                
                        ->where("c.id IN (SELECT r.correspondencia_id
                                    FROM Correspondencia_Receptor r 
                                    WHERE r.unidad_id = ".$unidad_id."
                                    AND r.establecido = 'S'")
                
                        ->andWhereIn('c.status', array('E', 'L', 'D'))
                        ->andWhere("c.f_envio >= '".$fecha_inicio."'")
                        ->andWhere("c.f_envio <= '".$fecha_final."'")
                        ->groupBy('c.status')
                        ->execute(array(), Doctrine::HYDRATE_NONE);

            $recibida_total = array();    
            foreach ($correspondencias_total as $correspondencia_total) { 
                $recibida_total[$correspondencia_total[0]] = $correspondencia_total[1];
            }
            
            
        return $recibida_total;
    }
    
    
     public function totalStatusRecibidaDeOficinas($unidad_id, $fecha_inicio,$fecha_final) {

        // INICIO --- GRAFICO DE BARRAS TOTAL DE ENVIADAS POR ESTATUS A OFICINAS
        // INICIO --- GRAFICO DE TORTA TOTAL DE ENVIADAS POR ESTATUS A OFICINAS
        // INICIO --- GRAFICO DE TORTA TOTAL DE ENVIADAS POR ESTATUS A OFICINAS
    
        $correspondencias_internas = Doctrine_Query::create()
                ->select("u.id, u.nombre, u.siglas")
                ->addSelect("(
                            SELECT COUNT(c.id)
                            FROM Correspondencia_Correspondencia c
                            WHERE c.id IN
                                    (
                                         SELECT c2.id
                                         FROM Correspondencia_Correspondencia c2
                                         INNER JOIN c2.Correspondencia_Receptor r
                                         WHERE c2.status IN ('E')
                                         AND c2.emisor_unidad_id = u.id
                                         AND c2.f_envio >= '2005-01-01 00:00:00'
                                         AND c2.f_envio <= '2014-01-01 00:00:00'
                                         AND r.unidad_id = 1
                                         AND r.establecido = 'S'
                                         GROUP BY c2.id
                                    )
                            ) as sin_leer")
                
                ->addSelect("(
                            SELECT COUNT(c3.id)
                            FROM Correspondencia_Correspondencia c3
                            WHERE c3.id IN
                                    (
                                         SELECT c4.id
                                         FROM Correspondencia_Correspondencia c4
                                         INNER JOIN c4.Correspondencia_Receptor r1
                                         WHERE c4.status IN ('L')
                                         AND c4.emisor_unidad_id = u.id
                                         AND c4.f_envio >= '2005-01-01 00:00:00'
                                         AND c4.f_envio <= '2014-01-01 00:00:00'
                                         AND r1.unidad_id = 1
                                         AND r1.establecido = 'S'
                                         GROUP BY c4.id
                                    )
                            ) as leidas")
                
                ->addSelect("(
                            SELECT COUNT(c5.id)
                            FROM Correspondencia_Correspondencia c5
                            WHERE c5.id IN
                                    (
                                         SELECT c6.id
                                         FROM Correspondencia_Correspondencia c6
                                         INNER JOIN c6.Correspondencia_Receptor r2
                                         WHERE c6.status IN ('D')
                                         AND c6.emisor_unidad_id = u.id
                                         AND c6.f_envio >= '2005-01-01 00:00:00'
                                         AND c6.f_envio <= '2014-01-01 00:00:00'
                                         AND r2.unidad_id = 1
                                         AND r2.establecido = 'S'
                                         GROUP BY c6.id
                                    )
                            ) as devueltas")
                
                ->from('Organigrama_Unidad u')
                ->execute(array(), Doctrine::HYDRATE_NONE); 

        $i=0; $recibida_interna = array();
        foreach ($correspondencias_internas as $correspondencia_interna) {
            
            if($correspondencia_interna['3'] > 0 || $correspondencia_interna['4'] > 0 || $correspondencia_interna['5'] > 0) {
                
                $total_recibida = $correspondencia_interna['3']+$correspondencia_interna['4']+$correspondencia_interna['5'];
                
                $recibida_interna[$i] = array(
                    'unidad_id' => $correspondencia_interna['0'],
                    'unidad_nombre' => $correspondencia_interna['1'],
                    'unidad_siglas' => $correspondencia_interna['2'],

                    'total' => $total_recibida,

                    'sin_leer' => $correspondencia_interna['3'],
                    'leidas' => $correspondencia_interna['4'],
                    'devueltas' => $correspondencia_interna['5'],
                );
                
                $i++;
            }
            
        }

        return $recibida_interna;
        
        exit();

        // FIN --- GRAFICO DE TORTA TOTAL DE ENVIADAS POR ESTATUS A OFICINAS
        // FIN --- GRAFICO DE TORTA TOTAL DE ENVIADAS POR ESTATUS A OFICINAS
        // FIN --- GRAFICO DE TORTA TOTAL DE ENVIADAS POR ESTATUS A OFICINAS 
    }
    
    
    
     public function totalStatusRecibidaDeOrganismos($unidad_id, $fecha_inicio,$fecha_final) {
            
        // INICIO --- GRAFICO DE BARRAS TOTAL DE ENVIADAS A ORGANISMOS EXTERNOS
        // INICIO --- GRAFICO DE BARRAS TOTAL DE ENVIADAS A ORGANISMOS EXTERNOS
        // INICIO --- GRAFICO DE BARRAS TOTAL DE ENVIADAS A ORGANISMOS EXTERNOS
         
        $correspondencias_externas = Doctrine_Query::create()
               ->select("o.id, o.nombre, o.siglas, COUNT(DISTINCT c.id) as total")
               ->from('Organismos_Organismo o')
               ->innerJoin('o.Correspondencia_Correspondencia c')
               ->innerJoin('c.Correspondencia_Receptor r')
               ->where("r.unidad_id = ?", $unidad_id) 
               ->andWhere("c.f_envio >= '".$fecha_inicio."'")
               ->andWhere("c.f_envio <= '".$fecha_final."'")
               ->andWhere("r.establecido = 'S'")
               ->groupBy("o.id, o.nombre, o.siglas")
               ->orderBy("total desc")
               ->execute(array(), Doctrine::HYDRATE_NONE); 
        
        $i=0; $recibida_externa=array();
        foreach ($correspondencias_externas as $correspondencia_externa) {
            if($correspondencia_externa[3]>0){
                $recibida_externa[$i] = array(
                    'organismo_id' => $correspondencia_externa[0],
                    'organismo_nombre' => $correspondencia_externa[1],
                    'organismo_siglas' => $correspondencia_externa[2],
                    'organismo_total' => $correspondencia_externa[3],
                );
                $i++;
            }
        }      
        
        return $recibida_externa;

    }
    
    
    
     public function totalRecibidaPorDias($unidad_id, $fecha_inicio,$fecha_final) {

        // INICIO --- GRAFICO LINEAL DE TOTAL DE CREADAS EN RANGO DE TIEMPO
        // INICIO --- GRAFICO LINEAL DE TOTAL DE CREADAS EN RANGO DE TIEMPO
        // INICIO --- GRAFICO LINEAL DE TOTAL DE CREADAS EN RANGO DE TIEMPO

        $correspondencias_recibidas_rango_tiempo = Doctrine_Query::create()
               ->select("to_date(to_char(c.created_at, 'YYYY/MM/DD'), 'YYYY/MM/DD') as fecha, COUNT(c.id) as total")
               ->from('Correspondencia_Correspondencia c')
               ->where("c.id IN (SELECT r.correspondencia_id
                        FROM Correspondencia_Receptor r 
                        WHERE r.unidad_id = ".$unidad_id."
                        AND r.establecido = 'S')")
               ->andWhere("c.f_envio >= '".$fecha_inicio."'")
               ->andWhere("c.f_envio <= '".$fecha_final."'")
               ->groupBy('fecha')
               ->orderBy('fecha')
               ->execute(array(), Doctrine::HYDRATE_NONE); 

        $recibida_historico=array();
        foreach ($correspondencias_recibidas_rango_tiempo as $correspondencia_recibida_rango_tiempo) {
            $fecha = date('d-m-Y', strtotime($correspondencia_recibida_rango_tiempo[0]));
            $recibida_historico[$fecha] = $correspondencia_recibida_rango_tiempo[1];
        }        
       
        return $recibida_historico;

        // FIN --- GRAFICO LINEAL DE TOTAL DE CREADAS EN RANGO DE TIEMPO
        // FIN --- GRAFICO LINEAL DE TOTAL DE CREADAS EN RANGO DE TIEMPO
        // FIN --- GRAFICO LINEAL DE TOTAL DE CREADAS EN RANGO DE TIEMPO
    }
    
    
    
    
// BANDEJA DE EXTERNAS
// BANDEJA DE EXTERNAS
// BANDEJA DE EXTERNAS
// BANDEJA DE EXTERNAS
// BANDEJA DE EXTERNAS
// BANDEJA DE EXTERNAS
    
    
    public function totalStatusExterna($unidad_id, $fecha_inicio,$fecha_final) {
            
            $correspondencias_total = Doctrine_Query::create()
                        ->select('c.status as status, COUNT(c.status) as total')
                        ->from('Correspondencia_Correspondencia c')
                    
                        ->where("c.unidad_correlativo_id IN (SELECT uc.id
                                    FROM Correspondencia_UnidadCorrelativo uc
                                    WHERE uc.unidad_id = ".$unidad_id."
                                    AND uc.tipo = 'R')")
                    
                        ->andWhereIn('c.emisor_organismo_id IS NOT NULL')
                        ->andWhereIn('c.status', array('E', 'L', 'D'))
                        ->andWhere("c.created_at >= '".$fecha_inicio."'")
                        ->andWhere("c.created_at <= '".$fecha_final."'")
                        ->groupBy('c.status')
                        ->execute(array(), Doctrine::HYDRATE_NONE);

            $externa_total = array();    
            foreach ($correspondencias_total as $correspondencia_total) { 
                $externa_total[$correspondencia_total[0]] = $correspondencia_total[1];
            }
            
        return $externa_total;
    }
    

    
     public function totalStatusExternasParaOficinas($unidad_id, $fecha_inicio,$fecha_final) {

        $correspondencias_externas = Doctrine_Query::create()
                ->select("u.id, u.nombre, u.siglas")

                ->addSelect("(SELECT COUNT(c.id)
                             FROM Correspondencia_Correspondencia c
                             WHERE (c.unidad_correlativo_id IN (
                                    SELECT uc.id
                                    FROM Correspondencia_UnidadCorrelativo uc
                                    WHERE uc.unidad_id = ".$unidad_id."
                                    AND uc.tipo = 'R'))
                             AND (c.id IN (SELECT r.correspondencia_id
                                    FROM Correspondencia_Receptor r 
                                    WHERE r.unidad_id = u.id 
                                    AND r.establecido = 'S'))
                             AND c.emisor_organismo_id IS NOT NULL
                             AND c.status IN ('E','L','D')
                             AND c.created_at >= '".$fecha_inicio."' 
                             AND c.created_at <= '".$fecha_final."') as total")
    
                ->from('Organigrama_Unidad u')
                ->execute(array(), Doctrine::HYDRATE_NONE); 
        
        
        $i=0; $externa_interna=array();
        foreach ($correspondencias_externas as $correspondencia_externa) {

            if($correspondencia_externa[3]>0){


                $correspondencia_externa_unidad = Doctrine_Query::create()
                        ->select("u.id, u.nombre, u.siglas")

                        ->addSelect("(SELECT COUNT(c.id)
                                     FROM Correspondencia_Correspondencia c
                                     WHERE (c.unidad_correlativo_id IN (
                                            SELECT uc.id
                                            FROM Correspondencia_UnidadCorrelativo uc
                                            WHERE uc.unidad_id = ".$unidad_id."
                                            AND uc.tipo = 'R'))
                                     AND (c.id IN (SELECT r.correspondencia_id
                                            FROM Correspondencia_Receptor r 
                                            WHERE r.unidad_id = u.id 
                                            AND r.establecido = 'S'))
                                     AND c.emisor_organismo_id IS NOT NULL
                                     AND c.status IN ('E')
                                     AND c.created_at >= '".$fecha_inicio."' 
                                     AND c.created_at <= '".$fecha_final."') as enviadas")

                        ->addSelect("(SELECT COUNT(c2.id)
                                     FROM Correspondencia_Correspondencia c2
                                     WHERE (c2.unidad_correlativo_id IN (
                                            SELECT uc2.id
                                            FROM Correspondencia_UnidadCorrelativo uc2
                                            WHERE uc2.unidad_id = ".$unidad_id."
                                            AND uc2.tipo = 'R'))
                                     AND (c2.id IN (SELECT r2.correspondencia_id
                                            FROM Correspondencia_Receptor r2
                                            WHERE r2.unidad_id = u.id 
                                            AND r2.establecido = 'S'))
                                     AND c2.emisor_organismo_id IS NOT NULL
                                     AND c2.status IN ('L')
                                     AND c2.created_at >= '".$fecha_inicio."' 
                                     AND c2.created_at <= '".$fecha_final."') as entregadas")
                        
                        ->addSelect("(SELECT COUNT(c3.id)
                                     FROM Correspondencia_Correspondencia c3
                                     WHERE (c3.unidad_correlativo_id IN (
                                            SELECT uc3.id
                                            FROM Correspondencia_UnidadCorrelativo uc3
                                            WHERE uc3.unidad_id = ".$unidad_id."
                                            AND uc3.tipo = 'R'))
                                     AND (c3.id IN (SELECT r3.correspondencia_id
                                            FROM Correspondencia_Receptor r3 
                                            WHERE r3.unidad_id = u.id 
                                            AND r3.establecido = 'S'))
                                     AND c3.emisor_organismo_id IS NOT NULL
                                     AND c3.status IN ('D')
                                     AND c3.created_at >= '".$fecha_inicio."' 
                                     AND c3.created_at <= '".$fecha_final."') as devueltas")
                        
                        ->from('Organigrama_Unidad u')
                        ->where('u.id = ?',$correspondencia_externa[0])
                        ->execute(array(), Doctrine::HYDRATE_NONE); 


                $externa_interna[$i] = array(
                    'unidad_id' => $correspondencia_externa_unidad[0][0],
                    'unidad_nombre' => $correspondencia_externa_unidad[0][1],
                    'unidad_siglas' => $correspondencia_externa_unidad[0][2],

                    'total' => $correspondencia_externa[3],

                    'enviadas' => $correspondencia_externa_unidad[0][3],
                    'entregadas' => $correspondencia_externa_unidad[0][4],
                    'devueltas' => $correspondencia_externa_unidad[0][5]
                );


                $i++;
            }
        }

        // REALIZE UN ORDENAMIENTO DE MAYOR A MENOR POR EL TOTAL
        return $externa_interna;
    }
    
    
    public function totalStatusExternasPorReceptor($unidad_id, $fecha_inicio,$fecha_final) {
            
            $correspondencias_por_receptor = Doctrine_Query::create()
                        ->select('c.id_update, COUNT(c.id_update) as total')
                        ->from('Correspondencia_Correspondencia c')
                    
                        ->where("c.unidad_correlativo_id IN (SELECT uc.id
                                    FROM Correspondencia_UnidadCorrelativo uc
                                    WHERE uc.unidad_id = ".$unidad_id."
                                    AND uc.tipo = 'R')")
                    
                        ->andWhereIn('c.emisor_organismo_id IS NOT NULL')
                        ->andWhereIn('c.status', array('E', 'L', 'D'))
                        ->andWhere("c.created_at >= '".$fecha_inicio."'")
                        ->andWhere("c.created_at <= '".$fecha_final."'")
                        ->groupBy('c.id_update')
                        ->execute(array(), Doctrine::HYDRATE_NONE);

            $externa_por_receptor = array();    
            foreach ($correspondencias_por_receptor as $correspondencia_por_receptor) { 

                $funcionario = Doctrine_Query::create()
                       ->select("f.id, f.ci, f.primer_nombre, f.primer_apellido")
                       ->from('Funcionarios_Funcionario f')
                       ->where('f.id IN 
                                (SELECT u.usuario_enlace_id 
                                 FROM Acceso_Usuario u 
                                 WHERE u.id = '.$correspondencia_por_receptor[0].')')
                       ->execute(array(), Doctrine::HYDRATE_NONE); 

                $externa_por_receptor[$funcionario[0][0]] = array(
                     'cedula' => $funcionario[0][1],
                     'nombre' => $funcionario[0][2].' '.$funcionario[0][3],
                     'total' => $correspondencia_por_receptor[1]
                     );
            }
            
        return $externa_por_receptor;
    }
    

     public function totalExternaPorOrganismos($unidad_id, $fecha_inicio,$fecha_final) {
         
        $correspondencias_externas = Doctrine_Query::create()
               ->select("o.id, o.nombre, o.siglas, COUNT(DISTINCT c.id) as total")
               ->from('Organismos_Organismo o')
               ->innerJoin('o.Correspondencia_Correspondencia c')
               ->innerJoin('c.Correspondencia_Receptor r')
               ->where("c.unidad_correlativo_id IN (SELECT uc.id
                          FROM Correspondencia_UnidadCorrelativo uc
                          WHERE uc.unidad_id = ".$unidad_id."
                          AND uc.tipo = 'R')")
               ->andWhere("c.f_envio >= '".$fecha_inicio."'")
               ->andWhere("c.f_envio <= '".$fecha_final."'")
               ->andWhere("r.establecido = 'S'")
               ->groupBy("o.id, o.nombre, o.siglas")
               ->orderBy("total desc")
               ->execute(array(), Doctrine::HYDRATE_NONE); 
        
        $i=0; $recibida_externa=array();
        foreach ($correspondencias_externas as $correspondencia_externa) {
            if($correspondencia_externa[3]>0){
                $recibida_externa[$i] = array(
                    'organismo_id' => $correspondencia_externa[0],
                    'organismo_nombre' => $correspondencia_externa[1],
                    'organismo_siglas' => $correspondencia_externa[2],
                    'organismo_total' => $correspondencia_externa[3],
                );
                $i++;
            }
        }      
        
        return $recibida_externa;

    }
    
    
    public function totalExternaPorDias($unidad_id, $fecha_inicio,$fecha_final) {
        
        $correspondencias_externa_rango_tiempo = Doctrine_Query::create()
               ->select("to_date(to_char(c.created_at, 'YYYY/MM/DD'), 'YYYY/MM/DD') as fecha, COUNT(c.id) as total")
               ->from('Correspondencia_Correspondencia c')
               ->where("c.unidad_correlativo_id IN (SELECT uc.id
                           FROM Correspondencia_UnidadCorrelativo uc
                           WHERE uc.unidad_id = ".$unidad_id."
                           AND uc.tipo = 'R')")
               ->andWhereIn('c.emisor_organismo_id IS NOT NULL')
               ->andWhereIn('c.status', array('E', 'L', 'D'))
               ->andWhere("c.created_at >= '".$fecha_inicio."'")
               ->andWhere("c.created_at <= '".$fecha_final."'")
               ->groupBy('fecha')
               ->orderBy('fecha')
               ->execute(array(), Doctrine::HYDRATE_NONE); 

        $externa_historico=array();
        foreach ($correspondencias_externa_rango_tiempo as $correspondencia_externa_rango_tiempo) {
            $fecha = date('d-m-Y', strtotime($correspondencia_externa_rango_tiempo[0]));
            $externa_historico[$fecha] = $correspondencia_externa_rango_tiempo[1];
        }             

        return $externa_historico;
    }
}
