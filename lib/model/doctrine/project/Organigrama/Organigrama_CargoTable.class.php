<?php


class Organigrama_CargoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Organigrama_Cargo');
    }

    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $inactivo = sfContext::getInstance()->getUser()->getAttribute('inactivo');
        
        $status = array('V', 'O');
        if($inactivo) {
            $status = array('I');
        }

        $q = Doctrine_Query::create()
            ->select('c.*, cc.nombre as condicion, ct.nombre as tipo, cg.nombre as grado')
            ->from('Organigrama_Cargo c')
            ->innerJoin('c.Organigrama_CargoCondicion cc')
            ->innerJoin('c.Organigrama_CargoTipo ct')
            ->innerJoin('c.Organigrama_CargoGrado cg')
            ->where('c.unidad_funcional_id = ?', sfContext::getInstance()->getUser()->getAttribute('unidad_funcional_id'))
            ->andWhereIn('c.status', $status)
            ->orderBy('ct.orden, cg.orden');

        return $q;
    }

    public function cargosVacios($unidad_id)
    {
        $cargos_vacios = Doctrine_Query::create()
                        ->select('c.*, cc.nombre as cargo_condicion, ct.nombre as cargo_tipo, cg.nombre as cargo_grado')
                        ->from('Organigrama_Cargo c')
                        ->innerjoin('c.Organigrama_CargoCondicion cc')
                        ->innerjoin('c.Organigrama_CargoTipo ct')
                        ->innerjoin('c.Organigrama_CargoGrado cg')
                        ->where('c.status = ?','V')
                        ->andWhere('c.unidad_funcional_id = ?',$unidad_id)
                        ->orderby('ct.orden, cg.orden, ct.nombre DESC')
//                        ->useResultCache(true, 3600, 'unidad_cargos_vacios_'.$unidad_id)
                        ->execute();
        
        return $cargos_vacios;
    }
    
    
    public static function cargosVaciosMigracion()
    {
        $unidad_cargos = array();
        $unidades = Doctrine_Query::create()
            ->select('u.*')
            ->from('Organigrama_Unidad u')
            ->orderBy('u.nombre')
//            ->useResultCache(true, 3600, 'unidad_cargos_vacios')
            ->execute();
        
        foreach ($unidades as $unidad) {
            $cargos = Doctrine_Query::create()
                ->select('c.*')
                ->from('Organigrama_Cargo c')
                ->where('c.status = ?','V')
                ->andWhere('c.unidad_funcional_id = ?',$unidad->getId())
                ->orderby('c.id')
//                ->useResultCache(true, 3600, 'cargo_tipos_grados_'.$unidad->getId())
                ->execute();
            
//            $e = new Organigrama_Cargo();
//            $e->getOrganigramaCargoCondicion()
//            
            $cargos_tmp=array();
            foreach ($cargos as $cargo) {
                $cargos_tmp[$cargo->getId()] = $cargo->getOrganigramaCargoCondicion()->getNombre().' - '.
                                               $cargo->getOrganigramaCargoTipo()->getNombre().' - '.
                                               $cargo->getOrganigramaCargoGrado()->getNombre();
            }
            
            if(count($cargos_tmp)>0){
                $unidad_cargos[$unidad->getId()] = $cargos_tmp;
                $cargos_tmp=null;
            }
        }
//        echo "<pre>";        print_r($unidad_cargos); exit();
        return $unidad_cargos;
    }
    
    public function mantenerCargos($cargo_id)
    {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Organigrama_Cargo c')
            ->where('c.id = ?', $cargo_id)
            ->execute();

        return $q;
    }

    public function autoridadesPorUnidad($unidades)
    {
        //NO FUNCIONA EL INNER JOIN trae un solo registro
//            $q = Doctrine_Query::create()
//                ->select('oc.id as cargo_id')
//                ->from('Organigrama_Cargo oc')
//                ->innerjoin('oc.Funcionarios_FuncionarioCargo ffc')
//                ->where('oc.cargo_grado_id = ?', 99)
//                ->andWhereIn('oc.unidad_funcional_id', $unidades)
//                ->execute();
//            
//            return $q;
            
            $ids = implode(", ", $unidades);
            
            $query= "select oc.id as cargo_id, oc.unidad_funcional_id as oc_unidad, ffc.funcionario_id as funcionario_id
                from organigrama.cargo oc
                inner join funcionarios.funcionario_cargo ffc
                on oc.id = ffc.cargo_id
                where oc.cargo_grado_id= '99'
                and oc.unidad_funcional_id IN ($ids)
                and ffc.status = 'A'";
        return Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);
    }
    
    public function datosDeCargo($cargo_id)
    {
        $q = Doctrine_Query::create()
            ->select('c.*, cc.nombre as condicion, ct.nombre as tipo, ct.masculino as tipo_masculino, ct.femenino as tipo_femenino, cg.nombre as grado, u.nombre as unidad')
            ->from('Organigrama_Cargo c')
            ->innerJoin('c.Organigrama_CargoCondicion cc')
            ->innerJoin('c.Organigrama_CargoTipo ct')
            ->innerJoin('c.Organigrama_CargoGrado cg')
            ->innerJoin('c.Organigrama_UnidadFuncional u')
            ->where('c.id = ?', $cargo_id)
            ->execute();

        return $q;
    }
}