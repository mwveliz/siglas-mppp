<?php


class Seguridad_PreingresoTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Seguridad_Preingreso');
    }
    
    public function innerList() {

        $q = Doctrine_Query::create()
            ->select('pi.*, m.descripcion as motivo_clasificado,
                      u.nombre as unidad, 
                      f.primer_nombre as funcionario_primer_nombre, f.segundo_nombre as funcionario_segundo_nombre,
                      f.primer_apellido as funcionario_primer_apellido, f.segundo_apellido as funcionario_segundo_apellido,')
            ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = pi.id_update LIMIT 1) as user_update')
            ->from('Seguridad_Preingreso pi')
            ->innerJoin('pi.Seguridad_Motivo m')
            ->innerJoin('pi.Organigrama_Unidad u')
            ->leftJoin('pi.Funcionarios_Funcionario f')
            ->orderBy('pi.id desc');

        if (!sfContext::getInstance()->getUser()->hasCredential(array('Administrador','Root','Seguridad y Recepción'),false)) {
            // BUSCAR TODOS LOS PREINGRESOS DE LAS OFICICNAS DONDE TENGO CARGO
            $session_cargos = sfContext::getInstance()->getUser()->getAttribute('session_cargos');
            foreach ($session_cargos as $session_cargo) {
                $unidad_ids[] = $session_cargo['unidad_id'];
            }
            
            $q->whereIn('u.id', $unidad_ids);   
            
            // BUSCAR TODOS LOS PREINGRESOS QUE HAN DADO MIS COMPANEROS A OTRAS OFICINAS
            
            $funcionarios_unidades = Doctrine::getTable('Funcionarios_FuncionarioCargo')->funcionarioDeUnidades($unidad_ids);
            
            foreach ($funcionarios_unidades as $funcionario_unidad) {
                $funcionarios_ids[] = $funcionario_unidad->getId();
            }
            
            $usuarios_companeros = Doctrine::getTable('Acceso_Usuario')->usuariosDeFuncionarios($funcionarios_ids);
            
            foreach ($usuarios_companeros as $usuario_companero) {
                $usuarios_ids[] = $usuario_companero->getId();
            }
            
            $q->orWhereIn('pi.id_update', $usuarios_ids);   
            
        }
        
        return $q;
    }
}