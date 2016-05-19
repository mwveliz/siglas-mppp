<?php

class Correspondencia_CorrespondenciaTable extends Doctrine_Table {

    public static function getInstance() {
        return Doctrine_Core::getTable('Correspondencia_Correspondencia');
    }

    static public $prioridad = array(
        '' => '',
        'S' => 'Simple',
        'U' => 'Urgente',
    );

    public function getPrioridad() {
        return self::$prioridad;
    }

    static public $privado = array(
        'S' => 'Si',
        'N' => 'No',
    );

    public function getPrivado() {
        return self::$privado;
    }

    static public $status_recepcion = array(
        '' => 'Todas',
        'E' => 'Sin Leer',
        'L' => 'Leidas',
    );

    public function getStatusRecepcion() {
        return self::$status_recepcion;
    }

    static public $status = array(
        ' ' => 'Todas',
        'C' => 'En Creación o por Firmar',
        'E' => 'Enviada',
        'A' => 'Asignada',
        'P' => 'Pausado',
        'L' => 'Recibida y Leida',
        'F' => 'Espera por mi Firma o Visto bueno',
        'V' => 'Espera por Firma o Visto bueno de otros',
        'X' => 'Anuladas',
    );

    public function getStatus() {
        return self::$status;
    }

    static public $tipo_traslado_externo = array(
        '' => '',
        'Mensajero - Motorizado' => 'Mensajero - Motorizado',
        'Empresa de encomiendas' => 'Empresa de encomiendas',
    );

    public function getTipoTrasladoExterno() {
        return self::$tipo_traslado_externo;
    }

    static public $empresa_traslado = array(
        '' => '',
        'AEROCAV' => 'AEROCAV',
        'COURRIER' => 'COURRIER',
        'DHL' => 'DHL',
        'DOMESA' => 'DOMESA',
        'MRW' => 'MRW',
        'SERVIBOX' => 'SERVIBOX',
        'TEALCA' => 'TEALCA',
        'ZOOM' => 'ZOOM',
    );

    public function getEmpresaTraslado() {
        return self::$empresa_traslado;
    }

    public function innerListExterna() {

        $q = Doctrine_Query::create()
            ->select('c.*')
            ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = c.id_create LIMIT 1) as user_update')
            ->addSelect('(SELECT COUNT(aa.id) AS tadjuntos FROM Correspondencia_AnexoArchivo aa WHERE aa.correspondencia_id = c.id LIMIT 1) as tadjuntos')
            ->addSelect('(SELECT COUNT(af.id) AS tfisico FROM Correspondencia_AnexoFisico af WHERE af.correspondencia_id = c.id LIMIT 1) as tfisicos')
            ->from('Correspondencia_Correspondencia c')
            ->Where('c.emisor_organismo_id is not null')
            ->andWhereIn('c.status', array('E', 'L', 'D'))
            ->orderBy('c.id desc');

        return $q;
    }

    public function autorizacionCaso($grupo_correspondencia) {
        $funcionario_id = sfContext::getInstance()->getUser()->getAttribute('funcionario_id');

        $q = Doctrine_Query::create()
            ->select('c.id')
            ->addSelect('(SELECT COUNT(rl.id) AS leido FROM Correspondencia_Receptor rl WHERE rl.correspondencia_id = c.id AND rl.funcionario_id = '.$funcionario_id.' AND rl.f_recepcion IS NOT NULL) as leido')
            ->from('Correspondencia_Correspondencia c')

            ->where('(c.id IN (SELECT r.correspondencia_id
                        FROM Correspondencia_Receptor r
                        WHERE r.funcionario_id = '.$funcionario_id.'
                        AND r.establecido = \'S\')
                   OR c.id IN (SELECT r2.correspondencia_id
                        FROM Correspondencia_Receptor r2
                        WHERE r2.unidad_id IN
                            (SELECT cfu.autorizada_unidad_id
                            FROM Correspondencia_FuncionarioUnidad cfu
                            WHERE (cfu.funcionario_id = '.$funcionario_id.'
                                AND cfu.status = \'A\'
                                AND cfu.leer = \'t\'
                                AND cfu.deleted_at is null))
                        AND r2.privado = \'N\'))') // VERIFICAR PORQUE PIDE PRIVADO

            ->andWhereIn('c.status', array('E', 'L', 'D', 'A'))
            ->andWhere('c.grupo_correspondencia = ?', $grupo_correspondencia);
            //->useResultCache(true, 3600, 'correspondencia_externa_autorizado_funcionario_'.$funcionario_id.'_grupo_'.$grupo_correspondencia);

        return $q->execute();
    }

    public function innerListEnviada() {
        $funcionario_id = sfContext::getInstance()->getUser()->getAttribute('funcionario_id');

        $q = Doctrine_Query::create()
            ->select('c.*')
            ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = c.id_create LIMIT 1) as user_update')
            //->addSelect('(SELECT COUNT(aa.id) AS tadjuntos FROM Correspondencia_AnexoArchivo aa WHERE aa.correspondencia_id = c.id LIMIT 1) as tadjuntos')
            //->addSelect('(SELECT COUNT(af.id) AS tfisico FROM Correspondencia_AnexoFisico af WHERE af.correspondencia_id = c.id LIMIT 1) as tfisicos')
            //->addSelect('(SELECT COUNT(ad.id) AS tformato FROM Correspondencia_Formato ad WHERE ad.correspondencia_id = c.id LIMIT 1) as tformato')
            ->addSelect('(SELECT COUNT(fe2.id) AS firmas_listas FROM Correspondencia_FuncionarioEmisor fe2 WHERE fe2.correspondencia_id = c.id AND fe2.firma = \'S\') as firmas_listas')
            ->addSelect('(SELECT fe3.firma AS firma_propia_lista FROM Correspondencia_FuncionarioEmisor fe3 WHERE fe3.correspondencia_id = c.id AND fe3.funcionario_id = '.$funcionario_id.' LIMIT 1) as firma_propia_lista')
            ->addSelect('(SELECT COUNT(fe4.id) AS emisores FROM Correspondencia_FuncionarioEmisor fe4 WHERE fe4.correspondencia_id = c.id) as emisores')
            ->addSelect('(SELECT COUNT(rl.id) AS receptores FROM Correspondencia_Receptor rl WHERE rl.correspondencia_id = c.id) as receptores')
            ->from('Correspondencia_Correspondencia c')

            ->whereNotIn('c.status', array('S','M'))
            ->orderBy('c.id desc');

        return $q;
    }

    public function innerListRecibida() {
        $funcionario_id = sfContext::getInstance()->getUser()->getAttribute('funcionario_id');

        $q = Doctrine_Query::create()
                        ->select('c.*')
                        ->addSelect('(SELECT COUNT(aa.id) AS tadjuntos FROM Correspondencia_AnexoArchivo aa WHERE aa.correspondencia_id = c.id LIMIT 1) as tadjuntos')
                        ->addSelect('(SELECT COUNT(af.id) AS tfisico FROM Correspondencia_AnexoFisico af WHERE af.correspondencia_id = c.id LIMIT 1) as tfisicos')
                        ->addSelect('(SELECT COUNT(rl.id) AS leido FROM Correspondencia_Receptor rl WHERE rl.correspondencia_id = c.id AND rl.funcionario_id = '.$funcionario_id.' AND rl.f_recepcion IS NOT NULL) as leido')
                        ->from('Correspondencia_Correspondencia c')


                        ->where('(c.id IN (SELECT r.correspondencia_id
                                    FROM Correspondencia_Receptor r
                                    WHERE r.funcionario_id = '.$funcionario_id.'
                                    AND r.establecido IN (\'S\',\'A\'))
                               OR c.id IN (SELECT r2.correspondencia_id
                                    FROM Correspondencia_Receptor r2
                                    WHERE r2.unidad_id IN
                                        (SELECT cfu.autorizada_unidad_id
                                        FROM Correspondencia_FuncionarioUnidad cfu
                                        WHERE (cfu.funcionario_id = '.$funcionario_id.'
                                            AND cfu.status = \'A\'
                                            AND cfu.leer = \'t\'
                                            AND cfu.deleted_at is null))))')

                        ->andWhereIn('c.status', array('E', 'L', 'D'))
                        ->orderBy('c.id desc');

        return $q;
    }

    public function nGrupoRecibidaFuncionario($n_grupo, $funcionario_id) {
        $q = Doctrine_Query::create()
                        ->select('c.*')
                        ->addSelect('(SELECT COUNT(aa.id) AS tadjuntos FROM Correspondencia_AnexoArchivo aa WHERE aa.correspondencia_id = c.id LIMIT 1) as tadjuntos')
                        ->addSelect('(SELECT COUNT(af.id) AS tfisico FROM Correspondencia_AnexoFisico af WHERE af.correspondencia_id = c.id LIMIT 1) as tfisicos')
                        ->from('Correspondencia_Correspondencia c')
                        ->where('c.grupo_correspondencia = ?', $n_grupo)
                        ->andWhereIn('c.status', array('E', 'L', 'A'))
                        ->orderBy('c.updated_at desc');

        return $q;
    }

    public function unidadEmisor($correspondencia_id) {
        $q = Doctrine_Query::create()
            ->select('c.*,u.nombre as unombre, u.siglas as siglas')
            ->addSelect('(SELECT un.nombre FROM Organigrama_Unidad un WHERE un.id = u.padre_id LIMIT 1) as padre_unidad')
            ->addSelect('(SELECT COUNT(aa.id) AS tadjuntos FROM Correspondencia_AnexoArchivo aa WHERE aa.correspondencia_id = c.id LIMIT 1) as tadjuntos')
            ->addSelect('(SELECT COUNT(af.id) AS tfisico FROM Correspondencia_AnexoFisico af WHERE af.correspondencia_id = c.id LIMIT 1) as tfisicos')
            ->from('Correspondencia_Correspondencia c')
            ->innerJoin('c.Organigrama_Unidad u')
            ->Where('c.id = ?', $correspondencia_id)
            ->limit(1)
            ->execute();

        return $q;
    }

    public function unidadEmisorOrganismo($correspondencia_id) {
        $q = Doctrine_Query::create()
                        ->select('c.*,o.nombre as onombre, p.nombre_simple as emisor_persona, pc.nombre as emisor_persona_cargo')
                        ->addSelect('(SELECT COUNT(aa.id) AS tadjuntos FROM Correspondencia_AnexoArchivo aa WHERE aa.correspondencia_id = c.id LIMIT 1) as tadjuntos')
                        ->addSelect('(SELECT COUNT(af.id) AS tfisico FROM Correspondencia_AnexoFisico af WHERE af.correspondencia_id = c.id LIMIT 1) as tfisicos')
                        ->from('Correspondencia_Correspondencia c')
                        ->innerJoin('c.Organismos_Organismo o')
                        ->innerJoin('c.Organismos_Persona p')
                        ->leftJoin('c.Organismos_PersonaCargo pc')
                        ->Where('c.id = ?', $correspondencia_id)
                        ->limit(1)
                        ->execute();

        return $q;
    }

    public function buscarCorrespondenciaNull() {
        $q = Doctrine_Query::create()
                        ->select('c.*')
                        ->from('Correspondencia_Correspondencia c')
                        ->where('c.padre_id is null')
                        ->andWhere('c.grupo_correspondencia = ?', sfContext::getInstance()->getUser()->getAttribute('correspondencia_grupo'))
                        ->andWhereIn('c.status', array('E', 'L', 'C', 'A'))
                        ->orderby('c.n_correspondencia_emisor')
                        ->limit(1)
                        ->execute();

        return $q;
    }

    public function buscarCorrespondenciaHijos($padre_id) {
        $q = Doctrine_Query::create()
                        ->select('c.*')
                        ->from('Correspondencia_Correspondencia c')
                        ->where('c.padre_id = ?', $padre_id)
                        ->andWhereIn('c.status', array('E', 'L', 'F', 'C', 'A'))
                        ->orderby('c.n_correspondencia_emisor')
                        ->execute();

        return $q;
    }

    public function cadenaCorrespondenciaReceptores($cadena, $padre_id, $tabular, $status) {
        $tabular_cadena = "";
        for ($i = 0; $i < $tabular; $i++)
            $tabular_cadena.= "-- ";

        $p = Doctrine::getTable('Correspondencia_Receptor')->filtrarPorCorrespondenciaSinRespuesta($padre_id);

        $can = count($p);
        for ($j = 0; $j < $can; $j++) {
            $cadena.=$tabular_cadena .
                    $p[$j]['correspondencia_id'] . '.==.' .
                    $p[$j]['unombre'] . '.==.' .
                    $p[$j]['padre_unidad'] . '.==.' .
                    $p[$j]['pn'] . ' ' . $p[$j]['sn'] . ', ' . $p[$j]['pa'] . ' ' . $p[$j]['sa'] . '.==.' .
                    $p[$j]['ctnombre'] . '.==.' .
                    $p[$j]['f_recepcion'] . '.==.' .
                    $p[$j]['copia'] . '.==.';

                    if($status == 'C')
                        $cadena.=$status . '.==.';
                    else
                        $cadena.=$p[$j]['establecido'] . '.==.';

                    $cadena.=$p[$j]['uid'] . '.==.' .
                    '.##.';

            $tabular++;
//            $cadena = $this->cadenaSeguimientoCorrespondencia($cadena, $p[$j]['id'], $tabular);
//            $tabular--;
        }

        return $cadena;
    }

    public function remitenteInicial($id) {
        $idcorrespondencia = Doctrine::getTable('Correspondencia_Correspondencia')->find($id);
        //se comenta el padre_id null pensando en los casos donde el padre_id es la misma correspondencia (redirecciones recicladas)
        $q = Doctrine_Query::create()
                        ->select('c.*, u.nombre as unidad, f.campo_uno as asunto')
                        ->from('Correspondencia_Correspondencia c')
                        ->innerJoin('c.Organigrama_Unidad u')
                        ->innerJoin('c.Correspondencia_Formato f')
//                        ->where('c.padre_id is null')
                        ->Where('c.id = ?', $idcorrespondencia->getGrupoCorrespondencia())
                        ->andWhereIn('c.status', array('E', 'L', 'C', 'A'))
                        ->orderby('c.n_correspondencia_emisor')
                        ->limit(1)
                        ->execute();

        return $q;
    }

    public function cadenaSeguimientoCorrespondencia($cadena = '', $padre_id = 0, $tabular = 0) {
        $tabular_cadena = "";
        for ($i = 0; $i < $tabular; $i++)
            $tabular_cadena.= "-- ";

        if ($padre_id == 0)
            $p = $this->buscarCorrespondenciaNull();
        else
            $p=$this->buscarCorrespondenciaHijos($padre_id);

        $can = count($p);
        $opciones = array();
        for ($i = 0; $i < $can; $i++) {
            //$p=Doctrine::getTable('Correspondencia_Receptor')->filtrarPorCorrespondencia($padre_id);
            $cadena.=$tabular_cadena . $p[$i]['id'] . '.##.';

            $tabular++;
            $cadena = $this->cadenaSeguimientoCorrespondencia($cadena, $p[$i]['id'], $tabular);
            $cadena = $this->cadenaCorrespondenciaReceptores($cadena, $p[$i]['id'], $tabular, $p[$i]['status']);
            $tabular--;
        }

        return $cadena;
    }

    public function seguimientoCorrespondencia() {
        $cadena = $this->cadenaSeguimientoCorrespondencia();

        $cadena_arreglo = explode(".##.", $cadena);

        $opciones = array();
        for ($i = 0; $i < count($cadena_arreglo) - 1; $i++) {
            $opciones[$i] = $cadena_arreglo[$i];
        }
        return $opciones;
    }

    public function formatosFiltro()
    {
        $funcionario_id = sfContext::getInstance()->getUser()->getAttribute('funcionario_id');

        $unidades_autorizadas = Doctrine::getTable('Correspondencia_FuncionarioUnidad')->funcionarioAutorizado($funcionario_id);

        $i=0;
        $unidades_ids=array();
        foreach ($unidades_autorizadas as $unidad_autorizada)
            {$unidades_ids[$i] = $unidad_autorizada->getAutorizadaUnidadId(); $i++;}

        $formatos_autorizados = Doctrine::getTable('Correspondencia_TipoFormato')->tiposActivosUnidad($unidades_ids);
        $formatos[''] = '';
        foreach ($formatos_autorizados as $formato_autorizado)
            {$formatos[$formato_autorizado->getId()] = $formato_autorizado->getNombre();}

            return $formatos;

    }

    public function editadoPorOtro($funcionario_id) {
        $q = Doctrine_Query::create()
                ->select('c.id as id, c.n_correspondencia_emisor as correlativo, c.editado as editor, c.updated_at as f_edicion')
                ->from('Correspondencia_Correspondencia c')
                ->where('c.id_create = ?', $funcionario_id)
                ->andWhere('c.editado IS NOT NULL')
                ->execute();

        return $q;
    }

    public function hechoPor() {
        // SE TIENE QUE VERIFICAR ES TODAS LAS UNIDADES A LAS QUE PERTENECE EN EL GRUPO
        $unidades_autorizadas = Doctrine::getTable('Correspondencia_FuncionarioUnidad')->funcionarioAutorizado(sfContext::getInstance()->getUser()->getAttribute('funcionario_id'));

        $unidad_ids='0,';
        foreach ($unidades_autorizadas as $unidad_autorizada)
            {$unidad_ids .= $unidad_autorizada->getAutorizadaUnidadId().',';}

        $unidad_ids.='$%&'; $unidad_ids=str_replace(',$%&', '', $unidad_ids);


        $q = Doctrine_Query::create()
                ->select('u.id')
                ->addSelect("(SELECT concat(f.primer_nombre, ' ', f.segundo_nombre, ', ', f.primer_apellido, ' ', f.segundo_apellido) as funcionario
                              FROM Funcionarios_Funcionario f WHERE f.id = u.usuario_enlace_id LIMIT 1) as nombre")
                ->from('Acceso_Usuario u')
                ->where('u.enlace_id = 1')
                ->andWhere("u.usuario_enlace_id IN
                            (SELECT cf.funcionario_id
                             FROM Correspondencia_FuncionarioUnidad cf
                             WHERE cf.autorizada_unidad_id IN (".$unidad_ids.")
                             AND cf.status = 'A')")
                ->orderBy('u.nombre')
                ->execute();

        return $q;
    }
    
    public function respuestaActiva($padre_id, $emisor_unidad_id) {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Correspondencia_Correspondencia c')
            ->Where('c.padre_id = ?', $padre_id)
            ->andWhere('c.emisor_unidad_id = ?', $emisor_unidad_id)
            ->andWhereNotIn('c.status', array('X'))
            ->execute();

        return $q;
    }
    
    //BUSCA UNA CORRESPONDENCIA DE RESPUESTA (DESCARTA LA INICIAL)
    public function padreNotMe($padre_id) {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Correspondencia_Correspondencia c')
            ->Where('c.padre_id = ?', $padre_id)
            ->andwhereNotIn('c.id', array($padre_id))
            ->andWhereNotIn('c.status', array('X'))
            ->limit(1)
            ->execute();

        return $q;
    }
}
