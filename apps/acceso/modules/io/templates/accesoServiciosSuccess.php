<script>   
    function visibilidad_parametro(class_param){
        if($('#'+class_param).is(':checked')){
            var visible = true;
        } else {
            var visible = false;
        }

        $('[class^='+class_param+']').each(function() {
            $(this).attr('checked', visible); 
        });
    }
    
    function activar_edicion_parametros(servicio_id){
        $('#li_desactivar_io_'+servicio_id).hide();
        $('#li_activar_io_'+servicio_id).hide();
        $('#li_notificar_io_'+servicio_id).hide();
        
        $('#li_guardar_io_'+servicio_id).show();
        $('#li_cancelar_io_'+servicio_id).show();
        
        $('.parametro_check').removeAttr('disabled');
    }
    
    function desactivar_edicion_parametros(servicio_id){
        $('#li_guardar_io_'+servicio_id).hide();
        $('#li_cancelar_io_'+servicio_id).hide();
        
        $('#li_desactivar_io_'+servicio_id).show();
        $('#li_activar_io_'+servicio_id).show();
        $('#li_notificar_io_'+servicio_id).show();

        $('.parametro_check').attr('disabled','disabled');
    }
    
    function guardar_edicion_parametros(servicio_id){
        if(confirm('A partir de este momento <?php echo $organismo->getSiglas(); ?> podra acceder a este servicio. ¿Esta seguro de guardar los cambios?')){
            $('#td_publicado_'+servicio_id).html('<?php echo image_tag('icon/cargando.gif', array('size'=>'25x25')); ?>');
            $('#li_guardar_io_'+servicio_id).hide();
            $('#li_cancelar_io_'+servicio_id).hide();

            $.ajax({
                url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>io/activarAccesoServicio',
                type:'POST',
                dataType:'html',
                data: $('#form_servicio_confianza_'+servicio_id).serialize(),
                success:function(data, textStatus){
                    window.location.reload();
//                    $('#td_publicado_'+servicio_id).html(data);
                }});
        } else {
            return false;
        }
    }
    
    function desactivar_confianza_servicio(servicio_id){
        if(confirm('¿Esta seguro de desactivar el servicio para el organismo seleccionado?')){
            $('#td_publicado_'+servicio_id).html('<?php echo image_tag('icon/cargando.gif', array('size'=>'25x25')); ?>');
            $('#li_desactivar_io_'+servicio_id).hide();
            $('#li_activar_io_'+servicio_id).hide();
            $('#li_notificar_io_'+servicio_id).hide();

            $.ajax({
                url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>io/desactivarAccesoServicio',
                type:'POST',
                dataType:'html',
                data: 'servicio_id='+servicio_id,
                success:function(data, textStatus){
                    window.location.reload();
                }});
        } else {
            return false;
        }
    }
    
    function notificar_servicio_disponible(servicio_id){
        $('#td_notificado_'+servicio_id).html('<?php echo image_tag('icon/cargando.gif', array('size'=>'25x25')); ?>');
        $('#li_notificar_io_'+servicio_id).hide();
        $('#li_activar_io_'+servicio_id).hide();
        $('#li_desactivar_io_'+servicio_id).hide();
        $.ajax({
            url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>io/notificarAccesoServicio',
            type:'POST',
            dataType:'html',
            data: 'servicio_id='+servicio_id,
            success:function(data, textStatus){
                $('#td_notificado_'+servicio_id).html(data);
                $('#li_notificar_io_'+servicio_id).show();
                $('#li_activar_io_'+servicio_id).show();
                $('#li_desactivar_io_'+servicio_id).show();
            }});
    }
</script>

<?php

function imprimirArrayParametros($array,$padre,$tab) {
    $pad = $tab*20;
    foreach ($array as $key => $value) {
        $attr_value = $padre."___".$key."___";
        if(is_array($value)){

            if(!is_numeric($key)){
                echo '<div style="padding-left: '.$pad.'px;"><input type="checkbox" checked="checked" disabled="disabled" name="array_parametros_salida['.$attr_value.'_]" id="'.$attr_value.'" class="'.$attr_value.' parametro_check" onchange="visibilidad_parametro(\''.$attr_value.'\');"/>&nbsp;'.$key.'</div>';
                $tab++;
            }
            imprimirArrayParametros($value,$attr_value,$tab); 
            $tab--;
        } else {
            echo '<div style="padding-left: '.$pad.'px;"><input type="checkbox" checked="checked" disabled="disabled" name="array_parametros_salida['.$attr_value.'_]" id="'.$attr_value.'" class="'.$attr_value.' parametro_check" onchange="visibilidad_parametro(\''.$attr_value.'\');"/>&nbsp;'.$key.'</div>';
        }
    }
}

?>

<div id="sf_admin_container">
    <h1>Servicios publicados para <?php echo $organismo->getNombre().' / '.$organismo->getSiglas() ?></h1>

    <div id="sf_admin_header"></div>

    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <table cellspacing="0">
                <tr>
                    <th>Función</th>
                    <th>Modelo de Servicio</th>
                    <th>Url y recursos</th>
                    <th>Parametros solicitados</th>
                    <th>Parametros disponibles</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
                <?php 
                    foreach ($servicios as $servicio) { 
                        $servicios_publicados_confianza = Doctrine::getTable('Siglas_ServiciosPublicadosConfianza')->confianzaEnServicio($servicio->getId(), $sf_user->getAttribute('servidor_confianza_id'));
                ?>
                    <tr>
                        <td class="sf_admin_text" style="width: 200px;">
                            <?php echo $servicio->getFuncion(); ?>
                            <hr/>
                            <div style="padding-right: 5px; font-size: 10px; text-align: justify; max-height: 120px; overflow-y: auto;">
                                <?php echo $servicio->getDescripcion(); ?>
                            </div>
                        </td>
                        <td class="sf_admin_text" style="width: 150px;">
                            <u>Tipo de sincronizacion</u>: <br/>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $servicio->getTipo(); ?><br/><br/>
                            <?php if($servicio->getCrontab() != 'false') { ?>
                                <u>Frecuencia</u>: <br/>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $servicio->getCrontab(); ?>
                            <?php } ?>
                        </td>
                        
                        
                        <td class="sf_admin_text" style="width: 140px;">
                            <div style="width: 140px; word-wrap: break-word;">
                                <b>URL</b><br/>
                                <a style="color: blue; font-size: 12px;" href="<?php echo $servicio->getUrl(); ?>" target="_blank">
                                    <?php echo $servicio->getUrl(); ?>
                                </a>
                                <hr/>
                                <b>Recusos</b><br/>
                                <a style="color: blue; font-size: 12px;" href="/uploads/interoperabilidad/recursos_internos/<?php echo $servicio->getRecursos(); ?>">
                                    <?php echo $servicio->getRecursos(); ?>
                                </a>
                            </div>
                        </td>
                        
                        <td class="sf_admin_text">
<pre>
<?php
$array_entrada_yml_print = str_replace(': true', '', $servicio->getParametrosEntrada());
print_r($array_entrada_yml_print);
?>
</pre>
                        </td>

                        <td style="width: 280px;">
                            <div style="width: 280px; max-height: 150px; overflow-y: auto; overflow-x: auto; font-size: 10px;">
                                <form id="form_servicio_confianza_<?php echo $servicio->getId(); ?>">
                                    <input type="hidden" name="servicio_id" value="<?php echo $servicio->getId(); ?>"/>

                                <?php imprimirArrayParametros(sfYaml::load($servicio->getParametrosSalida()),'',0); ?>

                                    <script>$('.parametro_check').attr('disabled','disabled');</script>
                                </form>
                            </div>
                        </td>
                        <td style="width: 120px;">
                            Publicado: 
                            <div id="td_publicado_<?php echo $servicio->getId(); ?>" style="position: relative;">
                            <?php 
                                if(count($servicios_publicados_confianza)==1){
                                    if($servicios_publicados_confianza[0]->getStatus()=='A'){
                                        echo '<div style="position: absolute; top: -15px; left: 70px;"><img src="/images/icon/tick.png" title="Activado"></div>';
                                    } else {
                                        echo '<div style="position: absolute; top: -15px; left: 70px;"><img src="/images/icon/alto.png" title="Desactivado"></div>';
                                    }
                                } else {
                                    echo '<div style="position: absolute; top: -15px; left: 70px;"><img src="/images/icon/alto.png" title="Desactivado"></div>';
                                }
                            ?>
                            </div>
                            Notificado: 
                            <div id="td_notificado_<?php echo $servicio->getId(); ?>" style="position: relative;">
                                <?php 
                                    if(count($servicios_publicados_confianza)==1){
                                        if($servicios_publicados_confianza[0]->getNotificacion()==true){
                                            echo '<div style="position: absolute; top: -15px; left: 70px;"><img src="/images/icon/tick.png" title="Notificado"></div>';
                                        } else {
                                            echo '<div style="position: absolute; top: -15px; left: 70px;"><img src="/images/icon/delete_old.png" title="Sin Notificar"></div>';
                                        }
                                    } else {
                                        echo '<div style="position: absolute; top: -15px; left: 70px;"><img src="/images/icon/delete_old.png" title="Sin Notificar"></div>';
                                    }
                                ?>
                            </div>
                        </td>
                        
                        <td>
                            <ul class="sf_admin_td_actions">
                                <?php 
                                    if(count($servicios_publicados_confianza)==1){
                                        if($servicios_publicados_confianza[0]->getStatus()=='A'){ ?>
                                            <li id="li_desactivar_io_<?php echo $servicio->getId(); ?>" class="sf_admin_action_desactivar">
                                                <a href="#" onclick="desactivar_confianza_servicio(<?php echo $servicio->getId(); ?>); return false;">Desactivar Interoperabilidad</a>
                                            </li> 
                                            <li id="li_activar_io_<?php echo $servicio->getId(); ?>" class="sf_admin_action_edit_param">
                                                <a href="#" onclick="activar_edicion_parametros(<?php echo $servicio->getId(); ?>); return false;">Editar parametros visibles</a>
                                            </li> 
                                        <?php } else { ?>
                                        <li id="li_activar_io_<?php echo $servicio->getId(); ?>" class="sf_admin_action_activar">
                                            <a href="#" onclick="activar_edicion_parametros(<?php echo $servicio->getId(); ?>); return false;">Activar Interoperabilidad</a>
                                        </li> 
                                    <?php }     
                                    } else { ?>
                                        <li id="li_activar_io_<?php echo $servicio->getId(); ?>" class="sf_admin_action_activar">
                                            <a href="#" onclick="activar_edicion_parametros(<?php echo $servicio->getId(); ?>); return false;">Activar Interoperabilidad</a>
                                        </li> 
                                    <?php
                                    }
                                ?>
                                <li id="li_guardar_io_<?php echo $servicio->getId(); ?>" class="sf_admin_action_guardar" style="display: none;">
                                    <a href="#" onclick="guardar_edicion_parametros(<?php echo $servicio->getId(); ?>); return false;">Guardar parametros Interoperabilidad</a>
                                </li> 
                                <li id="li_cancelar_io_<?php echo $servicio->getId(); ?>" class="sf_admin_action_cancelar" style="display: none;">
                                    <a href="#" onclick="desactivar_edicion_parametros(<?php echo $servicio->getId(); ?>); return false;">Cancelar</a>
                                </li> 
                                <?php 
                                    if(count($servicios_publicados_confianza)==1){
                                        if($servicios_publicados_confianza[0]->getStatus()=='A'){ ?>
                                        <li id="li_notificar_io_<?php echo $servicio->getId(); ?>" class="sf_admin_action_notificar">
                                            <a href="#" onclick="notificar_servicio_disponible(<?php echo $servicio->getId(); ?>); return false;">Notificar al cliente de la disponibilidad el servicio</a>
                                        </li> 
                                    <?php
                                        }
                                    }
                                ?>
                            </ul>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <ul class="sf_admin_actions trans">
            <li class="sf_admin_action_regresar_modulo">
                <a href="<?php echo sfConfig::get('sf_app_acceso_url'); ?>io">Regresar a servidores de confianza</a>
            </li>    
        </ul>
    </div>

    <div id="sf_admin_footer"></div>
</div>