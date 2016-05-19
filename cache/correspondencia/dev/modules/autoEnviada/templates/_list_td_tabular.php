<td class="sf_admin_text sf_admin_list_td_identificacion">
  <?php echo get_partial('enviada/identificacion', array('type' => 'list', 'correspondencia_correspondencia' => $correspondencia_correspondencia)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_documento">
  <?php echo get_partial('enviada/documento', array('type' => 'list', 'correspondencia_correspondencia' => $correspondencia_correspondencia)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_detalles">
  <?php echo get_partial('enviada/detalles', array('type' => 'list', 'correspondencia_correspondencia' => $correspondencia_correspondencia)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_acciones">
  <?php echo get_partial('enviada/acciones', array('type' => 'list', 'correspondencia_correspondencia' => $correspondencia_correspondencia)) ?>
</td>
