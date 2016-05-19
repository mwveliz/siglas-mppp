<?php
// APP_CALL_FIRMA: VARIABLE DE LA APLICACION DEL SIGLAS QUE ESTA FIRMANDO
$sf_firmaElectronica = sfConfig::get('sf_firmaElectronica');
if($sf_firmaElectronica[$app_call_firma]['activo']==true){
?>
    <div style="position: relative;">
        <?php use_helper('jQuery'); ?>
        <script type="text/javascript" src="/kawi/kawi.js"></script>

        <script>

            $(document).ready(function(){
                $('.centrado_windows').css({
                     position:'absolute',
                     left: ($(window).width() - $('.centrado_windows').outerWidth())/2,
                     top: ($(window).height() - $('.centrado_windows').outerHeight())/2
                });
            });


            function prepare_signature(current_id, action_prepare_signature, action_submit_signature) {
                // CURRENT_ID: VARIABLE QUE RECIBE EL ID PRINCIPAL DE LO QUE SE FIRMA
                // ACTION_PREPARE_SIGNATURE: VARIABLE QUE RECIBE EL EXECUTE QUE PREPARA LA CADENA DE FIRMA
                // ACTION_SUBMIT_SIGNATURE: VARIABLE QUE ENVIA PAQUETE FIRMADO
                
                $.ajax({
                    url:'<?php echo sfConfig::get('sf_app_'.$app_call_firma.'_url'); ?>'+action_prepare_signature,
                    type:'POST',
                    dataType:'html',
                    data:'current_id='+current_id,
                    beforeSend: function(Obj){
                        $('#div_espera').show();
                        $('#charge_image').show();
        //                $('#charge_text').html('Cargando conexion');
                    },
                    success:function(data, textStatus){
        //                $('#charge_image').hide();
        //                $('#charge_text').html('En espera del certificado');
                        $('#data_to_sign_id').val(current_id);
        //                $('#signature_packet').val(data);
        //                $('#div_signature_packet').html(data);
        
                        kawiAddData(current_id, data, 0);
                        kawiSetConfiguration($('#signature_conf').val());


                        
                        kawiPackage = kawiCreateKawiPackage();
                        $('#signature_packet').val(kawiPackage);
//                        alert('---'+$('#signature_packet').val());
                    },
                    complete: function() {
                        $('#div_espera').hide();
                        $('#charge_image').hide();
        //                $('#charge_text').html('Enviando firma');
                        if(($('#signature_packet').val() == "CANCELAR") || ($('#signature_packet').val() == "ERROR")){
                            kawiClearData();
                        } else {
                            if(action_submit_signature!='no_submit'){     
//                                alert('envia');
                                $("#signature_form").attr('action', '<?php echo sfConfig::get('sf_app_'.$app_call_firma.'_url'); ?>'+action_submit_signature);
                                $('#signature_form').submit();
                            }
                        }
                    }, 
                    error: function(error) {
                        alert("Ocurrio un problema: " + error);
                    }    
                });
            }




//            function prepare_signature_multiples(action_prepare_signature, action_submit_signature) {
//                // CURRENT_ID: VARIABLE QUE RECIBE EL ID PRINCIPAL DE LO QUE SE FIRMA
//                // ACTION_PREPARE_SIGNATURE: VARIABLE QUE RECIBE EL EXECUTE QUE PREPARA LA CADENA DE FIRMA
//                // ACTION_SUBMIT_SIGNATURE: VARIABLE QUE ENVIA PAQUETE FIRMADO
//                
//                
//                
//                
//                $.ajax({
//                    type: 'get',
//                    dataType: 'json',
//                    url: '<?php echo sfConfig::get('sf_app_'.$app_call_firma.'_url'); ?>'+action_prepare_signature,
//                    data: $('.sf_admin_batch_checkbox').serialize(),
//                    beforeSend: function(Obj){
//                        $('#div_espera').show();
//                        $('#charge_image').show();
//        //                $('#charge_text').html('Cargando conexion');
//                    },
//                    success: function(json) {
//                            var i = 0;
//                            $.each(json, function( index, value ) {
//                                $('#signature_form').append('<input type="hidden" name="ids['+i+']" value="'+index+'">');
//                                $('#data_to_sign_id').val();
////                                alert(value);
//                                document.kawi.addData(value);
//                                i++;
//                            });
////                        
//
//                        document.kawi.setConfiguracion($('#signature_conf').val());                
//                        $('#signature_packet').val(document.kawi.generarFirmaKawi());
////                        alert($('#signature_packet').val());
//                    },
//                    complete: function() {
//                        $('#div_espera').hide();
//                        $('#charge_image').hide();
//        //                $('#charge_text').html('Enviando firma');
//                        if(($('#signature_packet').val() == "CANCELAR") || ($('#signature_packet').val() == "ERROR")){
//                            document.kawi.clearData();
//                        } else {
//                            if(action_submit_signature!='no_submit'){                        
//                                $("#signature_form").attr('action', '<?php echo sfConfig::get('sf_app_'.$app_call_firma.'_url'); ?>'+action_submit_signature);
//                                $('#signature_form').submit();
//                            }
//                        }
//                    }, 
//                    error: function(Obj, err) {
//                        alert('No se pudo incluir el registro!');
//                    }
//                })
//                
//            }




            function verify_signature(current_id, firma_id, action_verify_signature) {
//                alert('verificando '+current_id);
                // ACTION_VERIFY_SIGNATURE: VARIABLE QUE RECIBE EXECUTE DE VERIFICACION DE FIRMA
                $.ajax({
                    url:'<?php echo sfConfig::get('sf_app_'.$app_call_firma.'_url'); ?>'+action_verify_signature,
                    type:'POST',
                    dataType:'html',
                    data:'current_id='+current_id+'&firma_id='+firma_id,
        //            beforeSend: function(Obj){
        ////                $('#div_espera').show();
        ////                $('#charge_image').show();
        ////                $('#charge_text').html('Cargando conexion');
        //            },
                    success:function(data, textStatus){               
                        $('#div_firma_ident_'+current_id+'_'+firma_id).append(data);

                    },
                    error: function(error) {
                        alert("Ocurrio un problema: " + error);
                    }    
                });
            }

        </script>
        <!--<div id='div_signature_packet'>paquete de firma</div>-->
        <form id="signature_form" method="post"> <!-- EL ACTION VIENE DADO EN EL LLAMADO AL JS PREPARE_SIGNATURE: VARIABLE action_submit_signature -->
            <input type="hidden" id="data_to_sign_id" name="id" value="">
            <input type="hidden" id="signature_packet" name="signature_packet" value="">
            <input type="hidden" id="signature_conf" name="signature_conf" value="<?php echo $sf_user->getAttribute('config_pkcsc'); ?>">
        </form>

        <applet
            id       = 'kawi'
            code     = 'flex.kawi.applet.AppletKawi'
            archive  = '/kawi/kawi-v010.jar'
            name     = 'kawi'
            width    = '370'
            height   = '10'
            align    = 'middle'
            mayscript
        >
            <param name='centerimage' value='true'>
            <param name='boxborder' value='false'>
        </applet>

        <div id="div_espera" 
             style="display: none; position: fixed; 
                    left: 0px; top: 0px; width: 100%; 
                    height: 100%; background-color: black; 
                    opacity: 0.4; filter:alpha(opacity=40); 
                    z-index: 1999;">&nbsp;
        </div>


        <div id="charge_image" class="centrado_windows" style="text-align: center; display: none; z-index: 2000; width: 100%;">
            <?php echo image_tag('other/siglas_wait.gif'); ?>
        </div>

    </div>
<?php } ?>