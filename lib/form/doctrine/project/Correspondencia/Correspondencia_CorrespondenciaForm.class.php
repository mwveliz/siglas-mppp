<?php

/**
 * Correspondencia_Correspondencia form.
 *
 * @package    sigla-(institution)
 * @subpackage form
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Correspondencia_CorrespondenciaForm extends BaseCorrespondencia_CorrespondenciaForm {

    public function configure() {


//        AL COLOCAR UNA POST VALIDACION EN UNA TRANSACCION FALLA

//        $this->validatorSchema->setPostValidator(
//                new sfValidatorDoctrineUnique(array('model' => 'Correspondencia_Correspondencia', 'column' => array('n_correspondencia_emisor')),
//                        array('invalid' => 'Ya fue registrado el número de correspondencia'))
//        );

        $years = range(2011, date('Y'));
        $this->widgetSchema['f_envio'] = new sfWidgetFormJQueryDate(array(
            'image' => '/images/icon/calendar.png',
            'culture' => 'es',
            'config' => '{changeYear: true, yearRange: \'c-100:c+100\'}',
            'date_widget' => new sfWidgetFormI18nDate(array(
                            'format' => '%day%-%month%-%year%',
                            'culture'=>'es',
                            'empty_values' => array('day'=>'<- Día ->',
                            'month'=>'<- Mes ->',
                            'year'=>'<- Año ->'),
                            'years' => array_combine($years, $years)))
        ));

      
        $this->widgetSchema['emisor_organismo_id'] = new
                sfWidgetFormDoctrineJQueryAutocompleter(array(
                    'url' =>
                    $_SERVER['SCRIPT_NAME'] . '/' . sfContext::getInstance()->getModuleName() . "/organismos",
                    'model' => "Organismos_Organismo",
                    'config' => '{
                     scrollHeight: 250 ,
                     autoFill: false }'), 
                     array('size' => '70','class'=>'emisor_organismo_id'));

        $this->widgetSchema['emisor_persona_id'] = new
                sfWidgetFormDoctrineJQueryAutocompleter(array(
                    'url' =>
                    $_SERVER['SCRIPT_NAME'] . '/' . sfContext::getInstance()->getModuleName() . "/personas",
                    'model' => "Organismos_Persona",
                    'config' => '{
                     scrollHeight: 250 ,
                     autoFill: false, 
                     extraParams: { organismo_id: function() { return jQuery("#correspondencia_correspondencia_emisor_organismo_id").val(); } },
                     }',), 
                     array('size' => '40','class'=>'emisor_persona_id'));
        
        $this->widgetSchema['emisor_persona_cargo_id'] = new
                sfWidgetFormDoctrineJQueryAutocompleter(array(
                    'url' =>
                    $_SERVER['SCRIPT_NAME'] . '/' . sfContext::getInstance()->getModuleName() . "/personasCargos",
                    'model' => "Organismos_PersonaCargo",
                    'config' => '{
                     scrollHeight: 250 ,
                     autoFill: false, extraParams: { persona_id: function() { return jQuery("#correspondencia_correspondencia_emisor_persona_id").val(); } } }',), 
                     array('size' => '40','class'=>'emisor_persona_cargo_id'));

        $this->widgetSchema['tipo_traslado_externo'] = new sfWidgetFormChoice(array(
                    'choices' => Doctrine::getTable('Correspondencia_Correspondencia')->getTipoTrasladoExterno(),
                    'multiple' => false, 'expanded' => false
                ));

        $this->widgetSchema['empresa_traslado'] = new sfWidgetFormChoice(array(
                    'choices' => Doctrine::getTable('Correspondencia_Correspondencia')->getEmpresaTraslado(),
                    'multiple' => false, 'expanded' => false
                ));

        $this->validatorSchema['email_externo'] = new sfValidatorEmail(array(
                            'max_length' => 255,
                            'required'   => false),
                            array(
                            'max_length' => 'Maximo de caracteres 255',
                            'invalid' => 'ingrese un correo electronico verdadero'));

        $this->validatorSchema['telf_movil_externo'] = new sfValidatorAnd(array(
                        new sfValidatorString(array(
                            'min_length' => 11,
                            'required'   => false),
                            array(
                            'min_length' => 'Introduzca 4 digitos de codigo de area u operadora y 7 digitos del número propiamente')),
                        new sfValidatorRegex(array(
                            'pattern' => '/^[0-9]+$/'),
                            array(
                            'invalid' => 'El campo indicado debe contener solo números'))),array('required'   => false));
        
        $this->validatorSchema['telf_local_externo'] = new sfValidatorAnd(array(
                        new sfValidatorString(array(
                            'min_length' => 11,
                            'required'   => false),
                            array(
                            'min_length' => 'Introduzca 4 digitos de codigo de area u operadora y 7 digitos del número propiamente')),
                        new sfValidatorRegex(array(
                            'pattern' => '/^[0-9]+$/'),
                            array(
                            'invalid' => 'El campo indicado debe contener solo números'))),array('required'   => false));
    }

}