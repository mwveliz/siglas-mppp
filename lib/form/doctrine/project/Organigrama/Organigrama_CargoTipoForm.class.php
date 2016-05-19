<?php

/**
 * Organigrama_CargoTipo form.
 *
 * @package    sigla-(institution)
 * @subpackage form
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 0.1. 2011-01-23 18:33:00 livio.lopez $
 */
class Organigrama_CargoTipoForm extends BaseOrganigrama_CargoTipoForm
{
  public function configure()
  {
        $this->widgetSchema ['organigrama_cargo_grado_list']  = new sfWidgetFormDoctrineChoice(array(
          'model' => $this->getRelatedModelName('Organigrama_CargoGrado'),
          'renderer_class' => 'sfWidgetFormSelectDoubleList',
            'renderer_options' => array(
                'label_unassociated' => 'No asignadas',
                'label_associated' => 'asignadas',
                'associated_first' => false
            )
        ));
  }
}
