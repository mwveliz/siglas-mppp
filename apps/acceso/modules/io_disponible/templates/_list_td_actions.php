<td width="100">
  <ul class="sf_admin_td_actions">
    <?php if($siglas_servicios_disponibles->getStatus()=='A'){ ?>
        <li class="sf_admin_action_new_ip_permitida" id="li_button_add_ip_permitida_<?php echo $siglas_servicios_disponibles->getId(); ?>">
            <a href="#" onclick="agregar_ip(<?php echo $siglas_servicios_disponibles->getId(); ?>); return false;">Agregar IP internas para consumir el servicio</a>
        </li>
        <li class="sf_admin_action_guardar" id="li_button_save_ip_permitida_<?php echo $siglas_servicios_disponibles->getId(); ?>" style="display: none;">
            <a href="#" onclick="guardar_ip(<?php echo $siglas_servicios_disponibles->getId(); ?>); return false;">Guardar IP</a>
        </li>
        <li class="sf_admin_action_cancelar" id="li_button_cancel_ip_permitida_<?php echo $siglas_servicios_disponibles->getId(); ?>" style="display: none;">
            <a href="#" onclick="cancelar_ip(<?php echo $siglas_servicios_disponibles->getId(); ?>); return false;">Cancelar</a>
        </li>
        <div id="div_form_new_ip_<?php echo $siglas_servicios_disponibles->getId(); ?>" style="padding-top: 10px; display: none;">
            <input type="text" id="new_ip_<?php echo $siglas_servicios_disponibles->getId(); ?>" size="11" maxlength="16" value="IP nueva"/>
            <textarea id="new_detalles_maquina_<?php echo $siglas_servicios_disponibles->getId(); ?>" cols="9" rows="3">Descripcion, dueno, servicio.</textarea>
        </div>
    <?php } ?>
  </ul>
</td>
