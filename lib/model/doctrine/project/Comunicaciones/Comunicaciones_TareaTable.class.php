<?php


class Comunicaciones_TareaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Comunicaciones_Tarea');
    }
    
    public function tareaDeCorrespondenciaPorFuncionario($correspondencia_id, $funcionario_id) {
        $q = Doctrine_Query::create()
            ->select('t.*')
            ->from('Comunicaciones_Tarea t')
            ->innerJoin('t.Comunicaciones_FuncionarioTarea ft')
            ->where("t.parametros ILIKE '%correspondencia_id: ''".$correspondencia_id."''%'")
            ->andWhere('ft.funcionario_id = ?',$funcionario_id)
            ->execute();

        return $q;
    }
}