<?php


class Correspondencia_AnexoArchivoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_AnexoArchivo');
    }
    
    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
            $q = Doctrine_Query::create()
                ->select('caa.*')
                ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = caa.id_update LIMIT 1) as user_update')
                ->from('Correspondencia_AnexoArchivo caa')
                ->where('caa.correspondencia_id = ?', sfContext::getInstance()->getUser()->getAttribute('correspondencia_id'))
                ->orderBy('caa.nombre_original');

            return $q;

    }

    public function tiposAdjuntos() {
        $q = Doctrine_Query::create()
            ->select('aa.tipo_anexo_archivo as id, aa.tipo_anexo_archivo')
            ->from('Correspondencia_AnexoArchivo aa')
            ->groupBy('aa.id, aa.tipo_anexo_archivo')
            ->orderBy('aa.tipo_anexo_archivo')
            ->execute();

        return $q;
    }
    
    public function filtrarPorCorrespondencia($correspondencia_id)
    {
            $q = Doctrine_Query::create()
                ->select('caa.*')
                ->from('Correspondencia_AnexoArchivo caa')
                ->where('caa.correspondencia_id = ?', $correspondencia_id)
                ->useResultCache(true, 3600, 'correspondencia_AnexoArchivo_correspondencia_id_'.$correspondencia_id);

            return $q->execute();
    }
}