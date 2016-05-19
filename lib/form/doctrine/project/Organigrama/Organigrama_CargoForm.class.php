<?php

/**
 * Organigrama_Cargo form.
 *
 * @package    sigla-(institution)
 * @subpackage form
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Organigrama_CargoForm extends BaseOrganigrama_CargoForm
{
  public function configure()
  {
     unset($this['padre_id'],$this['unidad_funcional_id'],$this['unidad_administrativa_id']);

     
    $years = range(1970, date('Y'));
    $this->widgetSchema['f_ingreso'] = new sfWidgetFormJQueryDate(array(
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
    
    $this->widgetSchema['perfil_id'] = new sfWidgetFormDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Acceso_Perfil'),
        'table_method' => 'perfilesActivos',
        'add_empty' => true,
    ));
  }
}
