<?php


class Public_MensajesTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_Mensajes');
    }

    public function innerList()
    {
            $q = Doctrine_Query::create()
                ->select('m.*, fe.ci as funcionario_envia_ci, 
                        concat(fe.primer_nombre, \', \', fe.primer_apellido) as funcionario_envia, 
                        fr.ci as funcionario_recibe_ci, 
                        concat(fr.primer_nombre, \', \', fr.primer_apellido) as funcionario_recibe')
                ->from('Public_Mensajes m')
                ->innerjoin('m.Funcionarios_FuncionarioEnvia fe')
                ->innerjoin('m.Funcionarios_FuncionarioRecibe fr')
                ->where('m.id IN 
                        (SELECT MAX(pm.id) FROM Public_Mensajes pm 
                        WHERE pm.conversacion IN
                            (SELECT mm.conversacion FROM Public_Mensajes mm
                            WHERE mm.funcionario_envia_id = '.sfContext::getInstance()->getUser()->getAttribute('funcionario_id').'
                            OR mm.funcionario_recibe_id = '.sfContext::getInstance()->getUser()->getAttribute('funcionario_id').'
                            GROUP BY mm.conversacion)
                        GROUP BY pm.conversacion)')
                ->orderBy('m.id desc');

            return $q;
    }
    
    public function innerList2()
    {
            $q = Doctrine_Query::create()
                ->select('m.*, m.contenido, m.id')
                ->from('Public_Mensajes m')
                ->where('m.funcionario_envia_id = ?', sfContext::getInstance()->getUser()->getAttribute('funcionario_id'))
                ->addWhere('m.tipo= ?', 'E')
                ->orderBy('m.created_at desc');

            return $q;
    }

    public function detalleMensaje($id) {
        $q = Doctrine_Query::create()
                ->select('ma.*, ma.telf_movil, ma.email, ma.nombre')
                ->from('Public_MensajesMasivos ma')
                ->where('ma.IdMensajes = ?', $id)
                ->orderBy('ma.IdMensajes')
                ->execute();

        return $q;
    }

    public function mensajesActivos()
    {
            $q = Doctrine_Query::create()
                ->select('m.*, concat(fe.primer_nombre, \', \', fe.primer_apellido) as funcionario_envia, fe.ci as cedula_envia')
                ->from('Public_Mensajes m')
                ->innerjoin('m.Funcionarios_FuncionarioEnvia fe')
                ->where('m.status = ?', 'A')
                ->andWhere('m.funcionario_recibe_id = ?', sfContext::getInstance()->getUser()->getAttribute('funcionario_id'))
                ->orderBy('m.created_at desc')
                ->execute();

            return $q;
    }

    public function receptores($grupo,$unidad,$tipo,$condicion)
    {
        $receptores_ids = array(0);

        if($grupo!=null)
        {
            $q = Doctrine_Query::create()
                ->select('p.funcionario_id')
                ->from('Public_MensajesParticipantes p')
                ->where('p.mensajes_grupo_id = ?', $grupo)
                ->execute();

            $receptores_ids_tmp = array();
            for ($i = 0; $i < count($q); $i++)
                $receptores_ids_tmp[$i] = $q[$i]['funcionario_id'];

            $receptores_ids = array_merge($receptores_ids, $receptores_ids_tmp);
        }

        if($unidad!=null)
        {
            $q = Doctrine_Query::create()
                ->select('fc.funcionario_id')
                ->from('Funcionarios_FuncionarioCargo fc')
                ->where('fc.cargo_id IN (SELECT c.id
                        FROM Organigrama_Cargo c
                        WHERE c.unidad_funcional_id = '.$unidad.')')
                ->andWhere('fc.status = ?', 'A')
                ->execute();

            $receptores_ids_tmp = array();
            for ($i = 0; $i < count($q); $i++)
                $receptores_ids_tmp[$i] = $q[$i]['funcionario_id'];

            $receptores_ids = array_merge($receptores_ids, $receptores_ids_tmp);
        }

        if($tipo!=null)
        {
            $q = Doctrine_Query::create()
                ->select('fc.funcionario_id')
                ->from('Funcionarios_FuncionarioCargo fc')
                ->where('fc.cargo_id IN (SELECT c.id
                        FROM Organigrama_Cargo c
                        WHERE c.cargo_tipo_id IN ('.$tipo.'))')
                ->andWhere('fc.status = ?', 'A')
                ->execute();

            $receptores_ids_tmp = array();
            for ($i = 0; $i < count($q); $i++)
                $receptores_ids_tmp[$i] = $q[$i]['funcionario_id'];

            $receptores_ids = array_merge($receptores_ids, $receptores_ids_tmp);
        }

        if($condicion!=null)
        {
            $q = Doctrine_Query::create()
                ->select('fc.funcionario_id')
                ->from('Funcionarios_FuncionarioCargo fc')
                ->where('fc.cargo_id IN (SELECT c.id
                        FROM Organigrama_Cargo c
                        WHERE c.cargo_condicion_id IN ('.$condicion.'))')
                ->andWhere('fc.status = ?', 'A')
                ->execute();

            $receptores_ids_tmp = array();
            for ($i = 0; $i < count($q); $i++)
                $receptores_ids_tmp[$i] = $q[$i]['funcionario_id'];

            $receptores_ids = array_merge($receptores_ids, $receptores_ids_tmp);
        }

        $receptores_ids = array_unique($receptores_ids);

        return $receptores_ids;
    }

    public function mensajesChat($funcionario_receptor)
    {
            $q = Doctrine_Query::create()
                ->select('m.funcionario_envia_id, m.contenido')
                ->from('Public_Mensajes m')
                ->where('DATE(m.created_at) = ?',date('Y-m-d'))
                ->andWhere('m.funcionario_recibe_id = ?', $funcionario_receptor)
                ->andWhere('m.status = ?','A')
                ->orderBy('m.funcionario_envia_id, m.created_at desc')
                ->execute();

            return $q;
    }    
    
    public function conversacion($funcionario_uno, $funcionario_dos)
    {
            $q = Doctrine_Query::create()
                ->select('m.funcionario_envia_id, m.contenido, m.created_at, m.conversacion, 
                          fe.ci as funcionario_envia_ci, fr.ci as funcionario_recibe_ci')
                ->from('Public_Mensajes m')
                ->innerjoin('m.Funcionarios_FuncionarioEnvia fe')
                ->innerjoin('m.Funcionarios_FuncionarioRecibe fr')
//                ->where('DATE(m.created_at) = ?',date('Y-m-d'))
                ->Where('m.conversacion IS NOT NULL')    
                ->andWhere('((m.funcionario_envia_id = '.$funcionario_uno.' AND m.funcionario_recibe_id = '.$funcionario_dos.')
                         OR (m.funcionario_envia_id = '.$funcionario_dos.' AND m.funcionario_recibe_id = '.$funcionario_uno.'))')
                ->orderBy('m.created_at')
                ->execute();

            return $q;
    }
    
    public function mensajesHistorico($funcionario_uno, $funcionario_dos)
    {
            $q = Doctrine_Query::create()
                ->select('m.funcionario_envia_id, m.contenido, m.created_at, m.conversacion, 
                          fe.ci as funcionario_envia_ci, fr.ci as funcionario_recibe_ci')
                ->from('Public_Mensajes m')
                ->innerjoin('m.Funcionarios_FuncionarioEnvia fe')
                ->innerjoin('m.Funcionarios_FuncionarioRecibe fr')
                ->where('m.conversacion IS NOT NULL')    
                ->andWhere('((m.funcionario_envia_id = '.$funcionario_uno.' AND m.funcionario_recibe_id = '.$funcionario_dos.')
                         OR (m.funcionario_envia_id = '.$funcionario_dos.' AND m.funcionario_recibe_id = '.$funcionario_uno.'))')
                ->andWhere('m.id_eliminado !='.$funcionario_uno)
                ->orderBy('m.created_at')
                ->execute();

            return $q;
    }
    
    public function mensajes($funcionario_receptor,$funcionario_envia)
    {
            $q = Doctrine_Query::create()
                ->select('m.funcionario_envia_id, m.contenido')
                ->from('Public_Mensajes m')
                ->where('DATE(m.created_at) = ?',date('Y-m-d'))
                ->andWhere('(m.funcionario_envia_id = '.$funcionario_envia.' AND m.funcionario_recibe_id = '.$funcionario_receptor.')')
                ->andWhere('m.status = ?','A')
                ->orderBy('m.funcionario_envia_id, m.created_at desc')
                ->execute();

            return $q;
    }
}