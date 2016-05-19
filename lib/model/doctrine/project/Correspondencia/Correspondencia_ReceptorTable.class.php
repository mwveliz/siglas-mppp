<?php


class Correspondencia_ReceptorTable extends Doctrine_Table
{

    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_Receptor');
    }

    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
            $q = Doctrine_Query::create()
                ->select('cr.*, f.primer_nombre as pn, f.primer_apellido as pa, u.nombre as unombre, ct.nombre as ctnombre')
                ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = cr.id_update LIMIT 1) as user_update')
                ->from('Correspondencia_Receptor cr')
                ->innerjoin('cr.Organigrama_Unidad u')
                ->innerjoin('cr.Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->where('cr.correspondencia_id = ?', sfContext::getInstance()->getUser()->getAttribute('correspondencia_id'))
                ->orderBy('u.nombre, ct.nombre, f.primer_nombre, f.primer_apellido')
                ->useResultCache(true, 3600, 'correspondencia_receptor_list_'.sfContext::getInstance()->getUser()->getAttribute('correspondencia_id'));

            return $q;

    }

    public function filtrarPorCorrespondenciayReceptorUnidad($correspondencia_id,$unidad_id)
    {
            $q = Doctrine_Query::create()
                ->select('cr.*')
                ->from('Correspondencia_Receptor cr')
                ->where('cr.correspondencia_id = ?', $correspondencia_id)
                ->andWhere('cr.unidad_id = ?', $unidad_id);

            return $q->execute();
    }

    public function filtrarRespuestaExacta($correspondencia_id,$unidad_ids)
    {
            $q = Doctrine_Query::create()
                ->select('cr.*')
                ->from('Correspondencia_Receptor cr')
                ->where('cr.correspondencia_id = ?', $correspondencia_id)
                ->andWhereIn('cr.unidad_id', $unidad_ids)
                ->andWhere('cr.establecido = ?', 'S');

            return $q->execute();
    }

    public function filtrarPorCorrespondenciayReceptorUnidadFuncionario($correspondencia_id,$unidad_id,$funcionario_id)
    {
            $q = Doctrine_Query::create()
                ->select('cr.*')
                ->from('Correspondencia_Receptor cr')
                ->where('cr.correspondencia_id = ?', $correspondencia_id)
                ->andWhere('cr.unidad_id = ?', $unidad_id)
                ->andWhere('cr.funcionario_id = ?', $funcionario_id);

            return $q->execute();
    }

    public function filtrarPorCorrespondencia($correspondencia_id)
    {
            $q = Doctrine_Query::create()
                ->select('cr.*, f.primer_nombre as pn, f.segundo_nombre as sn, f.primer_apellido as pa, f.segundo_apellido as sa,
                        f.ci as ci, f.sexo as sexo, f.telf_movil as telf_movil, f.email_institucional as email_institucional, f.email_personal as email_personal,
                        (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre,
                        u.id as unidad_id, u.unidad_tipo_id as unidad_tipo_id, u.nombre as unombre, u.siglas as siglas')
                ->addSelect('(SELECT un.nombre FROM Organigrama_Unidad un WHERE un.id = u.padre_id LIMIT 1) as padre_unidad')
                ->from('Correspondencia_Receptor cr')
                ->innerjoin('cr.Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('cr.Organigrama_Unidad u')
                ->where('cr.correspondencia_id = ?', $correspondencia_id)
                ->andWhere('cr.establecido = ?', 'S')
                ->orderBy('f.primer_nombre, f.segundo_nombre')
                ->useResultCache(true, 3600, 'correspondencia_enviada_list_receptor_'.$correspondencia_id);

            return $q->execute();
    }
    
    public function filtrarPorCorrespondenciaActual($correspondencia_id)
    {
        //ESTE DQL TRAE EL CARGO ACTUAL VIGENTE DEL FUNCIONARIO
            $q = Doctrine_Query::create()
                ->select('cr.*, f.primer_nombre as pn, f.segundo_nombre as sn, f.primer_apellido as pa, f.segundo_apellido as sa,
                        f.ci as ci, f.sexo as sexo, f.telf_movil as telf_movil, f.email_institucional as email_institucional, f.email_personal as email_personal,
                        (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre,
                        u.id as unidad_id, u.unidad_tipo_id as unidad_tipo_id, u.nombre as unombre, u.siglas as siglas')
                ->addSelect('(SELECT un.nombre FROM Organigrama_Unidad un WHERE un.id = u.padre_id LIMIT 1) as padre_unidad')
                ->from('Correspondencia_Receptor cr')
                ->innerjoin('cr.Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('cr.Organigrama_Unidad u')
                ->where('cr.correspondencia_id = ?', $correspondencia_id)
                ->andWhere('cr.establecido = ?', 'S')
                ->andWhere('fc.status = ?', 'A')
                ->orderBy('f.primer_nombre, f.segundo_nombre');

            return $q->execute();
    }
    
    public function filtrarPorCorrespondenciaSinRespuesta($correspondencia_id)
    {
            $q = Doctrine_Query::create()
                ->select('cr.*, f.primer_nombre as pn, f.segundo_nombre as sn, f.primer_apellido as pa, f.segundo_apellido as sa,(CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre, u.nombre as unombre, u.id as uid')
                ->addSelect('(SELECT un.nombre FROM Organigrama_Unidad un WHERE un.id = u.padre_id LIMIT 1) as padre_unidad')
                ->from('Correspondencia_Receptor cr')
                ->innerjoin('cr.Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('cr.Organigrama_Unidad u')
                ->where('cr.correspondencia_id = ?', $correspondencia_id)
                ->andWhere('cr.establecido = ?', 'S')
                ->andWhere('cr.respuesta_correspondencia_ids is null')
                ->orderBy('f.primer_nombre, f.segundo_nombre');

            return $q->execute();
    }

    public function funcionarioReceptor($correspondencia_id,$unidad_id,$like_respuesta_correspondencia_ids)
    {
            $q = Doctrine_Query::create()
                ->select('cr.*,f.primer_nombre as pn,f.segundo_nombre as sn,f.primer_apellido as pa,f.segundo_apellido as sa,(CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre')
                ->from('Correspondencia_Receptor cr')
                ->innerjoin('cr.Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->where('cr.correspondencia_id = ?', $correspondencia_id)
                ->andWhere('cr.unidad_id = ?', $unidad_id)
                ->andWhere('cr.establecido = ?', 'S')
                ->andWhere('cr.respuesta_correspondencia_ids LIKE ?', '.-'.$like_respuesta_correspondencia_ids.'-.')
                ->limit(1);

            return $q->execute();
    }

    public function sinLeerCantidad($funcionario_id) {

//            $q = Doctrine_Query::create()
//                ->select('c.id')
//                ->addSelect('(SELECT COUNT(rl.id) AS leido FROM Correspondencia_Receptor rl WHERE rl.correspondencia_id = c.id AND rl.funcionario_id = '.$funcionario_id.' AND rl.f_recepcion IS NOT NULL) as leido')
//                ->from('Correspondencia_Correspondencia c')
//                ->where('(c.id IN (SELECT r.correspondencia_id
//                                    FROM Correspondencia_Receptor r
//                                    WHERE r.funcionario_id = '.$funcionario_id.'
//                                    AND r.establecido = \'S\')
//                               OR c.id IN (SELECT r2.correspondencia_id
//                                    FROM Correspondencia_Receptor r2
//                                    WHERE r2.unidad_id IN
//                                        (SELECT cfu.autorizada_unidad_id
//                                        FROM Correspondencia_FuncionarioUnidad cfu
//                                        WHERE (cfu.funcionario_id = '.$funcionario_id.'
//                                            AND cfu.status = \'A\'
//                                            AND cfu.leer = \'t\'
//                                            AND cfu.deleted_at is null))
//                                    AND r2.privado = \'N\'))')
//                ->andWhereIn('c.status', array('E', 'L', 'D'))
//                ->orderBy('c.id desc')
//                ->execute();

            $ids = implode(", ", $funcionario_id);

            $q = Doctrine_Query::create()
                ->select('COUNT(c.id) as total')

                ->from('Correspondencia_Correspondencia c')

                ->where('(c.id IN (SELECT r.correspondencia_id
                            FROM Correspondencia_Receptor r
                            WHERE r.funcionario_id IN ('. $ids . ')
                            AND r.establecido = \'S\'))')

                ->andwhere('(SELECT COUNT(rl.id) AS leido
                              FROM Correspondencia_Receptor rl
                              WHERE rl.correspondencia_id = c.id
                              AND rl.funcionario_id IN ('. $ids . ')
                              AND rl.f_recepcion IS NOT NULL) < 1')

                ->andWhere('c.status = ?', 'E')
                ->execute();

            return $q;
    }
    
    //Trae todos los funcionarios receptores de un grupo de correspondencia
    public function funcionariosImplicadasGrupo($list_correspondencias) {
        $q = Doctrine_Query::create()
                ->select('c.funcionario_id')
                ->from('Correspondencia_Receptor c')
                ->whereIn('c.correspondencia_id', $list_correspondencias)
                ->andWhere('c.establecido = ?', 'S')
                ->execute();

        return $q;
    }
    
    public function receptoresPorCorrespondenciaUnidadEstablecido($correspondencia_id,$unidad_id,$establecido)
    {
            $q = Doctrine_Query::create()
                ->select('cr.*')
                ->from('Correspondencia_Receptor cr')
                ->where('cr.correspondencia_id = ?', $correspondencia_id)
                ->andWhere('cr.unidad_id = ?', $unidad_id)
                ->andWhereIn('cr.establecido', $establecido);

            return $q->execute();
    }
}