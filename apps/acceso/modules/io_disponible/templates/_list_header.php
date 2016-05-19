<script>
    function agregar_ip(servicio_id){
        $('#li_button_add_ip_permitida_'+servicio_id).hide();
        $('#li_button_save_ip_permitida_'+servicio_id).show();
        $('#li_button_cancel_ip_permitida_'+servicio_id).show();
        $('#div_form_new_ip_'+servicio_id).show();
    }
    
    function cancelar_ip(servicio_id){
        $('#li_button_add_ip_permitida_'+servicio_id).show();
        $('#li_button_save_ip_permitida_'+servicio_id).hide();
        $('#li_button_cancel_ip_permitida_'+servicio_id).hide();
        $('#div_form_new_ip_'+servicio_id).hide();
    }
    
    function guardar_ip(servicio_id){
        var errores = '';

        if($('#new_ip_'+servicio_id).val()===''){
            errores = 'Agregue una IP antes de guardar';
        } else {
           var new_ip = $('#new_ip_'+servicio_id).val().trim();
            // Patron para la ip 
            var patronIp=new RegExp("^([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3})$"); 
            
            // Si la ip consta de 4 pares de números de máximo 3 dígitos 
            if(new_ip.search(patronIp)==0) { 
                // Validamos si los números no son superiores al valor 255 
                valores=new_ip.split("."); 
                if(!(valores[0]<=255 && valores[1]<=255 && valores[2]<=255 && valores[3]<=255)) { 
                    errores = 'Verifique la IP';
                }
            } else {
                errores = 'Verifique la IP';
            }
        }

        if($('#new_detalles_maquina_'+servicio_id).val()===''){
            errores = 'Agregue los detalles de la IP antes de guardar';
        }
        
        if(errores === ''){
            if(confirm('¿Esta seguro de permitir el acceso a esta IP?')){
                $('#div_ips_permitidas_'+servicio_id).html('<?php echo image_tag('icon/cargando.gif', array('size'=>'25x25')); ?> Guardando IP...');

                $('#li_button_add_ip_permitida_'+servicio_id).show();
                $('#li_button_save_ip_permitida_'+servicio_id).hide();
                $('#li_button_cancel_ip_permitida_'+servicio_id).hide();
                $('#div_form_new_ip_'+servicio_id).hide();

                $.ajax({
                    url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>io_disponible/guardarIpPermitida',
                    type:'POST',
                    dataType:'html',
                    data: 'servicio_id='+servicio_id+
                          '&ip='+new_ip+
                          '&detalles='+$('#new_detalles_maquina_'+servicio_id).val(),
                    success:function(data, textStatus){
                        $('#new_ip_'+servicio_id).val('');
                        $('#new_detalles_maquina_'+servicio_id).val('');
                        $('#div_ips_permitidas_'+servicio_id).html(data);
                    }});
            } else {
                return false;
            }
        } else {
            alert(errores);
        }
    }
    
    function mostrar_delete(ip_id){
        $('#div_button_delete_'+ip_id).show();
    }
    
    function ocultar_delete(ip_id){
        $('#div_button_delete_'+ip_id).hide();
    }
    
    function inactivar_ip(servicio_id,ip_id){
        if(confirm('¿Esta seguro de inactivar el acceso a esta IP?')){
            $('#div_ips_permitidas_'+servicio_id).html('<?php echo image_tag('icon/cargando.gif', array('size'=>'25x25')); ?> Inactivando IP...');

            $.ajax({
                url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>io_disponible/inactivarIpPermitida',
                type:'POST',
                dataType:'html',
                data: 'servicio_id='+servicio_id+
                      '&ip_id='+ip_id,
                success:function(data, textStatus){
                    $('#div_ips_permitidas_'+servicio_id).html(data);
                }});
        } else {
            return false;
        }
    }
</script>