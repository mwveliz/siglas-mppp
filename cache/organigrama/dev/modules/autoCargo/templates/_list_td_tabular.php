<td class="sf_admin_text sf_admin_list_td_codigo_nomina">
  <?php echo $organigrama_cargo->getCodigoNomina() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_condicion">
  <?php echo $organigrama_cargo->getCondicion() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_tipo">
  <?php echo $organigrama_cargo->getTipo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_grado">
  <?php echo $organigrama_cargo->getGrado() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_f_ingreso">
  <?php echo false !== strtotime($organigrama_cargo->getFIngreso()) ? format_date($organigrama_cargo->getFIngreso(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_acceso_perfil">
  <?php echo $organigrama_cargo->getAccesoPerfil() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_funcionario_actual">
  <?php echo get_partial('cargo/funcionario_actual', array('type' => 'list', 'organigrama_cargo' => $organigrama_cargo)) ?>
</td>
