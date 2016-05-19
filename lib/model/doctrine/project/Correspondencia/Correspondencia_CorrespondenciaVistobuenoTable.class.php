<?php


class Correspondencia_CorrespondenciaVistobuenoTable extends BaseDoctrineTable
{

    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_CorrespondenciaVistobueno');
    }

    public function vistobuenoConfig($unidad_id, $funcionario_id) {
        //$unidad_id unidad a la que pertenece la correspondencia que se esta creando
        //$funcionario_id funcionario firmante de la correspondencia
        //$funcionario_cargo_id id del firmante de la unidad, utilizado para comparar en tabla vb config
        $q = Doctrine_Query::create()
            ->select('cv.*')
            ->from('Correspondencia_VistobuenoConfig cv')
            ->innerJoin('cv.Correspondencia_FuncionarioUnidad fu')
            ->Where('fu.autorizada_unidad_id = ?', $unidad_id)
            ->andWhere('fu.funcionario_id = ?', $funcionario_id)
            ->andWhere('fu.status = ?', 'A')
            ->andWhere('cv.status = ?', 'A')
            ->orderBy('cv.orden desc')
            ->execute();

        return $q;
    }

    public function funcionarios_vistobueno($correspondencia_id) {
        //vistos buenos de esta correspondencia, nombres de funcionarios
        $q = Doctrine_Query::create()
            ->select('f.primer_nombre as pnombre, f.primer_apellido as papellido, cv.*')
            ->addSelect('(SELECT COUNT(cvb.status) AS nonfirm FROM Correspondencia_CorrespondenciaVistobueno cvb WHERE cvb.status NOT IN (\'V\', \'D\') AND cvb.correspondencia_id = ' . $correspondencia_id . ' LIMIT 1) as nonfirm')
            ->from('Correspondencia_CorrespondenciaVistobueno cv')
            ->innerJoin('cv.Funcionarios_Funcionario f')
            ->Where('cv.correspondencia_id = ?', $correspondencia_id)
            ->orderBy('cv.orden desc')
            ->execute();

        return $q;
    }

    public function vistobuenoCorrespondenciaAsc($correspondencia_id) {
        $q = Doctrine_Query::create()
            ->select('cv.*')
            ->from('Correspondencia_CorrespondenciaVistobueno cv')
            ->where('cv.correspondencia_id = ?', $correspondencia_id)
            ->orderBy('cv.orden asc')
            ->execute();

        return $q;
    }

    public function vistobuenoCorrespondenciaDesc($correspondencia_id) {
        $q = Doctrine_Query::create()
            ->select('cv.*')
            ->from('Correspondencia_CorrespondenciaVistobueno cv')
            ->where('cv.correspondencia_id = ?', $correspondencia_id)
            ->orderBy('cv.orden desc')
            ->execute();

        return $q;
    }
}