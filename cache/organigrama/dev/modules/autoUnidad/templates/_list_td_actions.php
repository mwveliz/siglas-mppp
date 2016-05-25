<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($organigrama_unidad, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <li class="sf_admin_action_anular">
      <?php echo link_to(__('Anular', array(), 'messages'), 'unidad/anular?id='.$organigrama_unidad->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_cargos">
      <?php echo link_to(__('Cargos', array(), 'messages'), 'unidad/cargos?id='.$organigrama_unidad->getId(), array()) ?>
    </li>
  </ul>
</td>
