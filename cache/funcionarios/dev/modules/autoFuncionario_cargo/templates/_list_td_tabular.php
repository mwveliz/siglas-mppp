<td class="sf_admin_text sf_admin_list_td_unidad">
  <?php echo $funcionarios_funcionario_cargo->getUnidad() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_ctnombre">
  <?php echo $funcionarios_funcionario_cargo->getCtnombre() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_funcionarios_funcionario_cargo_condicion">
  <?php echo $funcionarios_funcionario_cargo->getFuncionariosFuncionarioCargoCondicion() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_f_ingreso">
  <?php echo false !== strtotime($funcionarios_funcionario_cargo->getFIngreso()) ? format_date($funcionarios_funcionario_cargo->getFIngreso(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_coletilla">
  <?php echo get_partial('funcionario_cargo/coletilla', array('type' => 'list', 'funcionarios_funcionario_cargo' => $funcionarios_funcionario_cargo)) ?>
</td>
<td class="sf_admin_date sf_admin_list_td_f_retiro">
  <?php echo false !== strtotime($funcionarios_funcionario_cargo->getFRetiro()) ? format_date($funcionarios_funcionario_cargo->getFRetiro(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_motivo_retiro">
  <?php echo $funcionarios_funcionario_cargo->getMotivoRetiro() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_status">
  <?php echo get_partial('funcionario_cargo/status', array('type' => 'list', 'funcionarios_funcionario_cargo' => $funcionarios_funcionario_cargo)) ?>
</td>
