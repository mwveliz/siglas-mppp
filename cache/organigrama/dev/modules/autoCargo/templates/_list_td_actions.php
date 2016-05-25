<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($organigrama_cargo, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <li class="sf_admin_action_mover">
      <?php echo link_to(__('Mover de Unidad', array(), 'messages'), 'cargo/mover?id='.$organigrama_cargo->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_anular">
      <?php echo link_to(__('Anular', array(), 'messages'), 'cargo/anular?id='.$organigrama_cargo->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_reactivar">
      <?php echo link_to(__('Reactivar', array(), 'messages'), 'cargo/reactivar?id='.$organigrama_cargo->getId(), array()) ?>
    </li>
  </ul>
</td>
