<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($funcionarios_funcionario, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <li class="sf_admin_action_cargosf">
      <?php echo link_to(__('Cargo', array(), 'messages'), 'funcionario/cargosf?id='.$funcionarios_funcionario->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_passwd">
      <?php echo link_to(__('Reiniciar Contraseña', array(), 'messages'), 'funcionario/passwd?id='.$funcionarios_funcionario->getId(), 'confirm=\'¿Estas seguro de reiniciar la contraseña?\'') ?>
    </li>
    <li class="sf_admin_action_digitalizar">
      <?php echo link_to(__('Firma digitalizada', array(), 'messages'), 'funcionario/digiFirma?id='.$funcionarios_funcionario->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_global_enable">
      <?php echo link_to(__('Activar acceso global', array(), 'messages'), 'funcionario/globalEnable?id='.$funcionarios_funcionario->getId(), 'confirm=\'¿Estas seguro de activar el acceso global?\'') ?>
    </li>
    <li class="sf_admin_action_global_disable">
      <?php echo link_to(__('Desactivar acceso global', array(), 'messages'), 'funcionario/globalDisable?id='.$funcionarios_funcionario->getId(), 'confirm=\'¿Estas seguro de desactivar el acceso global?\'') ?>
    </li>
    <li class="sf_admin_action_anular">
      <?php echo link_to(__('Anular', array(), 'messages'), 'funcionario/anular?id='.$funcionarios_funcionario->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_reactivar">
      <?php echo link_to(__('Reactivar', array(), 'messages'), 'funcionario/reactivar?id='.$funcionarios_funcionario->getId(), array()) ?>
    </li>
  </ul>
</td>
