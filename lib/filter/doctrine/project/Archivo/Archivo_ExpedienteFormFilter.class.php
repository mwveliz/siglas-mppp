<?php

/**
 * Archivo_Expediente filter form.
 *
 * @package    siglas
 * @subpackage filter
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Archivo_ExpedienteFormFilter extends BaseArchivo_ExpedienteFormFilter
{ 
    public function insensitiveSearch($word,$type='basic') {
        $herramientas = new herramientas();
        return $herramientas->insensitiveSearch($word, $type);
    }
    
    public function configure()
    {
        $this->widgetSchema['contenido_documento'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->validatorSchema['contenido_documento'] = new sfValidatorPass(array('required' => false));
        
        $this->widgetSchema['valores_expediente'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->validatorSchema['valores_expediente'] = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['cuerpo_documental_id'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->validatorSchema['cuerpo_documental_id'] = new sfValidatorPass(array('required' => false));
        
        $this->widgetSchema['tipologia_documental_id'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->validatorSchema['tipologia_documental_id'] = new sfValidatorPass(array('required' => false));
        
        $this->widgetSchema['valores_documento'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->validatorSchema['valores_documento'] = new sfValidatorPass(array('required' => false));
    }
    
    public function getFields() {
        return parent::getFields() + array(
            'contenido_documento' => 'Text',
            'valores_expediente' => 'Text',
            'cuerpo_documental_id' => 'Text',
            'tipologia_documental_id' => 'Text',
            'valores_documento' => 'Text',
        );
    }
    
    public function addContenidoDocumentoColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $a = $query->getRootAlias();
            
            $query->innerJoin($a . '.Archivo_Documento ad')
                    ->andWhere("ad.contenido_automatico ~* '".$values['text']."'");
        }
    }
    
    public function addValoresExpedienteColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if (count($values) > 0) {
            $a = $query->getRootAlias();
            
            $ids_cumplen=array();
            foreach ($values as $clasificador_id => $valor) {

                $valor = $this->insensitiveSearch($valor);
                
                $valores = Doctrine::getTable('Archivo_ExpedienteClasificador')
                                    ->createQuery('a')
                                    ->where("a.clasificador_id = ?", $clasificador_id)
                                    ->andWhere("a.valor ~* ?", $valor)
                                    ->execute();
                
                foreach ($valores as $value) {
                    if(!isset($ids_cumplen[$value->getExpedienteId()]))
                        $ids_cumplen[$value->getExpedienteId()]=0;

                    $ids_cumplen[$value->getExpedienteId()]++;
                } 
            }
            
            $i=0; $ids_finales = array();
            foreach ($ids_cumplen as $key => $value) {
                if($value==count($values)){
                    $ids_finales[$i] = $key;
                    $i++;
                }
            }
            
            if(count($ids_finales>0))
                $query->andWhereIn($a.".id", $ids_finales);
        }
    }
    
    public function addCuerpoDocumentalIdColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro

        if ($values != null) {
            $a = $query->getRootAlias();
            
            $query->innerJoin($a . '.Archivo_ExpedienteCuerpoDocumental ecd')
                    ->andWhere("ecd.cuerpo_documental_id = ?", $values);
        }
    }
    
    public function addTipologiaDocumentalIdColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro

        if ($values['id'] != null) {
            $a = $query->getRootAlias();
            
            if(isset($values['vacio'])) {
                $query->andWhere($a.".id NOT IN
                        (SELECT dst.expediente_id 
                        FROM Archivo_Documento dst 
                        WHERE dst.tipologia_documental_id = ".$values['id']."
                        AND dst.status = 'A')");
                        
            } else {
                $query->andWhere($a.".id IN
                        (SELECT dst.expediente_id 
                        FROM Archivo_Documento dst 
                        WHERE dst.tipologia_documental_id = ".$values['id']."
                        AND dst.status = 'A')");
            }
        }
    }
    
    public function addValoresDocumentoColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
//        echo print_r($values); echo "--"; exit();
        if (count($values) > 0) {
            $a = $query->getRootAlias();
            
            $ids_cumplen=array();
            foreach ($values as $etiqueta_id => $valor) {

                $valor = $this->insensitiveSearch($valor);
                
                $valores = Doctrine::getTable('Archivo_DocumentoEtiqueta')
                                    ->createQuery('a')
                                    ->where("a.etiqueta_id = ?", $etiqueta_id)
                                    ->andWhere("a.valor ~* ?", $valor)
                                    ->execute();
                
                foreach ($valores as $value) {
                    if(!isset($ids_cumplen[$value->getDocumentoId()]))
                        $ids_cumplen[$value->getDocumentoId()]=0;

                    $ids_cumplen[$value->getDocumentoId()]++;
                } 
            }
            
            $i=1; $ids_finales = array(0);
            foreach ($ids_cumplen as $key => $value) {
                if($value==count($values)){
                    $ids_finales[$i] = $key;
                    $i++;
                }
            }
            
            if(count($ids_finales>0))
                $query->andWhereIn($a.".id", $ids_finales);
        }
    }
}


