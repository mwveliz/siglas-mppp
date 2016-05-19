<?php echo $helper->linkToNew(array(  'params' =>   array(  ),  'class_suffix' => 'new',  'label' => 'New',)) ?>
<li class="sf_admin_action_excel">
  <?php echo link_to(__('Exportar', array(), 'messages'), 'enviada/excel', array()) ?>
</li>
<li class="sf_admin_action_estadisticas">
  <?php echo link_to(__('Estadisticas', array(), 'messages'), 'enviada/estadisticas', array()) ?>
</li>
