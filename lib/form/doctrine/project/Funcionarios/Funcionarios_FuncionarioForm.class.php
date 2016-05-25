<?php

/**
 * Funcionarios_Funcionario form.
 *
 * @package    sigla-(institution)
 * @subpackage form
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Funcionarios_FuncionarioForm extends BaseFuncionarios_FuncionarioForm
{
  public function configure()
  {
//    unset($this['email_validado'],$this['codigo_validador_email'],$this['codigo_validador_telf']);
    
    $this->widgetSchema['sexo'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine::getTable('Funcionarios_Funcionario')->getSexo(),
      'multiple' => false, 'expanded' => true
    ));
    
    $this->widgetSchema['email_validado'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine::getTable('Funcionarios_Funcionario')->getEmailValidado(),
      'multiple' => false, 'expanded' => true,
      'default'   => True,
    ));
    $this->widgetSchema['email_validado']->setAttribute('disabled', 'disbled');

    $this->widgetSchema['email_personal']->setOption('is_hidden', true);
    $this->widgetSchema['email_personal']->setOption('type', 'hidden');


   

 $this->widgetSchema['edo_civil'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine::getTable('Funcionarios_Funcionario')->getEdoCivil(),
      'multiple' => false, 'expanded' => true
    ));

 $this->widgetSchema->setLabels(array(
      'telf_movil'  => 'Telf de Oficina',
      
    ));

    $years = range(date('Y')-100, date('Y'));
    $this->widgetSchema['f_nacimiento'] = new sfWidgetFormJQueryDate(array(
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

    $this->validatorSchema['telf_movil'] = new sfValidatorAnd(array(
                        new sfValidatorString(array(
                            'min_length' => 11,
                            'required'   => false),
                            array(
                            'min_length' => 'Introduzca 4 digitos de codigo de area u operadora y 7 digitos del número propiamente')),
                        new sfValidatorRegex(array(
                            'pattern' => '/^[0-9]+$/'),
                            array(
                            'invalid' => 'El campo indicado debe contener solo números'))),array('required'   => false));


    $this->validatorSchema['email_institucional'] = new sfValidatorEmail(array(
                        'max_length' => 255,
                        'required'   => false),
                        array(
                        'max_length' => 'Maximo de caracteres 255',
                        'invalid' => 'ingrese un correo electronico verdadero'));

    $this->validatorSchema['email_personal'] = new sfValidatorEmail(array(
                        'max_length' => 255,
                        'required'   => false),
                        array(
                        'max_length' => 'Maximo de caracteres 255',
                        'invalid' => 'ingrese un correo electronico verdadero'));

    $this->validatorSchema->setPostValidator(
            new sfValidatorDoctrineUnique(array('model' => 'Funcionarios_Funcionario', 'column' => array('ci')),
            array('invalid' => 'Ya fue registrado el número de cedula') )
    );
  }

}
