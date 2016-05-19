<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($acceso_usuario->getId(), 'acceso_usuario_edit', $acceso_usuario) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_usuario_enlace_id">
  <?php echo $acceso_usuario->getUsuarioEnlaceId() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_enlace_id">
  <?php echo $acceso_usuario->getEnlaceId() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nombre">
  <?php echo $acceso_usuario->getNombre() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_ldap">
  <?php echo $acceso_usuario->getLdap() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_clave">
  <?php echo $acceso_usuario->getClave() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_clave_temporal">
  <?php echo $acceso_usuario->getClaveTemporal() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_visitas">
  <?php echo $acceso_usuario->getVisitas() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_ultimaconexion">
  <?php echo false !== strtotime($acceso_usuario->getUltimaconexion()) ? format_date($acceso_usuario->getUltimaconexion(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_ultimo_status">
  <?php echo false !== strtotime($acceso_usuario->getUltimoStatus()) ? format_date($acceso_usuario->getUltimoStatus(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_ultimocambioclave">
  <?php echo false !== strtotime($acceso_usuario->getUltimocambioclave()) ? format_date($acceso_usuario->getUltimocambioclave(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_tema">
  <?php echo $acceso_usuario->getTema() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_acceso_global">
  <?php echo get_partial('usuario/list_field_boolean', array('value' => $acceso_usuario->getAccesoGlobal())) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_status">
  <?php echo $acceso_usuario->getStatus() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_id_update">
  <?php echo $acceso_usuario->getIdUpdate() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_ip_update">
  <?php echo $acceso_usuario->getIpUpdate() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_ip">
  <?php echo $acceso_usuario->getIp() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_pc">
  <?php echo $acceso_usuario->getPc() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_puerta">
  <?php echo $acceso_usuario->getPuerta() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_so">
  <?php echo $acceso_usuario->getSo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_agente">
  <?php echo $acceso_usuario->getAgente() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_variables_entorno">
  <?php echo $acceso_usuario->getVariablesEntorno() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($acceso_usuario->getCreatedAt()) ? format_date($acceso_usuario->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($acceso_usuario->getUpdatedAt()) ? format_date($acceso_usuario->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
