<script>
    var id_entrada = 1;
    function detectar_parametros_salida()
    {
        $('#div_parametros_salida').html('<?php echo image_tag('icon/cargando.gif', array('size'=>'25x25')); ?> Conectando al WS...');
        $.ajax({
            url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>io_publicada/detectarParametrosSalida',
            type:'POST',
            dataType:'html',
            data: $('#form_servicios_publicados').serialize(),
            success:function(data, textStatus){
                $('#div_parametros_salida').html(data);
            }});
    }
</script>

<div class="sf_admin_form_row sf_admin_text sf_admin_form_field_parametros_salida">
    <div>
        <label for="siglas_servicios_publicados_parametros_salida">Parametros salida</label>
        <div class="content">
            <a href="#" onclick="detectar_parametros_salida(); return false;">Detectar parametros de salida</a>
            <div id="div_parametros_salida"></div>
        </div>

    </div>
</div>