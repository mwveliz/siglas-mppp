<?php


class Funcionarios_FuncionarioTable extends Doctrine_Table
{

    public static function getInstance()
    {
        return Doctrine_Core::getTable('Funcionarios_Funcionario');
    }

    static public $sexo = array(
        'M' => 'Masculino',
        'F' => 'Femenino',
    );

    static public $edo_civil = array(
        'S' => 'Soltero',
        'C' => 'Casado',
        'D' => 'Divorciado',
        'V' => 'Viudo',
    );
    
    static public $email_validado = array(
        FALSE => 'Por validar',
        TRUE => 'validado',
    );

    public function getSexo()
    {
        return self::$sexo;
    }

    public function getEdoCivil()
    {
        return self::$edo_civil;
    }
    
    public function getEmailValidado()
    {
        return self::$email_validado;
    }

    public function innerList()
    {
        $inactivo = sfContext::getInstance()->getUser()->getAttribute('func_inactivo');
        
        $status = array('A', 'D');
        if($inactivo) {
            $status = array('I');
        }
        
        $q = Doctrine_Query::create()
            ->select('f.*')
            ->from('Funcionarios_Funcionario f')
            ->whereIn('f.status', $status)
            ->orderBy('f.id DESC');

        return $q;
    }
    
    public function datosSessionFuncionario($funcionario_id)
    {
        $q = Doctrine_Query::create()
            ->select('fc.id,f.ci as ci,
                    f.primer_nombre as primer_nombre,
                    f.segundo_nombre as segundo_nombre,
                    f.primer_apellido as primer_apellido,
                    f.segundo_apellido as segundo_apellido,
                    f.email_personal as email_personal, f.telf_movil as telf_movil,
                    f.f_nacimiento as fecha_nacimiento, edo_civil as edo_civil,
                    f.sexo as sexo, c.padre_id as padre_cargo_id,
                    fc.cargo_id as cargo_id,c.codigo_nomina as cnomina,
                    ct.id as cargo_tipo_id, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre,
                    cc.id as cargo_condicion_id, cc.nombre as ccnombre, cg.id as cgid, cg.nombre as cgnombre,
                    c.unidad_funcional_id as unidad_id, u.nombre as unombre, u.nombre_reducido as ureducido, u.siglas as usiglas')
            ->from('Funcionarios_FuncionarioCargo fc')
            ->innerjoin('fc.Funcionarios_Funcionario f')
            ->leftjoin('fc.Organigrama_Cargo c')
            ->innerjoin('c.Organigrama_UnidadFuncional u')
            ->leftjoin('c.Organigrama_CargoTipo ct')
            ->leftjoin('c.Organigrama_CargoCondicion cc')
            ->leftjoin('c.Organigrama_CargoGrado cg')
            ->where('fc.status = ?', 'A')
            ->andWhere('f.id = ?', $funcionario_id);

        return $q->execute();
    }
    
    public function datosSessionFuncionarioCargo($funcionario_id,$cargo_id,$historia=FALSE)
    {
        $q = Doctrine_Query::create()
            ->select('fc.id,f.ci as ci,
                    f.primer_nombre as primer_nombre,
                    f.segundo_nombre as segundo_nombre,
                    f.primer_apellido as primer_apellido,
                    f.segundo_apellido as segundo_apellido,
                    f.email_personal as email_personal, f.telf_movil as telf_movil,
                    f.f_nacimiento as fecha_nacimiento, edo_civil as edo_civil,
                    f.sexo as sexo, c.padre_id as padre_cargo_id,
                    fc.cargo_id as cargo_id,c.codigo_nomina as cnomina,
                    ct.id as cargo_tipo_id, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre,
                    cc.id as cargo_condicion_id, cc.nombre as ccnombre, cg.id as cgid, cg.nombre as cgnombre,
                    c.unidad_funcional_id as unidad_id, u.nombre as unombre, u.siglas as usiglas')
            ->from('Funcionarios_FuncionarioCargo fc')
            ->innerjoin('fc.Funcionarios_Funcionario f')
            ->leftjoin('fc.Organigrama_Cargo c')
            ->innerjoin('c.Organigrama_UnidadFuncional u')
            ->leftjoin('c.Organigrama_CargoTipo ct')
            ->leftjoin('c.Organigrama_CargoCondicion cc')
            ->leftjoin('c.Organigrama_CargoGrado cg');
                
            //SI LA CONSULTA ES PARA HISTORIAS, NO TOMA EN CUENTA EL STATUS. EJ. CORRESPONDENCIA FIRMADA ANTERIORMENTE POR UN GERENTE DIFERENTE AL ACTUAL
            if(!$historia)
                $q ->andWhere('fc.status = ?','A');
            
            $q ->where('fc.status = ?', 'A')
            ->andWhere('f.id = ?', $funcionario_id)
            ->andWhere('c.id = ?', $cargo_id);

        return $q->execute();
    }
    
    public function datosSessionFuncionarioCargoHistorico($funcionario_id,$cargo_id)
    {
        //DATOS DEL FUNCIONARIO POR CARGO Y FUNCIONARIO ASI EL CARGO NO ESTE ACTIVO PARA EL FUNCIONARIO
        $q = Doctrine_Query::create()
            ->select('fc.id,f.ci as ci,
                    f.primer_nombre as primer_nombre,
                    f.segundo_nombre as segundo_nombre,
                    f.primer_apellido as primer_apellido,
                    f.segundo_apellido as segundo_apellido,
                    f.email_personal as email_personal, f.telf_movil as telf_movil,
                    f.f_nacimiento as fecha_nacimiento, edo_civil as edo_civil,
                    f.sexo as sexo, c.padre_id as padre_cargo_id,
                    fc.cargo_id as cargo_id,c.codigo_nomina as cnomina,
                    ct.id as cargo_tipo_id, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre,
                    cc.id as cargo_condicion_id, cc.nombre as ccnombre, cg.id as cgid, cg.nombre as cgnombre,
                    c.unidad_funcional_id as unidad_id, u.nombre as unombre, u.siglas as usiglas')
            ->from('Funcionarios_FuncionarioCargo fc')
            ->innerjoin('fc.Funcionarios_Funcionario f')
            ->leftjoin('fc.Organigrama_Cargo c')
            ->innerjoin('c.Organigrama_UnidadFuncional u')
            ->leftjoin('c.Organigrama_CargoTipo ct')
            ->leftjoin('c.Organigrama_CargoCondicion cc')
            ->leftjoin('c.Organigrama_CargoGrado cg')
//            ->where('fc.status = ?', 'A')
            ->Where('f.id = ?', $funcionario_id)
            ->andWhere('c.id = ?', $cargo_id);

        return $q->execute();
    }

    public function funcionariosActivos()
    {
        $q = Doctrine_Query::create()
                ->select('f.*')
                ->addSelect('(SELECT u.ultimo_status FROM Acceso_Usuario u WHERE u.usuario_enlace_id=f.id) AS ultimo_status')
                ->from('Funcionarios_Funcionario f')
                ->innerjoin('f.Funcionarios_FuncionarioCargo fc')
                ->where('fc.status = ?', 'A')
                ->orderBy('f.primer_nombre');
                //->useResultCache(true, 3600, 'cache_funcionarios_activos_'.$this->getUser()->getAttribute('funcionario_id'));

        return $q->execute();
    }
    
    public function funcionariosPorValidarGrupo($unidad_id)
    {
        $q = Doctrine_Query::create()
                ->select('fc.id, f.id, cfu.updated_at as updated_at,
                    cfu.id, cfu.permitido_funcionario as permitido_funcionario_id,
                    cfu.autorizada_unidad_id as autorizada_unidad_id, cfu.dependencia_unidad_id as dependencia_unidad_id,
                    cfu.funcionario_id as funcionario_id, f.primer_nombre as primer_nombre,
                    f.primer_apellido as primer_apellido, f.ci as ci,
                    oc.unidad_funcional_id as unidad_funcional_id, ou.nombre as unidad_nombre')
                ->from('Correspondencia_FuncionarioUnidad cfu')
                ->innerJoin('cfu.Funcionarios_Funcionario f')
                ->innerJoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerJoin('fc.Organigrama_Cargo oc')
                ->innerJoin('oc.Organigrama_UnidadFuncional ou')
                ->where('cfu.permitido = ?', 'FALSE')
                ->andWhere('cfu.autorizada_unidad_id= ?', $unidad_id);

        return $q->execute();

//        $query= "select cfu.updated_at, cfu.id, cfu.permitido_funcionario_id, cfu.autorizada_unidad_id, cfu.dependencia_unidad_id, cfu.funcionario_id, f.primer_nombre, f.primer_apellido, f.ci, oc.unidad_funcional_id, ou.nombre as unidad_nombre
//                from correspondencia.funcionario_unidad cfu
//                inner join funcionarios.funcionario f
//                on cfu.funcionario_id = f.id
//                inner join funcionarios.funcionario_cargo fc
//                on cfu.funcionario_id = fc.funcionario_id
//                inner join organigrama.cargo oc
//                on fc.cargo_id = oc.id
//                inner join organigrama.unidad ou
//                on oc.unidad_funcional_id = ou.id
//                where cfu.autorizada_unidad_id= '$unidad_id'
//                and cfu.permitido= 'FALSE'";
//        return Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);
    }

    public function funcionariosPorValidarGrupoArchivo($unidad_id)
    {
        $q = Doctrine_Query::create()
                ->select('fc.id, f.id, cfu.updated_at as updated_at,
                    cfu.id, cfu.permitido_funcionario as permitido_funcionario_id,
                    cfu.autorizada_unidad_id as autorizada_unidad_id, cfu.dependencia_unidad_id as dependencia_unidad_id,
                    cfu.funcionario_id as funcionario_id, f.primer_nombre as primer_nombre,
                    f.primer_apellido as primer_apellido, f.ci as ci,
                    oc.unidad_funcional_id as unidad_funcional_id, ou.nombre as unidad_nombre')
                ->from('Archivo_FuncionarioUnidad cfu')
                ->innerJoin('cfu.Funcionarios_Funcionario f')
                ->innerJoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerJoin('fc.Organigrama_Cargo oc')
                ->innerJoin('oc.Organigrama_UnidadFuncional ou')
                ->where('cfu.permitido = ?', 'FALSE')
                ->andWhere('cfu.autorizada_unidad_id= ?', $unidad_id);

        return $q->execute();

//        $query= "select cfu.updated_at, cfu.id, cfu.permitido_funcionario_id, cfu.autorizada_unidad_id, cfu.dependencia_unidad_id, cfu.funcionario_id, f.primer_nombre, f.primer_apellido, f.ci, oc.unidad_funcional_id, ou.nombre as unidad_nombre
//                from archivo.funcionario_unidad cfu
//                inner join funcionarios.funcionario f
//                on cfu.funcionario_id = f.id
//                inner join funcionarios.funcionario_cargo fc
//                on cfu.funcionario_id = fc.funcionario_id
//                inner join organigrama.cargo oc
//                on fc.cargo_id = oc.id
//                inner join organigrama.unidad ou
//                on oc.unidad_funcional_id = ou.id
//                where cfu.autorizada_unidad_id= '$unidad_id'
//                and cfu.permitido= 'FALSE'";
//        return Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);
    }
    
    //NUEVO METODO PARA COMUNICACIONES
    public function funcionarioDatosComunicacines($funcionario_id)
    {
        $q = Doctrine_Query::create()
                ->select('fc.id, f.id, cfu.updated_at as updated_at,
                    cfu.id, cfu.permitido_funcionario as permitido_funcionario_id,
                    cfu.autorizada_unidad_id as autorizada_unidad_id, cfu.dependencia_unidad_id as dependencia_unidad_id,
                    cfu.funcionario_id as funcionario_id, f.primer_nombre as primer_nombre,
                    f.primer_apellido as primer_apellido, f.ci as ci,
                    oc.unidad_funcional_id as unidad_funcional_id, ou.nombre as unidad_nombre')
                ->from('Correspondencia_FuncionarioUnidad cfu')
                ->innerJoin('cfu.Funcionarios_Funcionario f')
                ->innerJoin('f.Funcionarios_FuncionarioCargo fc')
                ->innerJoin('fc.Organigrama_Cargo oc')
                ->innerJoin('oc.Organigrama_UnidadFuncional ou')
                ->where('fc.status = ?', 'A')
                ->andWhere('f.id = ?', $funcionario_id)
                ->limit(1);

        return $q->execute();
    }

    public function busquedaFuncionario($funcionario_id)
    {
        $q = Doctrine_Query::create()
           ->select('f.primer_nombre, f.primer_apellido, f.id')
           ->from('Funcionarios_Funcionario f');
        
        if(is_array($funcionario_id))
            $q->whereIn('f.id',$funcionario_id);
        else
            $q->where('f.id = ?',$funcionario_id);

        return $q->execute();
    }
    
    public function busquedaSupervisor($padre_cargo_id)
    {
        $q = Doctrine_Query::create()
           ->select('fc.id, f.primer_nombre as primer_nombre, f.primer_apellido as primer_apellido, f.id as funcionario_id')
           ->from('Funcionarios_FuncionarioCargo fc')
           ->innerJoin('fc.Funcionarios_Funcionario f')
           ->where('fc.cargo_id = ?',$padre_cargo_id)
           ->andWhere('fc.status = ?', 'A')
           ->execute();

        return $q;
    }
    
    public function busquedaFuncionarioCargoUnidad($funcionario_id)
    {
         $q = Doctrine_Query::create()
            ->select('fc.id,
                    f.ci as ci,
                    f.primer_nombre as primer_nombre,
                    f.segundo_nombre as segundo_nombre,
                    f.primer_apellido as primer_apellido,
                    f.segundo_apellido as segundo_apellido,
                    f.sexo as sexo,
                    f.id as funcionario_id,
                    fc.cargo_id as cargo_id,
                    c.unidad_funcional_id as unidad_id, u.nombre as unombre')
            ->from('Funcionarios_FuncionarioCargo fc')
            ->innerjoin('fc.Funcionarios_Funcionario f')
            ->leftjoin('fc.Organigrama_Cargo c')
            ->innerjoin('c.Organigrama_UnidadFuncional u')
            ->where('fc.status = ?', 'A')
            ->andWhere('f.id = ?', $funcionario_id);

        return $q->execute();
    }
    
    public function busquedaFuncionarioJefes($funcionario_id)
    {
        //DQL para buscar jefes de una unidad, debe ser reacomodado
         $q = Doctrine_Query::create()
            ->select('fc.id,
                    f.ci as ci,
                    f.primer_nombre as primer_nombre,
                    f.segundo_nombre as segundo_nombre,
                    f.primer_apellido as primer_apellido,
                    f.segundo_apellido as segundo_apellido,
                    f.sexo as sexo,
                    f.id as funcionario_id,
                    fc.cargo_id as cargo_id,
                    ct.id as cargo_tipo_id, (CASE WHEN f.sexo=\'M\' THEN ct.masculino WHEN f.sexo=\'F\' THEN ct.femenino END) as ctnombre,
                    c.unidad_funcional_id as unidad_id, u.nombre as unombre')
            ->from('Funcionarios_FuncionarioCargo fc')
            ->innerjoin('fc.Funcionarios_Funcionario f')
            ->leftjoin('fc.Organigrama_Cargo c')
            ->innerjoin('c.Organigrama_UnidadFuncional u')
            ->leftjoin('c.Organigrama_CargoTipo ct')
            ->where('fc.status = ?', 'A')
            ->andWhere('f.id = ?', $funcionario_id);

        return $q->execute();
    }
    
    public static function getFuncionarioByUnidad()
    {
        //uni
        $funcionarios = Doctrine_Query::create()
            ->select('f.id,f.primer_nombre,f.primer_apellido,c.descripcion as cargo,u.id as unidad_id,u.nombre as unidad,u2.nombre as unidad_padre')
            ->from('Funcionarios_Funcionario f')
            ->innerJoin('f.Funcionarios_FuncionarioCargo fc')
            ->innerJoin('fc.Organigrama_Cargo c')
            ->innerJoin('c.Organigrama_UnidadFuncional u')
            ->innerJoin('c.Organigrama_UnidadFuncional u2 on u2.id = u.padre_id')
            ->where('f.status = ?', 'A')
            ->orderBy('f.primer_apellido')
            ->execute();
        //piso
        $unidades = Doctrine_Query::create()
            ->select('DISTINCT u.id,u.nombre')
            ->from('Organigrama_Unidad u')
            ->orderBy('u.nombre')
            ->execute();
        
        $arr = array();$arr_funcionario = array();
        
        foreach($unidades as $unidad){
            foreach($funcionarios as $funcionario){
                if($unidad->getId() == $funcionario->getUnidadId())
                    $arr_funcionario = $arr_funcionario + array($funcionario->getId() => $funcionario->getPrimerApellido().' '.$funcionario->getPrimerNombre());    
            }
            $arr += array($unidad->getId()=>$arr_funcionario);
            $arr_funcionario=array();
        }            
            
        //print_r($arr);exit();
        return $arr;
    }
    
    public function getDataWhere($string){
        $q = Doctrine_Query::create()
                ->select('n.id, n.primer_nombre,n.segundo_nombre, n.primer_apellido, n.segundo_apellido')
                ->from('Funcionarios_Funcionario n')
                ->where('n.primer_nombre ILIKE ?', '%'.$string.'%')
                ->orWhere('n.segundo_nombre ILIKE ?', '%'.$string.'%')
                ->orWhere('n.primer_apellido ILIKE ?', '%'.$string.'%')
                ->orWhere('n.segundo_apellido ILIKE ?', '%'.$string.'%')
                ->execute()
                ->getData();
        return $q;
   } 
    
}