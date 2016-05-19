<div id="<?php echo $siglas_servidor_confianza->getId()?>_conexion_recibe_crt">
    <?php if($siglas_servidor_confianza->getStatus()=='A') { ?>
    <img src="/images/icon/tick.png"/> Conexión establecida con exito
    <?php } else { ?>
    <img src="/images/icon/error.png"/> <font style="color: red">No se ha establecido la conexión</font>
    <?php } ?>
</div>


2. Enviar Estructura&nbsp;<div id="<?php echo $siglas_servidor_confianza->getId()?>_conexion_envia_estruc">falta</div><br/>