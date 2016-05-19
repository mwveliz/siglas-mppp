<div style="min-width: 150px;">
    <u>Tipo de sincronizacion</u>: <br/>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $siglas_servicios_publicados->getTipo(); ?><br/><br/>
    <?php if($siglas_servicios_publicados->getCrontab() != 'false') { ?>
        <u>Frecuencia</u>: <br/>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $siglas_servicios_publicados->getCrontab(); ?>
    <?php } ?>
</div>