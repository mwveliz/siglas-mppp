<?php

/**
 * Funcionarios_GrupoSocial form.
 *
 * @package    siglas
 * @subpackage form
 * @author     Livio Lopez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Funcionarios_GrupoSocialForm extends BaseFuncionarios_GrupoSocialForm
{
  public function configure()
  {
     $this->widgetSchema['tipo_grupo_social_id'] = new sfWidgetFormDoctrineChoice(array(
    'model'     => 'Public_TipoGrupoSocial',
    'add_empty' => 'Seleccione grupo',

    )); 
  }
}
