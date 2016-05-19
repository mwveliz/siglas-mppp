<?php

/**
 * Organigrama_Unidad form.
 *
 * @package    sigla-(institution)
 * @subpackage form
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Organigrama_UnidadForm extends BaseOrganigrama_UnidadForm
{
  public function configure()
  {
    $this->widgetSchema['estado_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'     => 'Public_Estado',
        'add_empty' => 'Seleccione estado',
    ));
     $this->widgetSchema['municipio_id'] = new sfWidgetFormDoctrineDependentSelect(array(
        'model'     => 'Public_Municipio',
        'depends'   => 'Estado',
        'add_empty' => 'Seleccione municipio',
        'ajax'      => true,
    ));
    $this->widgetSchema['parroquia_id'] = new sfWidgetFormDoctrineDependentSelect(array(
        'model'     => 'Public_Parroquia',
        'depends'   => 'Municipio',
        'add_empty' => 'Seleccione Parroquia',
        'ajax'      => true,
    ));

    $this->widgetSchema['padre_id'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine::getTable('Organigrama_Unidad')->combounidad(),
      'expanded' => false, 'multiple' => false
    ));


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
    
    $this->widgetSchema['unidad_tipo_id'] = new sfWidgetFormDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Organigrama_UnidadTipo'),
        'table_method' => 'todasOrdenadas',
        'add_empty' => false,
    ));
    
    $this->setDefault('codigo_unidad', 0);
  }
}
