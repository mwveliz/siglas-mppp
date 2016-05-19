<?php


class Archivo_ExpedienteTable extends BaseDoctrineTable
{

    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_Expediente');
    }

    public function innerListPropios() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('e.*')
            ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = e.id_update LIMIT 1) as user_update')
            ->from('Archivo_Expediente e')
            ->innerJoin('e.Archivo_SerieDocumental sd')
            ->where('e.unidad_id IN
                (SELECT afu.autorizada_unidad_id FROM Archivo_FuncionarioUnidad afu
                 WHERE afu.leer = \'t\' AND afu.status = \'A\' AND afu.funcionario_id = ?)',sfContext::getInstance()->getUser()->getAttribute('funcionario_id'))
            ->andWhere('e.status = ?','A')
            ->andWhere('sd.status = ?','A')
            ->orderBy('e.id desc');

        return $q;
    }

    public function innerListSolicitados() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('e.*')
            ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = e.id_update LIMIT 1) as user_update')
            ->from('Archivo_Expediente e')
            ->innerJoin('e.Archivo_SerieDocumental sd')
            ->where('e.id IN
                (SELECT pa.expediente_id FROM Archivo_PrestamoArchivo pa
                 WHERE pa.funcionario_id = ?)',sfContext::getInstance()->getUser()->getAttribute('funcionario_id'))
            ->andWhere('e.status = ?','A')
            ->andWhere('sd.status = ?','A')
            ->orderBy('e.id desc');

        return $q;
    }

    public function innerListCompartidos() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('e.*')
            ->addSelect('(SELECT us.nombre FROM Acceso_Usuario us WHERE us.id = e.id_update LIMIT 1) as user_update')
            ->from('Archivo_Expediente e')
            ->innerJoin('e.Archivo_SerieDocumental sd')
            ->Where('e.unidad_id IN
                (SELECT c.unidad_id FROM Archivo_Compartir c
                 INNERJOIN c.Archivo_CompartirFuncionario cf
                 WHERE cf.funcionario_id = ?)',sfContext::getInstance()->getUser()->getAttribute('funcionario_id'))
            ->andWhere('e.status = ?','A')
            ->andWhere('sd.status = ?','A')
            ->orderBy('e.id desc');

        return $q;
    }
    
    public function seriesPropias()
    {
        //Seleccion de serie documental en filtro, adaptado a bandeja
        $q = Doctrine_Query::create()
            ->select('e.id, sd.id as id, sd.nombre as nombre')
            ->from('Archivo_Expediente e')
            ->innerJoin('e.Archivo_SerieDocumental sd')
            ->where('e.unidad_id IN
                (SELECT afu.autorizada_unidad_id FROM Archivo_FuncionarioUnidad afu
                 WHERE afu.leer = \'t\' AND afu.status = \'A\' AND afu.funcionario_id = ?)',sfContext::getInstance()->getUser()->getAttribute('funcionario_id'))
            ->andWhere('e.status = ?','A')
            ->andWhere('sd.status = ?','A')
            ->execute();

        return $q;
    }
    
    public function expedientesPropiosPorPermiso($permisos)
    {
        $cadena_permisos = "";
        $permisos = explode(',', $permisos);
        foreach ($permisos as $permiso) {
            $cadena_permisos .= "afu.".$permiso." = 't' AND "; 
        }
        $cadena_permisos .= "#$%";
        $cadena_permisos = str_replace(" AND #$%", "", $cadena_permisos);
        
        $q = Doctrine_Query::create()
            ->select('e.*')
            ->from('Archivo_Expediente e')
            ->innerJoin('e.Archivo_SerieDocumental sd')
            ->where("e.unidad_id IN
                (SELECT afu.autorizada_unidad_id FROM Archivo_FuncionarioUnidad afu
                 WHERE ".$cadena_permisos." AND afu.status = 'A' 
                 AND afu.funcionario_id = ".sfContext::getInstance()->getUser()->getAttribute('funcionario_id').")")
            ->andWhere('e.status = ?','A')
            ->andWhere('sd.status = ?','A')
            ->orderBy('e.id desc')
            ->execute();

        return $q;
    }
}