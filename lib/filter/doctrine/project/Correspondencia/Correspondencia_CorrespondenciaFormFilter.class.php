<?php

/**
 * Correspondencia_Correspondencia filter form.
 *
 * @package    sigla-(institution)
 * @subpackage filter
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Correspondencia_CorrespondenciaFormFilter extends BaseCorrespondencia_CorrespondenciaFormFilter {

    public function insensitiveSearch($word,$type='basic') {
        $herramientas = new herramientas();
        return $herramientas->insensitiveSearch($word, $type);
    }

    public function configure() {

        $this->widgetSchema['prioridad'] = new sfWidgetFormChoice(array(
                    'choices' => Doctrine::getTable('Correspondencia_Correspondencia')->getPrioridad(),
                    'multiple' => false, 'expanded' => false,
                ));
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array(
                    'choices' => Doctrine::getTable('Correspondencia_Correspondencia')->getStatus(),
                    'multiple' => false, 'expanded' => false,
                ));
        $this->widgetSchema['statusRecepcion'] = new sfWidgetFormChoice(array(
                    'choices' => Doctrine::getTable('Correspondencia_Correspondencia')->getStatusRecepcion(),
                    'multiple' => false, 'expanded' => false,
                ));

        $this->widgetSchema['tipo_traslado_externo'] = new sfWidgetFormChoice(array(
                    'choices' => Doctrine::getTable('Correspondencia_Correspondencia')->getTipoTrasladoExterno(),
                    'multiple' => false, 'expanded' => false,
                ));

        $this->widgetSchema['empresa_traslado'] = new sfWidgetFormChoice(array(
                    'choices' => Doctrine::getTable('Correspondencia_Correspondencia')->getEmpresaTraslado(),
                    'multiple' => false, 'expanded' => false,
                ));

        $this->widgetSchema['firma'] = new sfWidgetFormChoice(array(
                    'choices' => Doctrine::getTable('Correspondencia_FuncionarioEmisor')->comboCorrepondenciaFuncionarioEmisor(),
                    'multiple' => false, 'expanded' => false,
                ));

        $years = range(2011, date('Y'));
        $this->widgetSchema['f_envio'] = new sfWidgetFormDateRange(array(
                    'from_date' => new sfWidgetFormJQueryDate(array(
                        'image' => '/images/icon/calendar.png',
                        'culture' => 'es',
                        'config' => '{changeYear: true, yearRange: \'c-100:c+100\'}',
                        'date_widget' => new sfWidgetFormI18nDate(array(
                                        'format' => '%day%-%month%-%year%',
                                        'culture'=>'es',
                                        'empty_values' => array('day'=>'<- Día ->',
                                        'month'=>'<- Mes ->',
                                        'year'=>'<- Año ->'),
                                        'years' => array_combine($years, $years))))),
                    'to_date' => new sfWidgetFormJQueryDate(array(
                        'image' => '/images/icon/calendar.png',
                        'culture' => 'es',
                        'config' => '{changeYear: true, yearRange: \'c-100:c+100\'}',
                        'date_widget' => new sfWidgetFormI18nDate(array(
                                        'format' => '%day%-%month%-%year%',
                                        'culture'=>'es',
                                        'empty_values' => array('day'=>'<- Día ->',
                                        'month'=>'<- Mes ->',
                                        'year'=>'<- Año ->'),
                                        'years' => array_combine($years, $years))))),
                    'template' => 'Desde: %from_date%<br />Hasta: %to_date%',
                ));


        $years = range(2011, date('Y'));
        $this->widgetSchema['created_at'] = new sfWidgetFormDateRange(array(
                    'from_date' => new sfWidgetFormJQueryDate(array(
                        'image' => '/images/icon/calendar.png',
                        'culture' => 'es',
                        'config' => '{changeYear: true, yearRange: \'c-100:c+100\'}',
                        'date_widget' => new sfWidgetFormI18nDate(array(
                                        'format' => '%day%-%month%-%year%',
                                        'culture'=>'es',
                                        'empty_values' => array('day'=>'<- Día ->',
                                        'month'=>'<- Mes ->',
                                        'year'=>'<- Año ->'),
                                        'years' => array_combine($years, $years))))),
                    'to_date' => new sfWidgetFormJQueryDate(array(
                        'image' => '/images/icon/calendar.png',
                        'culture' => 'es',
                        'config' => '{changeYear: true, yearRange: \'c-100:c+100\'}',
                        'date_widget' => new sfWidgetFormI18nDate(array(
                                        'format' => '%day%-%month%-%year%',
                                        'culture'=>'es',
                                        'empty_values' => array('day'=>'<- Día ->',
                                        'month'=>'<- Mes ->',
                                        'year'=>'<- Año ->'),
                                        'years' => array_combine($years, $years))))),
                    'template' => 'Desde: %from_date%<br />Hasta: %to_date%',
                ));


        $this->widgetSchema['receptor_organismo_id'] = new
                sfWidgetFormDoctrineJQueryAutocompleter(array(
                    'url' =>
                    $_SERVER['SCRIPT_NAME'] . '/' . sfContext::getInstance()->getModuleName() . "/organismos",
                    'model' => "Organismos_Organismo",
                    'config' => '{
                     scrollHeight: 250 ,
                     autoFill: false }'),
                     array('size' => '120'));

        $this->widgetSchema['emisor_organismo_id'] = new
                sfWidgetFormDoctrineJQueryAutocompleter(array(
                    'url' =>
                    $_SERVER['SCRIPT_NAME'] . '/' . sfContext::getInstance()->getModuleName() . "/organismos",
                    'model' => "Organismos_Organismo",
                    'config' => '{
                     scrollHeight: 250 ,
                     autoFill: false }'),
                     array('size' => '120'));

        $this->widgetSchema['emisor_persona_cedula'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->widgetSchema['emisor_persona_id'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->widgetSchema['emisor_persona_cargo_id'] = new sfWidgetFormFilterInput(array('with_empty' => false));

        $this->widgetSchema['receptor_persona_id'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->widgetSchema['receptor_persona_cargo_id'] = new sfWidgetFormFilterInput(array('with_empty' => false));

        $this->widgetSchema['receptorUnidad'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->widgetSchema['receptorFuncionario'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->widgetSchema['emisorUnidad'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->widgetSchema['emisorFuncionario'] = new sfWidgetFormFilterInput(array('with_empty' => false));

        $this->widgetSchema['formato'] = new sfWidgetFormChoice(array(
                    'choices' => Doctrine::getTable('Correspondencia_Correspondencia')->formatosFiltro(),
                ));

//        $this->widgetSchema['formato'] = new sfWidgetFormDoctrineChoice(array(
//                    'model' => 'Correspondencia_TipoFormato',
//                    'add_empty' => true,
//                    'table_method' => 'tiposActivos',
//                    'order_by' => array('nombre', 'asc'),
//                ));
        $this->widgetSchema['formatoPalabra'] = new sfWidgetFormFilterInput(array('with_empty' => false));

        $this->widgetSchema['adjunto'] = new sfWidgetFormFilterInput(array('with_empty' => false));

        $this->widgetSchema['fisico'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Correspondencia_TipoAnexoFisico',
                    'add_empty' => true,
                    'table_method' => 'tiposActivos',
                    'order_by' => array('nombre', 'asc'),
                ));

        $this->widgetSchema['fisicoPalabra'] = new sfWidgetFormFilterInput(array('with_empty' => false));

//        $this->widgetSchema['hechoPor'] = new sfWidgetFormChoice(array(
//                    'choices' => Doctrine::getTable('Correspondencia_Correspondencia')->hechoPor(),
//                ));

        $this->widgetSchema['hechoPor'] = new sfWidgetFormDoctrineChoice(array(
            'model'        => 'Correspondencia_Correspondencia',
            'table_method' => 'hechoPor',
            'add_empty'    => ''
        ));

        $this->validatorSchema['emisor_persona_cedula'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['emisor_persona_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['emisor_persona_cargo_id'] = new sfValidatorPass(array('required' => false));

        $this->validatorSchema['receptor_organismo_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organismos_Organismo'), 'column' => 'id'));
        $this->validatorSchema['receptor_persona_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['receptor_persona_cargo_id'] = new sfValidatorPass(array('required' => false));

        $this->validatorSchema['formato'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['formatoPalabra'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['adjunto'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['fisico'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['fisicoPalabra'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['firma'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['receptorUnidad'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['receptorFuncionario'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['emisorUnidad'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['emisorFuncionario'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['statusRecepcion'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['hechoPor'] = new sfValidatorPass(array('required' => false));
    }

    public function getFields() {
        return parent::getFields() + array(
            'formatoPalabra' => 'Text',
            'formato' => 'Number',
            'adjunto' => 'Text',
            'fisicoPalabra' => 'Text',
            'fisico' => 'Number',
            'firma' => 'Number',
            'receptorUnidad' => 'Number',
            'receptorFuncionario' => 'Number',
            'emisorUnidad' => 'Number',
            'emisorFuncionario' => 'Number',
            'emisor_persona_cedula' => 'Text',
            'statusRecepcion' => 'Text',
            'receptor_organismo_id' => 'Number',
            'receptor_persona_id' => 'Text',
            'receptor_persona_cargo_id' => 'Text',
            'prioridad' => 'Text',
            'hechoPor' => 'Number',
        );
    }

    public function addNCorrespondenciaExternaColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $correlativos = explode( ";;", $values['text']);

            $a = $query->getRootAlias();

            $numeros="(";
            foreach ($correlativos as $correlativo) {
                $correlativo = $this->insensitiveSearch(trim($correlativo));
                $numeros .= $correlativo.'|';
            }
            $numeros.=")";
            $numeros = str_replace('|)', ')', $numeros);

            $query->andWhere($a . ".n_correspondencia_externa ~* ?", $numeros);
        }
    }

    public function addNCorrespondenciaEmisorColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $correlativos = explode( ";;", $values['text']);

            $a = $query->getRootAlias();

            $numeros="(";
            foreach ($correlativos as $correlativo) {
                $correlativo = $this->insensitiveSearch(trim($correlativo));
                $numeros .= $correlativo.'|';
            }
            $numeros.=")";
            $numeros = str_replace('|)', ')', $numeros);

            $query->andWhere($a . ".n_correspondencia_emisor ~* ?", $numeros);
        }
    }

    public function addEmisorPersonaCedulaColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $values['text'] = $this->insensitiveSearch(trim($values['text']));
            $a = $query->getRootAlias();
            $query->innerJoin($a . '.Organismos_Persona opP')
                    ->andWhere("opP.ci ~* ?", $values['text'])
                    ->andWhere("opP.status = ?", 'A');
        }
    }
    
    public function addEmisorPersonaIdColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $values['text'] = $this->insensitiveSearch(trim($values['text']));
            $a = $query->getRootAlias();
            $query->innerJoin($a . '.Organismos_Persona opP')
                    ->andWhere("opP.nombre_simple ~* ?", $values['text'])
                    ->andWhere("opP.status = ?", 'A');
        }
    }

    public function addEmisorPersonaCargoIdColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $values['text'] = $this->insensitiveSearch(trim($values['text']));
            $a = $query->getRootAlias();
            $query->innerJoin($a . '.Organismos_PersonaCargo opcP')
                    ->andWhere("opcP.nombre ~* ?", $values['text'])
                    ->andWhere("opcP.status = ?", 'A');
        }
    }

    public function addReceptorOrganismoIdColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values != null) {
            $a = $query->getRootAlias();
            $query->innerJoin($a . '.Correspondencia_ReceptorOrganismo roF')
                    ->andWhere("roF.organismo_id = ?", $values);
        }
    }

    public function addReceptorPersonaIdColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $values['text'] = $this->insensitiveSearch(trim($values['text']));
            $a = $query->getRootAlias();
            $query->innerJoin($a . '.Correspondencia_ReceptorOrganismo orpP')
                  ->innerJoin('orpP.Organismos_Persona opP')
                  ->andWhere("opP.nombre_simple ~* ?", $values['text'])
                  ->andWhere("opP.status = ?", 'A');
        }
    }

    public function addReceptorPersonaCargoIdColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $values['text'] = $this->insensitiveSearch(trim($values['text']));
            $a = $query->getRootAlias();
            $query->innerJoin($a . '.Correspondencia_ReceptorOrganismo orpPc')
                  ->innerJoin('orpPc.Organismos_PersonaCargo opPc')
                  ->andWhere("opPc.nombre ~* ?", $values['text'])
                  ->andWhere("opPc.status = ?", 'A');
        }
    }

    public function addAdjuntoColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $values['text'] = $this->insensitiveSearch(trim($values['text']));
            $a = $query->getRootAlias();
            $query->innerJoin($a . '.Correspondencia_AnexoArchivo aarF')
                    ->andWhere("aarF.nombre_original ~* ?", $values['text']);
        }
    }

    public function addFormatoColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values != '') {
            $a = $query->getRootAlias();
            $query->innerJoin($a . '.Correspondencia_Formato adF')
                    ->andWhere("adF.tipo_formato_id = ?", $values);
        }
    }

    public function addFormatoPalabraColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            //$values['text'] = $this->insensitiveSearch($values['text'],'html');
            $valores = explode(' ', $values['text']);
            $where = '';
foreach($valores as $valor)
{
        $valor = trim($valor);
	$where .= "adF2.campo_uno ~* '".$valor."' ".
                    "OR adF2.campo_dos ~* '".$valor."' ".
                    "OR adF2.campo_tres ~* '".$valor."' ".
                    "OR adF2.campo_cuatro ~* '".$valor."' ".
                    "OR adF2.campo_cinco ~* '".$valor."' ".
                    "OR adF2.campo_seis ~* '".$valor."' ".
                    "OR adF2.campo_siete ~* '".$valor."' ".
                    "OR adF2.campo_ocho ~* '".$valor."' ".
                    "OR adF2.campo_nueve ~* '".$valor."' ".
                    "OR adF2.campo_diez ~* '".$valor."' ".
                    "OR adF2.campo_once ~* '".$valor."' ".
                    "OR adF2.campo_doce ~* '".$valor."' ".
                    "OR adF2.campo_trece ~* '".$valor."' ".
                    "OR adF2.campo_catorce ~* '".$valor."' ".
                    "OR adF2.campo_quince ~* '".$valor."' OR ";
}
$where = substr($where, 0,-4);
$where = "(".$where.")";
            $a = $query->getRootAlias();
            $query->innerJoin($a . '.Correspondencia_Formato adF2')
                    ->andWhere("$where");
        }
    }

    public function addFisicoColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values != '') {
            $a = $query->getRootAlias();
            $query->innerJoin($a . '.Correspondencia_AnexoFisico ffF')
                    ->andWhere("ffF.tipo_anexo_fisico_id = ?", $values);

            sfContext::getInstance()->getUser()->setAttribute('filter_af', 'Si');
        }
    }

    public function addFisicoPalabraColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['text'] != '') {
            $values['text'] = $this->insensitiveSearch(trim($values['text']));
            $a = $query->getRootAlias();

            $query->innerJoin($a . '.Correspondencia_AnexoFisico ffF2')
                    ->andWhere("ffF2.observacion ~* ?", $values['text']);
        }
    }

    public function addPrioridadColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values['Text'] != '') {
            $a = $query->getRootAlias();
            $query->andWhere($a . ".prioridad = ?", $values['text']);
        }
    }

    public function addStatusColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
//        echo $values['Text']; exit;
        $usuario_id = sfContext::getInstance()->getUser()->getAttribute('usuario_id');
        $funcionario_unidad_id = sfContext::getInstance()->getUser()->getAttribute('funcionario_unidad_id');
        $funcionario_id = sfContext::getInstance()->getUser()->getAttribute('funcionario_id');

        $firmas = $funcionario_id.',';

        if(sfContext::getInstance()->getUser()->getAttribute('firmas_delegadas')){
            $firmas_delegadas = sfContext::getInstance()->getUser()->getAttribute('firmas_delegadas');
            foreach ($firmas_delegadas as $firma_delegada) {
                $firmas .= $firma_delegada.',';
            }
        }
        $firmas.='$%&'; $firmas=str_replace(',$%&', '', $firmas);

        $unidades_autorizadas = Doctrine::getTable('Correspondencia_FuncionarioUnidad')->funcionarioAutorizado(sfContext::getInstance()->getUser()->getAttribute('funcionario_id'),'leer');

        $unidad_ids='0,';
        foreach ($unidades_autorizadas as $unidad_autorizada)
            {$unidad_ids .= $unidad_autorizada->getAutorizadaUnidadId().',';}

        $unidad_ids.='$%&'; $unidad_ids=str_replace(',$%&', '', $unidad_ids);

        $unidades_autorizadas = Doctrine::getTable('Correspondencia_FuncionarioUnidad')->funcionarioAutorizado(sfContext::getInstance()->getUser()->getAttribute('funcionario_id'),'redactar');

        $unidad_redactar_ids='0,';
        foreach ($unidades_autorizadas as $unidad_autorizada)
            {$unidad_redactar_ids .= $unidad_autorizada->getAutorizadaUnidadId().',';}

        $unidad_redactar_ids.='$%&'; $unidad_redactar_ids=str_replace(',$%&', '', $unidad_redactar_ids);

        $valores= (is_array($values))? $values['text'] : $valores= $values;
        
        switch ($valores) {
            case ' ':
                //TODAS LAS CORRESPONDENCIAS
                $a = $query->getRootAlias();

                $query->andwhere('(c.id IN (SELECT c2.id
                                FROM Correspondencia_Correspondencia c2
                                WHERE (c2.emisor_unidad_id IN ('.$unidad_ids.'))
                                    OR (c2.id_create = '.$usuario_id.' AND c2.emisor_unidad_id IN ('.$unidad_redactar_ids.'))    
                                ))
                     OR (c.id IN (SELECT fe.correspondencia_id
                        FROM Correspondencia_FuncionarioEmisor fe
                        WHERE fe.funcionario_id IN ('.$firmas.')))
                     OR (c.id IN (SELECT cv.correspondencia_id
                                FROM Correspondencia_CorrespondenciaVistobueno cv
                                WHERE cv.funcionario_id = ' . $funcionario_id . '
                                AND (cv.turno= TRUE
                                OR cv.status= \'V\')))')
                     ->whereNotIn('c.status', array('X'));
                break;
            case 'F':
                //Espera por mi Firma o Visto bueno
                $a = $query->getRootAlias();

                $query->andWhere('(c.id IN (SELECT cv.correspondencia_id
                                    FROM Correspondencia_CorrespondenciaVistobueno cv
                                    WHERE cv.funcionario_id = ' . $funcionario_id . '
                                    AND cv.turno= TRUE))
                                OR (c.id IN (SELECT fe.correspondencia_id
                                    FROM Correspondencia_FuncionarioEmisor fe
                                    WHERE fe.funcionario_id IN ('.$firmas.')
                                    AND fe.firma = \'N\'
                                    AND (fe.correspondencia_id NOT IN (SELECT cv2.correspondencia_id
                                        FROM Correspondencia_CorrespondenciaVistobueno cv2
                                        WHERE cv2.correspondencia_id = fe.correspondencia_id
                                        AND cv2.status= \'E\'
                                        GROUP BY cv2.correspondencia_id
                                        HAVING COUNT(cv2.correspondencia_id) > 0))))')
                ->andWhere($a . ".status = ?", 'C');
                
                
                
                break;
            case 'V':
                //Espera por fimra o Visto bueno de otros
                $a = $query->getRootAlias();

                $query->innerJoin('c.Correspondencia_FuncionarioEmisor cfe')

                   ->andwhere('(c.id IN (SELECT cv1.correspondencia_id
                                    FROM Correspondencia_CorrespondenciaVistobueno cv1
                                    WHERE cv1.correspondencia_id = c.id
                                    AND cv1.status= \'E\')
                              AND cfe.funcionario_id IN ('.$firmas.'))
                        OR (c.id IN (SELECT cv2.correspondencia_id
                                FROM Correspondencia_CorrespondenciaVistobueno cv2
                                WHERE cv2.funcionario_id = ' . $funcionario_id . '
                                AND cv2.turno= FALSE
                                AND cv2.status= \'E\'))')

                      ->andWhereIn('c.status', array('C'));
                break;
            default :
                $a = $query->getRootAlias();

                $query->andwhere('(c.id IN (SELECT c2.id
                                FROM Correspondencia_Correspondencia c2
                                WHERE (c2.emisor_unidad_id IN ('.$unidad_ids.'))
                                    OR (c2.id_create = '.$usuario_id.' AND c2.emisor_unidad_id IN ('.$unidad_redactar_ids.'))    
                                ))
                     OR (c.id IN (SELECT fe.correspondencia_id
                        FROM Correspondencia_FuncionarioEmisor fe
                        WHERE fe.funcionario_id IN ('.$firmas.')))
                     OR (c.id IN (SELECT cv.correspondencia_id
                                FROM Correspondencia_CorrespondenciaVistobueno cv
                                WHERE cv.funcionario_id = ' . $funcionario_id . '
                                AND (cv.turno= TRUE
                                OR cv.status= \'V\')))')
                    ->andWhere($a . ".status = ?", $valores);
                break;
        }
    }

    public function addStatusRecepcionColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        $valores= (is_array($values))? $values['text'] : $valores= $values;
        if ($valores != '') {
            $a = $query->getRootAlias();
            $query->andWhere($a . ".status = ?", $valores);
        }
    }

    public function addTipoTrasladoExternoColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values != '') {
            $a = $query->getRootAlias();
            $query->andWhere($a . ".tipo_traslado_externo = ?", $values);
        }
    }

    public function addEmpresaTrasladoColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values != '') {
            $a = $query->getRootAlias();
            $query->andWhere($a . ".empresa_traslado = ?", $values);
        }
    }

    public function addFirmaColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values != null) {
            $a = $query->getRootAlias();
            $query->innerJoin($a . '.Correspondencia_FuncionarioEmisor feF')
                    ->andWhere("feF.funcionario_id = ?", $values);
        }
    }

    public function addReceptorUnidadColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values != null) {
            $a = $query->getRootAlias();
            $query->innerJoin($a . '.Correspondencia_Receptor rF')
                    ->andWhere("rF.unidad_id = ?", $values);
        }
    }

    public function addReceptorFuncionarioColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values != null) {
            $a = $query->getRootAlias();
            $query->andWhere("rF.funcionario_id = ?", $values)
                  ->andWhere("rF.establecido = ?", 'S');
        }
    }

    public function addEmisorUnidadColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values != null) {
            $a = $query->getRootAlias();
            $query->andWhere($a . ".emisor_unidad_id = ?", $values);
        }
    }

    public function addEmisorFuncionarioColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values != null) {
            $a = $query->getRootAlias();
            $query->innerJoin($a . '.Correspondencia_FuncionarioEmisor feF2')
                    ->andWhere("feF2.funcionario_id = ?", $values);
        }
    }

    public function addHechoPorColumnQuery(Doctrine_Query $query, $field, $values) {
        //Se comprueba que no sea nulo el valor del campo del filtro
        if ($values != '') {
            $a = $query->getRootAlias();
            $query->andWhere("c.id_create = ?", $values);
        }
    }
}

