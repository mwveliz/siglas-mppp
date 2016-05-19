<?php


class Correspondencia_PlantillaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_Plantilla');
    }
    
    public function tipoFormatoDeFuncionario($tipo_formato_id, $funcionario_id)
    {
        $q = Doctrine_Query::create()
            ->select('p.*')
            ->from('Correspondencia_Plantilla p')
            ->innerjoin('p.Correspondencia_PlantillaFuncionario pf')
            ->where('p.tipo_formato_id = ?',$tipo_formato_id)
            ->andWhere('pf.funcionario_id = ?',$funcionario_id)
            ->orderBy('p.nombre');

        return $q->execute();
    }
}