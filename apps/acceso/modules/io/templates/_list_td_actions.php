<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_establecer_confianza">
        <a href="#" onclick="establecer_confianza(<?php echo $siglas_servidor_confianza->getId();?>); return false;">Enviar confianza</a>
    </li>
    <li class="sf_admin_action_enviar_estructura">
        <a href="#" onclick="enviar_estructura(<?php echo $siglas_servidor_confianza->getId();?>); return false;">Enviar estructura</a>
    </li>
    <li class="sf_admin_action_acceso_ws_publicado">
      <?php echo link_to(__('WS disponibles PARA este organismo', array(), 'messages'), 'io/accesoServicios?id='.$siglas_servidor_confianza->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_acceso_ws_disponible">
      <?php echo link_to(__('WS disponibles DE este organismo', array(), 'messages'), 'io/accesoDisponible?id='.$siglas_servidor_confianza->getId(), array()) ?>
    </li>
  </ul>
</td>
