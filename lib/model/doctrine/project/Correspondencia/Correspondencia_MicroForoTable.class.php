<?php


class Correspondencia_MicroForoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_MicroForo');
    }
    
    public function tweetCorrespondencia($correspondencia_grupo)
    {
        $q = Doctrine_Query::create()
            ->select('mf.*, u.nombre as unidad, concat(f.primer_nombre, \', \', f.primer_apellido) as funcionario')
            ->from('Correspondencia_MicroForo mf')
            ->innerjoin('mf.Funcionarios_Funcionario f')
            ->innerjoin('mf.Organigrama_Unidad u')
            ->where('mf.correspondencia_grupo = ?', $correspondencia_grupo)
            ->orderBy('mf.created_at asc');

        return $q->execute();
    }
}