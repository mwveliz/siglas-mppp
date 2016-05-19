<?php $session_funcionario = $sf_user->getAttribute('session_funcionario');?>
<script>
        var cont = 0;
        var right = 185;
        var mini = 0;
        var maxi = 0;
        var nombre = '';

//    var ACTIVO_MOSTRAR = false;
//    function send_ajax(){
//        if (ACTIVO_MOSTRAR == false){
//            ACTIVO_MOSTRAR = true;
//            $('#chat').load("<?php echo sfConfig::get('sf_app_herramientas_url'); ?>chat/mostrarChat", 
//            null, function (){
//                ACTIVO_MOSTRAR = false;
//            }).fadeIn("slow");
//        }
//    }
//    setInterval("send_ajax()", 6000);
    
//    var ACTIVO_AMIGOS = false;
//    function send_amigos(){
//        if (ACTIVO_AMIGOS == false){
//            ACTIVO_AMIGOS = true;
//            $('#amigos').load("<?php echo sfConfig::get('sf_app_herramientas_url'); ?>chat/amigosActivos", 
//            null, function (){
//                ACTIVO_AMIGOS = false;
//            }).fadeIn("slow");
//        }
//    }
//    setInterval("send_amigos()", 60000);
    
//    function send_chat(mensaje,tecla,chat_id){
//        tecla = (tecla.keyCode ? tecla.keyCode : tecla.which);
//
//        if ( tecla == 13 ){
//            if($.trim(mensaje)!=''){
//                
//                marcacion = new Date();
//                
//                hora = marcacion.getHours();
//                minutos = marcacion.getMinutes();
//                segundos = marcacion.getSeconds();
//                
//                jQuery.ajax({
//                    url:'<?php echo sfConfig::get('sf_app_herramientas_url'); ?>chat/saveChat',
//                    type:'POST',
//                    dataType:'html',
//                    data:'chat='+$.trim(mensaje)+
//                        '&receptor='+chat_id,
//                    success:function(data, textStatus) {
//                        if (!$('#chat_'+chat_id+'_'+hora+'-'+minutos).length){
//                            
//                            meridiem = 'AM';
//                            horaf = hora;
//                            if (hora > 12) { horaf -= 12; meridiem = 'PM';} 
//                            else if (hora === 0) { horaf = 12; }
//                            else if (hora == 12) { meridiem = 'PM';}
//                            
//                            $('div[id^=chat_'+chat_id+'_]').each(function (){
//                                $(this).attr("id",'');
//                            });
//                            
//                            cadena =  '<hr>';
//                            cadena += '<div style="position: relative;">';
//                            cadena += '    <div style="position: absolute;">';
//                            cadena += '        <img width="30" src="/images/fotos_personal/<?php echo $session_funcionario['cedula']; ?>.jpg"/>';
//                            cadena += '    </div>';
//                            cadena += '    <div style="position: absolute; right: 10px; top:-5px" class="f10n">';
//                            cadena += '        '+hora+':'+minutos;
//                            cadena += '    </div>';
//                            cadena += '</div>';
//                            cadena += '<div id="chat_'+chat_id+'_'+hora+'-'+minutos+'" style="padding-left: 40px; min-height: 40px;">';
//                            cadena += '    '+data;
//                            cadena += '</div>';
//                        
//                            $('#chat_'+chat_id).append(cadena);
//                        } else {
//                            $('#chat_'+chat_id+'_'+hora+'-'+minutos).append(data);
//                        }
//                        
//                        $("#send_"+chat_id).val('').css('height','15px');
//                        $("#chat_"+chat_id).parent().scrollTop($("#chat_"+chat_id).get(0).scrollHeight);
//                    }
//                })
//            }
//        }
//    }
//
//    function open_chat(id,mensaje){
//    
//    var ventana = screen.width;
//    if(ventana > (right+245))
//    {
//    
//        if (!$('#win_'+id).length){
//            if(nombre==''){nombre = $("#activo_"+id).html();}
//            cadena =  '<div id="win_'+id+'" style = "right: '+right+'px;" align="center" class="win">'
//            cadena += '    <div id="cedula_'+id+'"></div>';
//            cadena += '    <div id="titulo_'+cont+'" class="titulo_chat" align="left">'+nombre;
//            cadena += '         <img src="../../images/icon/delete_old.png" onclick="close_chat('+id+')" style="cursor: pointer" align="right"></img>';
//            cadena += '         <img id="minChat_'+id+'" src="../../images/icon/min.png" onclick="minimize_chat('+id+')" style="cursor: pointer" align="right"></img>';
//            cadena += '    </div>';
//            cadena += '    <div id="content_'+cont+'" class="contenido_chat" align="left" style="overflow-x: hidden;">';
//            cadena += '         <div id="chat_'+id+'" style="word-wrap: break-word;">';
//            cadena += '         </div>';
//            cadena += '    </div><br/>';
//            cadena += '    <div align="left" style="position: absolute;bottom: 0px;overflow-x: hidden;background-color: #ffffff;">';
//            cadena += '         <textarea id="send_'+id+'" style="width: 235px; height: 15px; resize: none;" onkeypress="send_chat(this.value,event,'+id+');" placeholder="Escriba su mensaje aqui.."/><br/>';
//            cadena += '    </div>';
//            cadena += '</div>';
//
//            $("#chats").append(cadena);
//            right = right + 245;
//            $("#send_"+id).TextAreaExpander(15, 40);
//            jQuery.ajax(
//            {
//                url:'<?php echo sfConfig::get('sf_app_herramientas_url'); ?>chat/guardarId',
//                type:'POST',
//                dataType:'html',
//                data:'posicion='+cont+'&id='+id+'&op=N',
//                success:function(data, textStatus) {
//                    $("#chat_"+id).append(data);
//                    $("#send_"+id).val('').css('height','15px');
//                    $("#chat_"+id).parent().scrollTop($("#chat_"+id).get(0).scrollHeight);
//                }
//            });
//            
//            jQuery.ajax(
//            {
//                url:'<?php echo sfConfig::get('sf_app_herramientas_url'); ?>chat/cedulaEnvia',
//                type:'POST',
//                dataType:'html',
//                data:'id='+id,
//                success:function(data, textStatus) {
//                    $("#cedula_"+id).attr('class',data);
//                }
//            });
//            cont++;
//         } else if(mensaje!='undefined'){
//            
//            marcacion = new Date();
//
//            hora = marcacion.getHours();
//            minutos = marcacion.getMinutes();
//            segundos = marcacion.getSeconds();
//            
//            if (!$('#chat_'+id+'_r_'+hora+'-'+minutos).length){
//                $('div[id^=chat_'+id+'_]').each(function (){
//                    $(this).attr("id",'');
//                });
//                meridiem = 'AM';
//                horaf = hora;
//                if (hora > 12) { horaf -= 12; meridiem = 'PM';} 
//                else if (hora === 0) { horaf = 12; }
//                else if (hora == 12) { meridiem = 'PM';}
//
//                cadena =  '<hr>';
//                cadena += '<div style="position: relative;">';
//                cadena += '    <div style="position: absolute;">';
//                cadena += '        <img width="30" src="/images/fotos_personal/'+$('#cedula_'+id).attr('class')+'.jpg"/>';
//                cadena += '    </div>';
//                cadena += '    <div style="position: absolute; right: 10px; top:-5px" class="f10n">';
//                cadena += '        '+hora+':'+minutos;
//                cadena += '    </div>';
//                cadena += '</div>';
//                cadena += '<div id="chat_'+id+'_r_'+hora+'-'+minutos+'" style="padding-left: 40px; min-height: 40px;">';
//                cadena += '    '+mensaje;
//                cadena += '</div>';
//
//                $('#chat_'+id).append(cadena);
//            } else {
//                $('#chat_'+id+'_r_'+hora+'-'+minutos).append(mensaje);
//            }
//        }
//        
//        $("#chat_"+id).parent().scrollTop($("#chat_"+id).get(0).scrollHeight);
//        }
//        else
//        {
//            alert("Posee muchas ventanas de conversacion abiertas")
//        }
//        nombre = '';
//    };
//    
//
//    function close_chat(id) {
//        jQuery.ajax({
//            url:'<?php echo sfConfig::get('sf_app_herramientas_url'); ?>chat/guardarId',
//            type:'POST',
//            dataType:'html',
//            data:'id='+id+'&op=D',
//
//            success:function(data, textStatus) {
//                $('div[id^=win_]').each(function (){
//                    if(parseInt($(this).css("right"))>parseInt($("#win_"+id).css("right")))
//                        $(this).css("right", parseInt($(this).css("right"))-245);
//                });
//                right=right-245;
//                $("#win_"+id).remove();
//            }
//        });
//    }
//
//    function minimize_chat(id)
//    {
//        if($("#minChat_"+id).attr("src")=="../../images/icon/min.png") {
//            $("#win_"+id).fadeIn(100).animate({bottom:"-=220px"},"slow");
//            $("#minChat_"+id).attr("src","../../images/icon/max.png")
//          
//            jQuery.ajax(
//            {
//                url:'<?php echo sfConfig::get('sf_app_herramientas_url'); ?>chat/minimizar',
//                type:'POST',
//                dataType:'html',
//                data:'id='+id+'&min=1'
//            });
//        } else {
//            $("#win_"+id).fadeIn(100).animate({bottom:"+=220px"},"slow");
//            $("#minChat_"+id).attr("src","../../images/icon/min.png")
//            
//            jQuery.ajax(
//            {
//                url:'<?php echo sfConfig::get('sf_app_herramientas_url'); ?>chat/minimizar',
//                type:'POST',
//                dataType:'html',
//                data:'id='+id+'&min=0'
//            });
//        }
//    }
//    
//    function minimize_amigos()
//    {
//        if($("#minAmigos").attr("src")=="../../images/icon/min.png")
//            {
//                $("#minAmigos").attr("src","../../images/icon/max.png");
//                $("#livio").slideUp();
//                mini = 1;
//            }
//        else
//            {
//                $("#minAmigos").attr("src","../../images/icon/min.png");
//                $("#livio").slideDown();
//                mini = 0;
//            }
//    }
//
//    function agregarAmigo(id)
//    {
//        jQuery.ajax({
//            url:'<?php echo sfConfig::get('sf_app_herramientas_url'); ?>chat/guardarAmigo',
//            type:'POST',
//            dataType:'html',
//            data:'id='+id,
//            success:function() {
//                $("#"+id).attr("class","sf_admin_action_amigo_new");
//            }});
//    };
//    
//    function eliminarAmigo(id,action)
//    {
//        jQuery.ajax({
//            url:'<?php echo sfConfig::get('sf_app_herramientas_url'); ?>chat/eliminarAmigo',
//            type:'POST',
//            dataType:'html',
//            data:'id='+id,
//            success:function() {
//                if(action == "chat")
//                {
//                    close_chat(id);
//                    $('#activo_'+id).parent().remove();
//                    $('#activo_'+id).remove();
//                }
//                else
//                {
//                    $("#"+id).attr("class","sf_admin_action_amigo_new");
//                }
//            }});
//    };

//    function mostrar(id)
//    {
//        $('#td_'+id).show();
//    }
//
//    function ocultar(id)
//    {
//        $('#td_'+id).hide();
//    }
    
    
</script>

<!--<div id="barra_chats" style="width: 160px;z-index: 110;" bgcolor="#00FF00">
    <div id="chat"></div>
    <div id="listado" style="z-index: 110;">
        <div style="width: 165px; font-weight: bold; padding:7px; border: 1px solid #000000;">
            Chat <img id="minAmigos" src="../../images/icon/min.png" onclick="minimize_amigos()" style="cursor: pointer;float: right;"></img>
                 <a href="<?php echo sfConfig::get('sf_app_herramientas_url')."directorio_interno"; ?>">
                    <img id="minAmigos" src="../../images/icon/add.png" style="cursor: pointer;float: right;"></img>
                 </a>
        </div>

        <div id="livio" style="background-color: #E2E2E2">
            <div id="amigos"></div>
            <script>
                $('#amigos').load('<?php echo sfConfig::get('sf_app_herramientas_url'); ?>chat/amigosActivos').fadeIn("slow");
            </script>
        </div>
    </div>
    <div id="chats_tmp"></div>
    <div id="chats"></div>
-->    

<!--    <script>
        loaded = 0;
        minimize_amigos();
        $('#amigos').load('<?php echo sfConfig::get('sf_app_herramientas_url'); ?>chat/amigosActivos',null,function(){
           <?php

        if($sf_user->getAttribute('chat')) {
            $chats = $sf_user->getAttribute('chat');
            $min = $sf_user->getAttribute('minimizados');

//            foreach($min as $m) echo "alert(".$m.");";

            echo "count = ".count($chats).";";
            foreach($chats as $chat)
            {
                if($chat)
                    {
                        echo "open_chat(".$chat.");";
                        echo "minimize_chat(".$chat.");";
                    }
            }
        }
        ?>
        }).fadeIn("slow");
        
    </script>-->

<!--</div>-->

