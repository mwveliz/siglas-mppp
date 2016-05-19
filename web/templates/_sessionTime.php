<script>
    var ACTIVO_UPDATE_TOKEN = false;
    var timer_update_token = 120000;
    
    function send_update_token() {
        if (ACTIVO_UPDATE_TOKEN == false) {
            ACTIVO_UPDATE_TOKEN = true;
            $('#token_update_sleep').load("<?php echo sfConfig::get('sf_app_acceso_url'); ?>usuario/updateToken",
                    null, function() {
                        ACTIVO_UPDATE_TOKEN = false;
                    }).fadeIn("slow");
        }
    }
    var intervalIdToken = setInterval("send_update_token()", timer_update_token);
    var intervalIdRestante = 0;

    $(document).ajaxComplete(function() {
        if ($('#token_update').html() == '') {
            $('#token_update').html('enviando');

            $('#token_update').load("<?php echo sfConfig::get('sf_app_acceso_url'); ?>usuario/resetToken",
                    null, function() {
                        $('#token_update').html('user');
                    });
        } else if ($('#token_update').html() == 'user') {
            $('#token_update').html('');
            $('#tiempo_expiracion').html('');
            $('#expira_minutos').html('');
            $('#expira_segundos').html('');
            $('.mensaje_expira').hide();

            clearInterval(intervalIdToken);
            clearInterval(intervalIdRestante);

            intervalIdToken = setInterval("send_update_token()", timer_update_token);
            
        } else if ($('#token_update').html() == 'token') {
            $('#token_update').html('');
            if ($('#expira_segundos').html() == '59') {
                $('.mensaje_expira').show();
                $('#tiempo_expiracion').append('<script>var intervalIdRestante = setInterval("restante_expirar()", 1000);<\/script>');
            }
        }
    });
    
    function restante_expirar(){
        var segundos_actuales = parseInt($('#expira_segundos').html());
        var segundos_restantes = 0;
        
        if(segundos_actuales === 0){
            segundos_restantes = 59;
        } else {
            segundos_restantes = segundos_actuales-1;
        }
        
        if(segundos_restantes<10){
            segundos_restantes = '0'+segundos_restantes;
        }
        
        $('#expira_segundos').html(segundos_restantes);
        
        if($('#expira_minutos').html()!=='0'){
            if(segundos_restantes===59){
                $('#expira_minutos').html(parseInt($('#expira_minutos').html())-1);
            }
        } else {
            if(segundos_restantes==='00'){
                clearInterval(intervalIdRestante);
                $('#tiempo_expiracion').html('');
                $('#expira_minutos').html('cerrando');
                $('#expira_segundos').html('sesion');
            }
        }
    }
    
    function cambiar_tiempo_expira(minutos){
        $.ajax({
            url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>usuario/cambiarTiempoSession',
            type:'POST',
            dataType:'html',
            data:'minutos='+minutos,
            success:function(data, textStatus){
                $('#token_update').html('user');
        }});
    }
</script>

<div id="token_update_sleep"></div>
<div id="token_update" style="position: fixed; right: 0px; bottom: 0px; display: none;"></div>
<div id="tiempo_expiracion"></div>