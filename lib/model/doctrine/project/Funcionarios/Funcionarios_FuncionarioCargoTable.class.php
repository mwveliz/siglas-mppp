<?php


class Funcionarios_FuncionarioCargoTable extends Doctrine_Table
{

    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_FuncionarioCargo');
    }

    static public $motivo_retiro = array(
        '' => '<- Seleccione ->',
        'Ascenso' => 'Ascenso',
        'Encargaduria a otro cargo' => 'Encargaduria a otro cargo',
        'Salida en comisión de servicios' => 'Salida en comisión de servicios',
        'Renuncia' => 'Renuncia',
        'Rescisión de contrato' => 'Rescisión de contrato',
        'Terminación de contrato' => 'Terminación de contrato',
        'Incapacidad Laboral' => 'Incapacidad Laboral',
        'Despido Justificado' => 'Despido Justificado',
        'Despido Injustificado' => 'Despido Injustificado',
        'Otro' => 'Otro',
    );

    public function getMotivoRetiro()
    {
        return self::$motivo_retiro;
    }

    public function innerList()
    {
            $q = Doctrine_Query::create()
                ->select('fc.*, u.nombre as unidad, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre, f.sexo as sexo')
                ->from('Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('fc.Funcionarios_Funcionario f')
                ->where('fc.funcionario_id = ?', sfContext::getInstance()->getUser()->getAttribute('pae_funcionario_id'));

            return $q;
    }

    public function unidadDelCargoDelFuncionario($funcionario_id)
    {
        $q = Doctrine_Query::create()
            ->select('fc.id, fc.f_ingreso, fc.f_retiro, 
                      u.id as unidad_id, fc.cargo_id as cargo_id, u.nombre as unidad,
                      c.cargo_grado_id as cargo_grado_id, c.cargo_tipo_id as cargo_tipo_id, 
                      c.cargo_condicion_id as cargo_condicion_id,
                      cc.nombre as cargo_condicion, ct.nombre as cargo_tipo, cg.nombre as cargo_grado')
            ->from('Funcionarios_FuncionarioCargo fc')
            ->innerjoin('fc.Organigrama_Cargo c')
            ->innerjoin('c.Organigrama_CargoCondicion cc')
            ->innerjoin('c.Organigrama_CargoTipo ct')
            ->innerjoin('c.Organigrama_CargoGrado cg')
            ->innerjoin('c.Organigrama_UnidadFuncional u')
            ->where('fc.funcionario_id = ?', $funcionario_id)
            ->andWhere('fc.status = ?', 'A');

        return $q->execute();
    }
    
    public function historicoCargosFuncionario($funcionario_id)
    {
        $q = Doctrine_Query::create()
            ->select('fc.id, fc.f_ingreso, fc.f_retiro, fc.status, 
                      u.id as unidad_id, fc.cargo_id as cargo_id, u.nombre as unidad,
                      c.cargo_grado_id as cargo_grado_id, c.cargo_tipo_id as cargo_tipo_id, 
                      c.cargo_condicion_id as cargo_condicion_id,
                      cc.nombre as cargo_condicion, cg.nombre as cargo_grado, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as cargo_tipo')
            ->from('Funcionarios_FuncionarioCargo fc')
            ->innerjoin('fc.Organigrama_Cargo c')
            ->innerjoin('c.Organigrama_CargoCondicion cc')
            ->innerjoin('c.Organigrama_CargoTipo ct')
            ->innerjoin('c.Organigrama_CargoGrado cg')
            ->innerjoin('c.Organigrama_UnidadFuncional u')
            ->innerjoin('fc.Funcionarios_Funcionario f')
            ->where('fc.funcionario_id = ?', $funcionario_id);

        return $q->execute();
    }

    public function datosFuncionario($funcionario_id)
    {
        $q = Doctrine_Query::create()
                ->select('c.id,f.id, f.primer_nombre as fnombre, f.primer_apellido as fapellido, fc.*,u.nombre as unombre,(CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->where('fc.status = ?', 'A')
                ->andWhere('f.id = ?', $funcionario_id)
                ->limit(1);

        return $q->execute();
    }

    public function funcionarioDeUnidadSinAlgunosConGrados($unidad_in_ids,$funcionario_notin_ids,$grado_in_ids)
    {
            $q = Doctrine_Query::create()
                ->select('f.*')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->leftjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->leftjoin('c.Organigrama_CargoGrado cg')
                ->where('fc.status = ?', 'A')
                ->andWhereIn('u.id', $unidad_in_ids)
                ->andWhereNotIn('f.id', $funcionario_notin_ids)
                ->andWhereIn('cg.id', $grado_in_ids)
                ->orderBy('f.primer_nombre, f.segundo_nombre, f.primer_apellido, f.segundo_apellido');

            return $q->execute();
    }

    public function funcionarioReceptor($unidad_in_ids)
    {
            $q = Doctrine_Query::create()
                ->select('f.*,fc.*,c.id as cid, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('c.Organigrama_CargoGrado cg')
                ->where('fc.status = ?', 'A')
                ->andWhereIn('u.id', $unidad_in_ids)
                ->andWhere('f.id NOT IN (SELECT co.funcionario_id FROM Correspondencia_Receptor co WHERE correspondencia_id = ?)', sfContext::getInstance()->getUser()->getAttribute('correspondencia_id'))
                //->andWhere('c.cargo_grado_id = ?', 99)
                ->orderBy('ct.orden, cg.orden, ct.nombre DESC, f.primer_nombre, f.segundo_nombre, f.primer_apellido, f.segundo_apellido');

            return $q->execute();
    }

    public function funcionariosPorUnidad($unidad_id)
    {
            $q = Doctrine_Query::create()
                ->select('f.id, c.id as c_id, cg.id as cg_id')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('c.Organigrama_CargoGrado cg')
                ->where('fc.status = ?', 'A')
                ->andWhere('u.id = ?', $unidad_id);

            return $q->execute();
    }

    public function funcionarioReceptorInterno()
    {
            $q = Doctrine_Query::create()
                ->select('f.*,fc.*, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('c.Organigrama_CargoGrado cg')
                ->where('fc.status = ?', 'A')
                ->andWhereIn('u.id', sfContext::getInstance()->getUser()->getAttribute('funcionario_unidad_id'))
                ->andWhereNotIn('f.id', sfContext::getInstance()->getUser()->getAttribute('funcionario_id'))
                ->orderBy('cg.orden, ct.nombre DESC, f.primer_nombre, f.segundo_nombre, f.primer_apellido, f.segundo_apellido');

            return $q->execute();
    }

    public function funcionarioEmisorInterno()
    {
            $q = Doctrine_Query::create()
                ->select('f.*,fc.*,(CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('c.Organigrama_CargoGrado cg')
                ->where('fc.status = ?', 'A')
                ->andWhereIn('u.id', sfContext::getInstance()->getUser()->getAttribute('funcionario_unidad_id'))
                ->orderBy('cg.orden, ct.nombre DESC, f.primer_nombre, f.segundo_nombre, f.primer_apellido, f.segundo_apellido');

            return $q->execute();
    }

    public function funcionarioDeUnidades($unidad_ids)
    {
            $q = Doctrine_Query::create()
                ->select('f.*,fc.*, fc.funcionario_id as funcionario_id,c.id as cid, c.padre_id as cargo_supervisor,(CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('c.Organigrama_CargoGrado cg')
                ->where('fc.status = ?', 'A')
                ->andWhereIn('u.id', $unidad_ids)
                ->orderBy('ct.orden, cg.orden, ct.nombre DESC, f.primer_nombre, f.segundo_nombre, f.primer_apellido, f.segundo_apellido');

            return $q->execute();
    }
    
    public function funcionarioAutorizadoCorrespondencia($unidad_in_ids,$unidad_autoriza_id)
    {
            $q = Doctrine_Query::create()
                ->select('f.*,fc.*,(CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('c.Organigrama_CargoGrado cg')
                ->where('fc.status = ?', 'A')
                ->andWhereIn('u.id', $unidad_in_ids)
                ->andWhere('f.id NOT IN (SELECT cfu.funcionario_id FROM Correspondencia_FuncionarioUnidad cfu WHERE status = ? and autorizada_unidad_id = ? and deleted_at is null)', array('A',$unidad_autoriza_id))
                ->orderBy('cg.orden, ct.nombre DESC, f.primer_nombre, f.segundo_nombre, f.primer_apellido, f.segundo_apellido');

            return $q->execute();
    }

    public function funcionarioAutorizadoArchivo($unidad_in_ids,$unidad_autoriza_id)
    {
            $q = Doctrine_Query::create()
                ->select('f.*,fc.*,(CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('c.Organigrama_CargoGrado cg')
                ->where('fc.status = ?', 'A')
                ->andWhereIn('u.id', $unidad_in_ids)
                ->andWhere('f.id NOT IN (SELECT cfu.funcionario_id FROM Archivo_FuncionarioUnidad cfu WHERE status = ? and autorizada_unidad_id = ? and deleted_at is null)', array('A',$unidad_autoriza_id))
                ->orderBy('cg.orden, ct.nombre DESC, f.primer_nombre, f.segundo_nombre, f.primer_apellido, f.segundo_apellido');

            return $q->execute();
    }

    public function funcionarioReceptorSelect($unidad_in_ids)
    {
            $q = Doctrine_Query::create()
                ->select('f.*,fc.*,(CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('c.Organigrama_CargoGrado cg')
                ->where('fc.status = ?', 'A')
                ->andWhereIn('u.id', $unidad_in_ids)
                ->andWhere('f.id NOT IN (SELECT co.funcionario_id FROM Correspondencia_Receptor co WHERE correspondencia_id = ?)', 0)
                //->andWhere('c.cargo_grado_id = ?', 99)
                ->orderBy('cr.orden, ct.nombre DESC, f.primer_nombre, f.segundo_nombre, f.primer_apellido, f.segundo_apellido');

            return $q->execute();
    }

    public function unidadCargoFuncionario($unidad_id,$funcionario_id)
    {
            $q = Doctrine_Query::create()
                ->select('f.*,fc.*,(CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre, u.siglas as siglas, u.nombre as unidad, fc.cargo_id as cargo_id')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('c.Organigrama_CargoGrado cg')
                ->where('fc.status = ?', 'A')
                ->andWhere('u.id=?', $unidad_id)
                ->andWhere('f.id=?', $funcionario_id);

            return $q->execute();
    }

    public function funcionarioDelCargo($cargo_id)
    {
            $q = Doctrine_Query::create()
                ->select('f.id, f.ci, concat(f.primer_nombre, \', \', f.primer_apellido) as persona, f.sexo, fc.observaciones as coletilla')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->where('fc.status = ?', 'A')
                ->andWhere('fc.cargo_id = ?', $cargo_id)
                ->limit(1);

            return $q->execute();
    }

    public function unidadCargoActual($funcionario_id)
    {
            $q = Doctrine_Query::create()
                ->select('fc.id,u.id as unidad_id, fc.cargo_id, u.nombre as unidad, ct.nombre as cargo_tipo, ct.id as id_cargo, fc.observaciones as coletilla')
                ->from('Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->where('fc.status = ?', 'A')
                ->andWhere('fc.funcionario_id = ?',$funcionario_id);

            return $q->execute();
    }

    public function cargoDelFuncionario($funcionario_id,$unidad_id)
    {
            $q = Doctrine_Query::create()
                ->select('fc.cargo_id')
                ->from('Funcionarios_FuncionarioCargo fc')
                ->innerJoin('fc.Organigrama_Cargo oc')
                ->where('fc.status = ?', 'A')
//                ->andWhere('oc.id = fc.cargo_id')
                ->andWhere('oc.unidad_funcional_id = ?',$unidad_id)
                ->andWhere('fc.funcionario_id = ?', $funcionario_id)
                ->limit(1);

            return $q->execute();
    }

    public function funcionariosDesdeUnidad($unidad_in_ids)
    {
        $q = Doctrine_Query::create()
            ->select('fc.*')
            ->from('Funcionarios_FuncionarioCargo fc')
            ->innerjoin('fc.Organigrama_Cargo c')
            ->innerjoin('c.Organigrama_UnidadFuncional u')
            ->Where('fc.status = ?', 'A')
            ->whereIn('u.id', $unidad_in_ids);

        return $q->execute();
    }
    
    public function funcionariosPrincipales($unidad_id)
    {
            $q = Doctrine_Query::create()
                ->select('f.*, c.id as cargo_id, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as cargo_tipo')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('c.Organigrama_CargoGrado cg')
                ->where('fc.status = ?', 'A')
                ->andWhere('c.unidad_funcional_id=?', $unidad_id)
                ->andWhere('ct.principal=?', TRUE);

            return $q->execute();
    }
    
    public function funcionariosCargoTipo($unidad_in_ids, $cargo_tipos)
    {
            $q = Doctrine_Query::create()
                ->select('f.*,fc.*,c.id as cid, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->innerjoin('c.Organigrama_UnidadFuncional u')
                ->innerjoin('c.Organigrama_CargoTipo ct')
                ->innerjoin('c.Organigrama_CargoGrado cg')
                ->where('fc.status = ?', 'A')
                ->andWhereIn('u.id', $unidad_in_ids)
                ->andWhereIn('c.cargo_tipo_id', $cargo_tipos)
                ->andWhere('f.id NOT IN (SELECT co.funcionario_id FROM Correspondencia_Receptor co WHERE correspondencia_id = ?)', sfContext::getInstance()->getUser()->getAttribute('correspondencia_id'))
                ->orderBy('ct.orden, cg.orden, ct.nombre DESC, f.primer_nombre, f.segundo_nombre, f.primer_apellido, f.segundo_apellido');

            return $q->execute();
    }
    
    public function coletillaPorUnidad($funcionario_id, $unidad_id)
    {
        //UBICA LA COLETILLA DEL CARGO ACTIVO, TOMA EN CUENTA SI ESTE POSEE DOS CARGOS ACTIVOS EN DISTINTAS UNIDADES
            $q = Doctrine_Query::create()
                ->select('fc.*, c.id')
                ->from('Funcionarios_FuncionarioCargo fc')
                ->innerjoin('fc.Organigrama_Cargo c')
                ->where('fc.funcionario_id = ?', $funcionario_id)
                ->andWhere('c.unidad_funcional_id = ?', $unidad_id)
                ->andWhere('fc.status = ?', 'A')
                ->limit(1);

            return $q->execute();
    }
}
