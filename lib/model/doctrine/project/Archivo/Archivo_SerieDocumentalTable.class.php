<?php


class Archivo_SerieDocumentalTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Archivo_SerieDocumental');
    }
    
    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('sd.*')
            ->addSelect("(SELECT COUNT(td.id) AS tipologias FROM Archivo_TipologiaDocumental td WHERE td.serie_documental_id = sd.id AND td.status = 'A' LIMIT 1) as tipologias")
            ->addSelect("(SELECT COUNT(e.id) AS expedientes FROM Archivo_Expediente e WHERE e.serie_documental_id = sd.id AND e.status = 'A' LIMIT 1) as expedientes")
            ->from('Archivo_SerieDocumental sd')
            ->where('sd.unidad_id = ?', sfContext::getInstance()->getUser()->getAttribute('funcionario_unidad_id'))
            ->andWhere('sd.status = ?','A')
            ->orderBy('sd.nombre');

        return $q;
    }
    
    public function serieUnidad($unidad_id,$status = 'A')
    {
        $q = Doctrine_Query::create()
            ->select('sd.*')
            ->addSelect("(SELECT COUNT(td.id) AS tipologias FROM Archivo_TipologiaDocumental td WHERE td.serie_documental_id = sd.id AND td.status = 'A' LIMIT 1) as tipologias")
            ->addSelect("(SELECT COUNT(e.id) AS expedientes FROM Archivo_Expediente e WHERE e.serie_documental_id = sd.id AND e.status = 'A' LIMIT 1) as expedientes")
            ->from('Archivo_SerieDocumental sd')
            ->where('sd.unidad_id = ?', $unidad_id)
            ->andWhere('sd.status = ?',$status)
            ->orderBy('sd.nombre')
            ->execute();

        return $q;
    }
    
    public function serieDeUnidadAutorizadas() 
    {
        $boss= false;
        if(sfContext::getInstance()->getUser()->getAttribute('funcionario_gr') == 99) {
            $boss= true;
            $funcionario_unidades_cargo = Doctrine::getTable('Funcionarios_FuncionarioCargo')->unidadDelCargoDelFuncionario(sfContext::getInstance()->getUser()->getAttribute('funcionario_id'));
        }

        $funcionario_unidades_admin = Doctrine::getTable('Archivo_FuncionarioUnidad')->adminFuncionarioGrupo(sfContext::getInstance()->getUser()->getAttribute('funcionario_id'));

        $cargo_array= array();
        if($boss) {
            foreach($funcionario_unidades_cargo as $unidades_cargo) {
                $cargo_array[]= $unidades_cargo->getUnidadId();
            }
        }

        $admin_array= array();
        for($i= 0; $i< count($funcionario_unidades_admin); $i++) {
            $admin_array[]= $funcionario_unidades_admin[$i][0];
        }

        $nonrepeat= array_merge($cargo_array, $admin_array);

        $funcionario_unidades= array(0);
        foreach ($nonrepeat as $valor){
            if (!in_array($valor, $funcionario_unidades)){
                $funcionario_unidades[]= $valor;
            }
        }

        $q = Doctrine_Query::create()
            ->select('sd.id, sd.nombre')
            ->from('Archivo_SerieDocumental sd')
            ->whereIn('sd.unidad_id', $funcionario_unidades)
            ->andWhere('sd.status = ?','A')
            ->orderBy('sd.nombre')
            ->execute();

        return $q;
    }
    
    public function seriesAutorizadasAFuncionario($funcionario_id,$permiso) 
    {
        if($permiso=='leer' || $permiso=='archivar' || 
           $permiso=='prestar' || $permiso=='administrar' ||
           $permiso=='anular'){
            $q = Doctrine_Query::create()
                ->select('sd.id, sd.nombre')
                ->from('Archivo_SerieDocumental sd')

                ->where('sd.unidad_id IN
                    (SELECT afu.autorizada_unidad_id FROM Archivo_FuncionarioUnidad afu
                     WHERE afu.'.$permiso.' = \'t\'
                     AND afu.funcionario_id = ?)',$funcionario_id)
//                ->andWhere('sd.status = ?','A')
                ->andWhere('sd.status = ?','A')
                ->orderBy('sd.nombre')
                ->execute();

            // AGREGAR STATUS A LAS SERIES DOCUMENTALES
            // REVISAR SERIES COMPARTIDAS POR UNIDAD Y FUNCIONARIO
            
            return $q;
        } else { echo 'Error: tipo permiso no valido'; }
    }
}