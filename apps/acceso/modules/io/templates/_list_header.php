<script>
    function establecer_confianza(servidor_confianza_id){
        $.ajax({
            url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>io/enviarConfianza',
            type:'POST',
            dataType:'html',
            data:'servidor_confianza_id='+servidor_confianza_id,
            beforeSend: function(Obj){
                $('#'+servidor_confianza_id+'_conexion_recibe_crt').html('<?php echo image_tag('icon/cargando.gif'); ?>');
            },
            success:function(data, textStatus){
                $('#'+servidor_confianza_id+'_conexion_recibe_crt').html('<pre>'+data+'</pre>');
            },
            complete: function() {
            }, 
            error: function(Obj, err) {
                $('#'+servidor_confianza_id+'_conexion_recibe_crt').html(err);
            }})
    }
    
    function enviar_estructura(servidor_confianza_id){
        $.ajax({
            url:'<?php echo sfConfig::get('sf_app_organigrama_url'); ?>unidad/enviarEstructura',
            type:'POST',
            dataType:'html',
            data:'servidor_confianza_id='+servidor_confianza_id,
            beforeSend: function(Obj){
                $('#'+servidor_confianza_id+'_conexion_envia_estruc').html('<?php echo image_tag('icon/cargando.gif'); ?>');
            },
            success:function(data, textStatus){
                $('#'+servidor_confianza_id+'_conexion_envia_estruc').html('<pre>'+data+'</pre>');
            },
            complete: function() {
            }, 
            error: function(Obj, err) {
                $('#'+servidor_confianza_id+'_conexion_envia_estruc').html(err);
            }})
    }
</script>