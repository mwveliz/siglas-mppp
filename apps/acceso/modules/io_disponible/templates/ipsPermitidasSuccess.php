<div id="div_ips_permitidas_<?php echo $servicio_disponible_id; ?>" style="width: 150px; max-height: 150px; overflow-y: auto; overflow-x: hidden;">
    <u>Activas</u><br/>
    <font class="f10" style="color: #46B2FD;">
        <?php
        $ips_permitidas_activas= Doctrine::getTable('Siglas_ServiciosDisponiblesConfianza')->findByServiciosDisponiblesIdAndStatus($servicio_disponible_id,'A');

        if(count($ips_permitidas_activas)>0){
            foreach ($ips_permitidas_activas as $ip_permitida_activa) { ?>
                <div title="<?php echo $ip_permitida_activa->getDetallesMaquina(); ?>" onmouseover="mostrar_delete(<?php echo $ip_permitida_activa->getId(); ?>)" onmouseout ="ocultar_delete(<?php echo $ip_permitida_activa->getId(); ?>)">
                    <?php echo $ip_permitida_activa->getIpPermitida(); ?>
                
                    <a id="div_button_delete_<?php echo $ip_permitida_activa->getId(); ?>" href="#" style="display: none;" title="Inactivar acceso" onclick="inactivar_ip(<?php echo $servicio_disponible_id; ?>,<?php echo $ip_permitida_activa->getId(); ?>); return false;">
                        <img src="/images/icon/delete11.png"/>
                    </a>
                </div>
                
                <?php
            }
        } else {
            echo 'ninguna';
        }
        ?>
    </font>
    <hr/>
    <u>Inactivas</u><br/>
    <font class="f10" style="color: gold;">
        <?php
        $ips_permitidas_inactivas= Doctrine::getTable('Siglas_ServiciosDisponiblesConfianza')->findByServiciosDisponiblesIdAndStatus($servicio_disponible_id,'I');

        if(count($ips_permitidas_inactivas)>0){
            foreach ($ips_permitidas_inactivas as $ip_permitida_inactiva) {
                echo '<div title="'.$ip_permitida_inactiva->getDetallesMaquina().'">'.$ip_permitida_inactiva->getIpPermitida().'</div>';
            }
        } else {
            echo 'ninguna';
        }
        ?>
    </font>
</div>