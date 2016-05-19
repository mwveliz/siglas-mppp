<?php


class Seguridad_AlertaVisitanteTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Seguridad_AlertaVisitante');
    }
    
    static public $status = array(
        '' => '',
        'A' => 'Alerta activa',
        'I' => 'Alerta inactiva',
    );

    public function getStatus() {
        return self::$status;
    }
    
    public function innerList()
    {
        $q = Doctrine_Query::create()
            ->select('av.*')
            ->addSelect('(SELECT uc.nombre FROM Acceso_Usuario uc WHERE uc.id = av.id_create LIMIT 1) as user_create')
            ->addSelect('(SELECT uu.nombre FROM Acceso_Usuario uu WHERE uu.id = av.id_update LIMIT 1) as user_update')
            ->from('Seguridad_AlertaVisitante av')
            ->orderBy('av.updated_at desc');

        if (!sfContext::getInstance()->getUser()->hasCredential(array('Administrador','Root','Seguridad y Recepción'),false)) {
            
            $session_cargos = sfContext::getInstance()->getUser()->getAttribute('session_cargos');
            foreach ($session_cargos as $session_cargo) {
                $unidad_ids[] = $session_cargo['unidad_id'];
            }
            
            $funcionarios_unidades = Doctrine::getTable('Funcionarios_FuncionarioCargo')->funcionarioDeUnidades($unidad_ids);
            
            foreach ($funcionarios_unidades as $funcionario_unidad) {
                $funcionarios_ids[] = $funcionario_unidad->getId();
            }
            
            $usuarios_companeros = Doctrine::getTable('Acceso_Usuario')->usuariosDeFuncionarios($funcionarios_ids);
            
            foreach ($usuarios_companeros as $usuario_companero) {
                $usuarios_ids[] = $usuario_companero->getId();
            }
            
            $q->whereIn('av.id_create', $usuarios_ids);   
        }
        
        return $q;
    }
}