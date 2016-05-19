<div style="min-width: 150px;">
    <u>Tipo de sincronizacion</u>: <br/>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $siglas_servicios_disponibles->getTipo(); ?><br/><br/>
    <?php if($siglas_servicios_disponibles->getCrontab() != 'false') { ?>
        <u>Frecuencia</u>: <br/>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $siglas_servicios_disponibles->getCrontab(); ?>
    <?php } ?>
</div>