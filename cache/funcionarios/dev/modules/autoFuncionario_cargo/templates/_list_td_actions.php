<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_destituir">
      <?php echo link_to(__('Desincorporar', array(), 'messages'), 'funcionario_cargo/edit?id='.$funcionarios_funcionario_cargo->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_mover">
      <?php echo link_to(__('Mover de Unidad', array(), 'messages'), 'funcionario_cargo/mover?id='.$funcionarios_funcionario_cargo->getId(), array()) ?>
    </li>
  </ul>
</td>
