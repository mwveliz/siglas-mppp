<?php use_helper('jQuery'); ?>

<script>
    $(document).ready(function(){
        fn_dar_eliminar();
        fn_cantidad();
        $("#frm_usu").validate();
    });
    
    function validate_modems(masdeuno) {
        var vacio_auto= true;
        var vacio_parti= true;
        if (masdeuno) {
            var msj= '';
            if($("#sms_id_mensajes_externos").val() != '') {
                $(".auto_unico_modem").each(function(){
                    if($(this).attr('checked')){
                        vacio_auto= false;
                    }
                });
                
            }
            if($("#autorizados_particulares_unidad_id").val() != '') {
                $(".parti_unico_modem").each(function(){
                    if($(this).attr('checked')){
                        vacio_parti= false;
                    }
                });
            }
            
            if(vacio_auto && $("#sms_id_mensajes_externos").val() != '') {
                msj= 'Cargo de funcionario';
            }
            if(vacio_parti && $("#autorizados_particulares_unidad_id").val() != ''){
                if(msj!= '')
                    msj= msj+'\nFuncionario particular';
                else
                    msj= 'Funcionario particular';
            }
            
            if (msj != '') {
                alert('Seleccione modems de envío para:\n'+msj);
            }else {
                document.form_sms_config.submit();
            }
        }else {
            document.form_sms_config.submit();
        }
    }
    
    function fn_conmutar(){
        if ($('input[id=particulares]').attr('checked')){
            $("#tr_particulares").show();
        }else{
            $("#tr_particulares").hide();
        }
    };

    function fn_agregar_particular(nodevice){
        if($("#autorizados_particulares_unidad_id").val() && $("#autorizados_particulares_funcionario_id").val()){
            var emptycheck= false;
            $(".parti_unico_modem").each(function(){
                    if($(this).attr('checked')){
                        emptycheck= true;
                    }
                });
            if(emptycheck || nodevice) {
                cadena = "<tr>";
                cadena = cadena + "<td><font class='f16b'>" + jQuery.trim($("#autorizados_particulares_unidad_id option:selected").text()) + "</font><br/>";
                cadena = cadena + "<font class='f16n'>" + $("#autorizados_particulares_funcionario_id option:selected").text() + "</font><br/>";
                var enter = 'false';
                $(".parti_unico_modem").each(function(){
                    if($(this).attr('checked')){
                        cadena = cadena + "<font class='f11n'>" + $(this).val() + "</font>, ";
                        enter= 'true';
                    }
                });
                if(enter == 'true') {
                    cadena = cadena + "fin";
                }
                cadena = cadena.replace(", fin","");
                cadena = cadena + "<input name='sms[aplicaciones][mensajes_externos][autorizados_particulares][otros]["+$("#count_delete_particular").val()+"][dato]' type='hidden' value='" + $("#autorizados_particulares_unidad_id").val() + "#" + $("#autorizados_particulares_funcionario_id").val() + "'/>" + "</td>";
                $(".parti_unico_modem").each(function(){
                    if($(this).attr('checked')){
                        cadena = cadena + "<input name='sms[aplicaciones][mensajes_externos][autorizados_particulares][otros]["+$("#count_delete_particular").val()+"][modems][]' type='hidden' value='" + $(this).val() + "'/>" + "</td>";
                    }
                });
                if(nodevice) {
                    cadena = cadena + "<input name='sms[aplicaciones][mensajes_externos][autorizados_particulares][otros]["+$("#count_delete_particular").val()+"][modems][]' type='hidden' value=''/>" + "</td>";
                }
                cadena = cadena + "<td><a class='elimina' style='cursor: pointer;'><img src='/images/icon/delete.png'/></a></td>";
                $("#grilla tbody").append(cadena);
                fn_dar_eliminar();
                fn_cantidad();
                $("#count_delete_particular").val(parseInt($("#count_delete_particular").val())+1)
            }else{
                alert('Debe asignar un Modem para envio de sms a este particular');
            }
        }
        else {
            alert('Debe seleccionar la unidad y funcionario autorizado para poder agregar otro');
        }
    };

    function fn_agregar(app){
        if($("#sms_id_"+app).val())
        {
            cadena = "<tr>";
            cadena = cadena + "<td><font class='f16b'>" + jQuery.trim($("#sms_id_"+app+" option:selected").text()) + "</font><br/>";
            cadena = cadena + "<input name='sms[aplicaciones]["+app+"][autorizados][otros][]' type='hidden' value='" + $("#sms_id_"+app).val() + "'/>" + "</td>";
            cadena = cadena + "<td><a class='elimina' style='cursor: pointer;'><img src='/images/icon/delete.png'/></a></td>";
            $("#"+app+" tbody").append(cadena);
            fn_dar_eliminar();
            fn_cantidad(app);
        }
        else
        { alert('Debe seleccionar un cargo para poder agregar otro'); }
    };

    function fn_agregar_cargo(app, nodevice){
        if($("#sms_id_"+app).val())
        {
            var emptycheck= false;
            $(".auto_unico_modem").each(function(){
                    if($(this).attr('checked')){
                        emptycheck= true;
                    }
                });
            if (emptycheck || nodevice) {
                cadena = "<tr>";
                cadena = cadena + "<td><font class='f16b'>" + jQuery.trim($("#sms_id_"+app+" option:selected").text()) + "</font><br/>";
                var enter = 'false';
                $(".auto_unico_modem").each(function(){
                    if($(this).attr('checked')){
                        cadena = cadena + "<font class='f11n'>" + $(this).val() + "</font>, ";
                        enter= 'true';
                    }
                });
                if(enter == 'true') {
                    cadena = cadena + "fin";
                }
                cadena = cadena.replace(", fin","");
                cadena = cadena + "<input name='sms[aplicaciones]["+app+"][autorizados][otros]["+$("#count_delete_cargo").val()+"][dato]' type='hidden' value='" + $("#sms_id_"+app).val() + "'/>" + "</td>";
                $(".auto_unico_modem").each(function(){
                    if($(this).attr('checked')){
                        cadena = cadena + "<input name='sms[aplicaciones]["+app+"][autorizados][otros]["+$("#count_delete_cargo").val()+"][modems][]' type='hidden' value='" + $(this).val() + "'/>" + "</td>";
                    }
                });
                if(nodevice) {
                    cadena = cadena + "<input name='sms[aplicaciones]["+app+"][autorizados][otros]["+$("#count_delete_cargo").val()+"][modems][]' type='hidden' value=''/>" + "</td>";
                }
                cadena = cadena + "<td><a class='elimina' style='cursor: pointer;'><img src='/images/icon/delete.png'/></a></td>";
                $("#"+app+" tbody").append(cadena);
                fn_dar_eliminar();
                fn_cantidad(app);
                $("#count_delete_cargo").val(parseInt($("#count_delete_cargo").val())+1)
            }else {
                alert('Debe asignar un Modem para envio de sms a este cargo');
            }
        }
        else
        { alert('Debe seleccionar un cargo para poder agregar otro'); }
    };

    function fn_cantidad(app){
            cantidad = $("#"+app+" tbody").find("tr").length;
            $("#span_cantidad").html(cantidad);
    };

    function fn_dar_eliminar(){
        $("a.elimina").click(function(){
            $(this).parent().parent().fadeOut("normal", function(){
                    $(this).remove();
                })
        });
    };

    function actualizar(){
        <?php
        echo jq_remote_function(array('update' => 'contenido_capacidad_masiva',
        'url' => 'configuracion/actualizarCapacidadMass',));
        ?>
    };
</script>

<fieldset id="sf_fieldset_email">
    <form method="post" name="form_sms_config" action="<?php echo sfConfig::get('sf_app_acceso_url').'configuracion/saveSms'; ?>">
    <h2>Mensajes de Texto (SMS)</h2>

    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="correspondencia_n_correspondencia_emisor">Estatus</label>
            <div class="content">
                <input type="radio" name="sms[activo]" value=true <?php if($sf_sms['activo'] == true) echo "checked"; ?>/> Activo&nbsp;&nbsp;&nbsp;
                <input type="radio" name="sms[activo]" value=false <?php if($sf_sms['activo'] == false) echo "checked"; ?>/> Inactivo
            </div>
        </div>
    </div>

    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="correspondencia_n_correspondencia_emisor">Conexión Gammu</label>
            <div class="content">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 450px !important">
                            <div style="position: relative; height: 120px;">
                                <div style="position: absolute; top: 0px;">Versión Gammu:</div>
                                <div style="position: absolute; top: 0px; left: 100px;">
                                    <select name="sms[conexion_gammu][version]">
                                        <option value="1.28" <?php if ($sf_sms['conexion_gammu']['version'] == "1.28") echo 'selected'; ?>>1.28 (Debian 6 "Squeeze")</option>
                                        <option value="1.31" <?php if ($sf_sms['conexion_gammu']['version'] == "1.31") echo 'selected'; ?>>1.31 (Ubuntu 11.04 "Natty Narwhal" o superior)</option>
                                    </select>
                                </div>
                                <div style="position: absolute; top: 20px;">Servidor:</div>
                                <div style="position: absolute; top: 20px; left: 100px;">
                                    <input type="text" name="sms[conexion_gammu][host]" value="<?php echo $sf_sms['conexion_gammu']['host']; ?>"/>
                                </div>
                                <div style="position: absolute; top: 40px;">Puerto:</div>
                                <div style="position: absolute; top: 40px; left: 100px;">
                                    <input type="text" name="sms[conexion_gammu][port]" value="<?php echo $sf_sms['conexion_gammu']['port']; ?>"/>
                                </div>
                                <div style="position: absolute; top: 60px;">Base de Datos:</div>
                                <div style="position: absolute; top: 60px; left: 100px;">
                                    <input type="text" name="sms[conexion_gammu][dbname]" value="<?php echo $sf_sms['conexion_gammu']['dbname']; ?>"/>
                                </div>
                                <div style="position: absolute; top: 80px;">Usuario:</div>
                                <div style="position: absolute; top: 80px; left: 100px;">
                                    <input type="text" name="sms[conexion_gammu][username]" value="<?php echo $sf_sms['conexion_gammu']['username']; ?>"/>
                                </div>
                                <div style="position: absolute; top: 100px;">Clave:</div>
                                <div style="position: absolute; top: 100px; left: 100px;">
                                    <input type="text" name="sms[conexion_gammu][password]" value="<?php echo $sf_sms['conexion_gammu']['password']; ?>"/>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div id="contenido_capacidad_masiva" style="width: 310px">
                                <?php echo ($device== 'no_conn') ? 'Sin conexión a Base de Datos Gammu...': 'Dispositivos Conectados:<hr>';?>
                                <div>
                                    <div class="detalles">
                                        <table style="margin-left: 20px">
                                            <tbody>
                                                <tr>
                                                    <th>Dispositivo</th>
                                                    <th>Bateria</th>
                                                    <th>Señal</th>
                                                    <th>Envios</th>
                                                </tr>
                                                <?php
                                                if ($device != 'no_conn' && $device != '') {
                                                    for ($i = 0; $i < count($device); $i++) {
                                                        ?>
                                                        <tr>
                                                        <td><font style="color: #383737"><?php echo $device[$i]['id'] ?></font></td>
                                                        <td><?php
                                                            if ($device[$i]['battery'] > 0 && $device[$i]['battery'] <= 25)
                                                                echo image_tag('icon/batt25.png');
                                                            elseif ($device[$i]['battery'] > 25 && $device[$i]['battery'] <= 50)
                                                                echo image_tag('icon/batt50.png');
                                                            elseif ($device[$i]['battery'] > 50 && $device[$i]['battery'] <= 75)
                                                                echo image_tag('icon/batt75.png');
                                                            elseif ($device[$i]['battery'] > 75 && $device[$i]['battery'] <= 100)
                                                                echo image_tag('icon/batt100.png');
                                                            else
                                                                echo image_tag('icon/batt0.png');
                                                        ?></td>
                                                        <td><?php
                                                            if ($device[$i]['signal'] > 0 && $device[$i]['signal'] <= 25)
                                                                echo image_tag('icon/signal25.png');
                                                            elseif ($device[$i]['signal'] > 25 && $device[$i]['signal'] <= 50)
                                                                echo image_tag('icon/signal50.png');
                                                            elseif ($device[$i]['signal'] > 50 && $device[$i]['signal'] <= 75)
                                                                echo image_tag('icon/signal75.png');
                                                            elseif ($device[$i]['signal'] > 75 && $device[$i]['signal'] <= 100)
                                                                echo image_tag('icon/signal100.png');
                                                            else
                                                                echo image_tag('icon/signal0.png');
                                                        ?></td>
                                                    <td><?php echo $device[$i]['sent'] ?></td>
                                                </tr>
                                                <?php }
                                                }elseif($device != 'no_conn') { ?>
                                                <tr>
                                                    <td colspan="4">No hay Dispositivos conectados...</td>
                                                <?php } ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <?php
                                //CAPACIDAD ILIMITADA
//                                if ($device != 'no_conn' && $device != '') {
//                                    echo 'Capacidad de envío: ';
//                                    $capacidad = 0;
//                                    $capacidad = count($device) * 200;
//                                    echo $capacidad . ' Mensajes simultaneos';
//                                }
                                ?>
<!--                                <input type="hidden" name="sms[capacidad]" value="<?php //echo $capacidad ?>">
                                <br/>-->
                                <font style='font-size: 10px; color: #777'>Si ha realizado cambios en el hardware actualice la información</font><br/><br>
                            </div>
                            <input type="button" value="Actualizar" onClick="javascript:actualizar()">
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="correspondencia_n_correspondencia_emisor">Aplicaciones</label>
            <div class="content">
                <?php foreach ($sf_sms['aplicaciones'] as $aplicacion => $detalles) {
                if ($aplicacion != 'mensajes_externos'):?>
                    <table width="600">
                        <tr>
                            <td colspan="2"><b><?php echo $aplicacion; ?></b></td>
                        </tr>
                        <tr>
                            <td width="110"><b>Alerta Inmediata</b></td>
                            <td>
                                <input type="radio" name="sms[aplicaciones][<?php echo $aplicacion; ?>][activo]" value="true" <?php if($detalles['activo'] == TRUE) echo "checked"; ?>/> Activa&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="sms[aplicaciones][<?php echo $aplicacion; ?>][activo]" value="false" <?php if($detalles['activo'] == FALSE) echo "checked"; ?>/> Inactiva&nbsp;&nbsp;&nbsp;<br/>
                                Horario: &nbsp;&nbsp;desde
                                <?php list($hour,$minute,$second) = explode(':',$detalles['horario']['desde']); ?>
                                <select name="sms[aplicaciones][<?php echo $aplicacion; ?>][horario][desde][hora]">
                                    <?php for($k=0;$k<24;$k++) {
                                        $k_print = $k;
                                        if($k<10) $k_print = '0'.$k;
                                    ?>
                                    <option value="<?php echo $k_print; ?>" <?php if($hour==$k_print) echo 'selected'; ?>><?php echo $k_print; ?></option>
                                    <?php } ?>
                                </select>:
                                <select name="sms[aplicaciones][<?php echo $aplicacion; ?>][horario][desde][minuto]">
                                    <?php for($k=0;$k<59;$k+=10) {
                                        $k_print = $k;
                                        if($k<10) $k_print = '0'.$k;
                                    ?>
                                    <option value="<?php echo $k_print; ?>" <?php if($minute==$k_print) echo 'selected'; ?>><?php echo $k_print; ?></option>
                                    <?php } ?>
                                </select> hasta
                                <?php list($hour,$minute,$second) = explode(':',$detalles['horario']['hasta']); ?>
                                <select name="sms[aplicaciones][<?php echo $aplicacion; ?>][horario][hasta][hora]">
                                    <?php for($k=0;$k<24;$k++) {
                                        $k_print = $k;
                                        if($k<10) $k_print = '0'.$k;
                                    ?>
                                    <option value="<?php echo $k_print; ?>" <?php if($hour==$k_print) echo 'selected'; ?>><?php echo $k_print; ?></option>
                                    <?php } ?>
                                </select>:
                                <select name="sms[aplicaciones][<?php echo $aplicacion; ?>][horario][hasta][minuto]">
                                    <?php for($k=0;$k<59;$k+=10) {
                                        $k_print = $k;
                                        if($k<10) $k_print = '0'.$k;
                                    ?>
                                    <option value="<?php echo $k_print; ?>" <?php if($minute==$k_print) echo 'selected'; ?>><?php echo $k_print; ?></option>
                                    <?php } ?>
                                </select> (hora:minuto)
                                <br/>
                                Frecuencia: &nbsp;&nbsp;
                                <input type="checkbox" name="sms[aplicaciones][<?php echo $aplicacion; ?>][frecuencia][lunes]" <?php if($detalles['frecuencia']['lunes'] == TRUE) echo "checked"; ?>/> Lun&nbsp;&nbsp;
                                <input type="checkbox" name="sms[aplicaciones][<?php echo $aplicacion; ?>][frecuencia][martes]" <?php if($detalles['frecuencia']['martes'] == TRUE) echo "checked"; ?>/> Mar&nbsp;&nbsp;
                                <input type="checkbox" name="sms[aplicaciones][<?php echo $aplicacion; ?>][frecuencia][miercoles]" <?php if($detalles['frecuencia']['miercoles'] == TRUE) echo "checked"; ?>/> Mie&nbsp;&nbsp;
                                <input type="checkbox" name="sms[aplicaciones][<?php echo $aplicacion; ?>][frecuencia][jueves]" <?php if($detalles['frecuencia']['jueves'] == TRUE) echo "checked"; ?>/> Jue&nbsp;&nbsp;
                                <input type="checkbox" name="sms[aplicaciones][<?php echo $aplicacion; ?>][frecuencia][viernes]" <?php if($detalles['frecuencia']['viernes'] == TRUE) echo "checked"; ?>/> Vie&nbsp;&nbsp;
                                <input type="checkbox" name="sms[aplicaciones][<?php echo $aplicacion; ?>][frecuencia][sabado]" <?php if($detalles['frecuencia']['sabado'] == TRUE) echo "checked"; ?>/> Sab&nbsp;&nbsp;
                                <input type="checkbox" name="sms[aplicaciones][<?php echo $aplicacion; ?>][frecuencia][domingo]" <?php if($detalles['frecuencia']['domingo'] == TRUE) echo "checked"; ?>/> Dom
                            </td>
                        </tr>
                        <tr>
                            <?php if($aplicacion== 'mensajes'):?>
                            <td width="110"><b>Autorizados</b></td>
                            <td>
                                <select name="sms[aplicaciones][<?php echo $aplicacion; ?>][autorizados][unico]" id="sms_id_<?php echo $aplicacion; ?>">
                                    <?php
                                    if (isset($sf_sms['aplicaciones']['mensajes']['autorizados']['unico']))
                                        $unico = $sf_sms['aplicaciones']['mensajes']['autorizados']['unico'];
                                    foreach ($sf_organigramas as $sf_organigrama):
                                        ?><option <?php echo ($unico==$sf_organigrama->getId())? 'selected':''; ?> value="<?php echo $sf_organigrama->getId()?>"><?php echo $sf_organigrama->getNombre();?></option><?php
                                    endforeach;
                                    ?>
                                </select>
                                <a class='partial_new_view partial' href="#" onclick="javascript: fn_agregar('<?php echo $aplicacion; ?>'); return false;">Agregar otro</a>
                                <table name="otros" id="<?php echo $aplicacion; ?>" class="lista">
                                <tbody>
                                    <?php
                                        if(isset($sf_sms['aplicaciones']['mensajes']['autorizados']['otros'])) {
                                            foreach ($sf_sms['aplicaciones']['mensajes']['autorizados']['otros'] as $id_cargo) {
                                                foreach ($sf_organigramas as $organismos) {
                                                    if ($organismos->getId() == $id_cargo) {
                                                        $cadena = "<tr>";
                                                        $cadena .= "<td><font class='f16b'>" . $organismos->getNombre() . "</font><br/>";
                                                        $cadena .= "<input name='sms[aplicaciones][mensajes][autorizados][otros][]' type='hidden' value='" . $id_cargo . "'/></td>";
                                                        $cadena .= "<td><a class='elimina' style='cursor: pointer;'><img src='/images/icon/delete.png'/></a></td>";
                                                        $cadena .= "<tr/>";
                                                        echo $cadena;
                                                    }
                                                }
                                             }
                                        }
                                    ?>
                                </tbody>
                                </table>
                            </td>
                            <?php endif?>
                        </tr>
                    </table>
                <?php else:?>
                        <table width="600">
                        <tr>
                            <td colspan="2"><b><?php echo str_replace('_', ' ', $aplicacion); ?></b></td>
                        </tr>
                        <tr>
                            <td width="110"><b>Alerta Inmediata</b></td>
                            <td>
                                <input type="radio" name="sms[aplicaciones][<?php echo $aplicacion; ?>][activo]" value="true" <?php if($detalles['activo'] == TRUE) echo "checked"; ?>/> Activa&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="sms[aplicaciones][<?php echo $aplicacion; ?>][activo]" value="false" <?php if($detalles['activo'] == FALSE) echo "checked"; ?>/> Inactiva&nbsp;&nbsp;&nbsp;<br/>
                            </td>
                        </tr>
                        <tr>
                            <td width="110"><b>Autorizados</b></td>
                            <td>
                                Cargos:<br/>
                                <select name="sms[aplicaciones][<?php echo $aplicacion; ?>][autorizados][unico][dato]" id="sms_id_<?php echo $aplicacion;?>">
                                    <?php
                                    $cadena_auto= "<option value='' ><- Seleccione -></option>";

                                    foreach ($sf_organigramas as $sf_organigrama){
                                        $cadena_auto .= "<option value='" . $sf_organigrama->getId() . "'>" . $sf_organigrama->getNombre() . "</option>";
                                    }
                                    echo $cadena_auto;
                                    ?>
                                </select><br/>

                                <?php
                                //SI SOLO HAY UN MODEM SIEMPRE ENVIA ' ', ES DECIR, TODOS
                                $device= Sms::count_device();
                                $nodevice= true;
                                if (is_array($device)) {
                                    if(count($device) > 1) {
                                        $nodevice= false;
                                        $cadena_mod= "<br/>Modems asisgnados:&nbsp;<br/>";
                                        for ($i = 0; $i < count($device); $i++) {
                                            $cadena_mod .= "<input type='checkbox' checked class='auto_unico_modem' name='sms[aplicaciones][mensajes_externos][autorizados][unico][modems][]' value='".$device[$i]['id']."'>&nbsp;<font style='vertical-align: top'>".$device[$i]['id']."</font><br/>";
                                        }
                                        echo $cadena_mod.' ';
                                    }else {
                                        $nodevice= true;
                                        $cadena_mod= "<input type='hidden' name='sms[aplicaciones][mensajes_externos][autorizados][unico][modems][]' value='' />";
                                        echo $cadena_mod.'<br/>';
                                    }
                                }else {
                                    $nodevice = true;
                                    $cadena_mod = "<input type='hidden' name='sms[aplicaciones][mensajes_externos][autorizados][unico][modems][]' value='' />";
                                    echo $cadena_mod . '<br/>';
                                }
                                ?>

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a class='partial_new_view partial' href="#" onclick="javascript: fn_agregar_cargo('<?php echo $aplicacion;?>' , '<?php echo $nodevice; ?>'); return false;">Agregar otro</a><br/><br/>

                                <table name="otros" id="<?php echo $aplicacion;?>" class="lista">
                                <tbody>
                                    <?php
                                    $count_delete_cargo= 0;
                                    $i= 0;
                                        if(isset($sf_sms['aplicaciones'][$aplicacion]['autorizados']['otros'])) {
                                            for ($i= 0; $i < count($sf_sms['aplicaciones'][$aplicacion]['autorizados']['otros']); $i++) {
                                                foreach ($sf_organigramas as $organismos) {
                                                            if ($organismos->getId() == $sf_sms['aplicaciones'][$aplicacion]['autorizados']['otros'][$i]['dato']) {
                                                                $cadena = "<tr>";
                                                                $cadena .= "<td><font class='f16b'>" . $organismos->getNombre() . "</font><br/>";
                                                                $finalcoma= 0;
                                                                foreach ($sf_sms['aplicaciones'][$aplicacion]['autorizados']['otros'][$i]['modems'] as $modemsx) {
                                                                    $cadena .= "<font class='f11n'>" . $modemsx . "</font>";
                                                                    $finalcoma++;
                                                                    $cadena .= (count($sf_sms['aplicaciones'][$aplicacion]['autorizados']['otros'][$i]['modems'])== $finalcoma) ? '' : ', ';
                                                                    $cadena .= "<input name='sms[aplicaciones][mensajes_externos][autorizados][otros][" . $i . "][modems][]' type='hidden' value='" . $modemsx . "' />";
                                                                }
                                                                $cadena .= "<input name='sms[aplicaciones][mensajes_externos][autorizados][otros][" . $i . "][dato]' type='hidden' value='" . $sf_sms['aplicaciones'][$aplicacion]['autorizados']['otros'][$i]['dato'] . "'/></td>";
                                                                $cadena .= "<td><a class='elimina' style='cursor: pointer;'><img src='/images/icon/delete.png'/></a></td>";
                                                                $cadena .= "<tr/>";
                                                                echo $cadena;
                                                            }
                                                }
                                            }
                                        }
                                        if (isset($sf_sms['aplicaciones'][$aplicacion]['autorizados']['unico']['dato'])){
                                            foreach ($sf_organigramas as $organismos) {
                                                    if ($organismos->getId() == $sf_sms['aplicaciones'][$aplicacion]['autorizados']['unico']['dato']) {
                                                        $nombre_unidad= $organismos->getNombre();
                                                    }
                                            }
                                            $cadena = "<tr>";
                                            $cadena .= "<td><font class='f16b'>" . $nombre_unidad . "</font><br/>";
                                            $finalcoma = 0;
                                            foreach ($sf_sms['aplicaciones'][$aplicacion]['autorizados']['unico']['modems'] as $modems) {
                                                $cadena .= "<font class='f11n'>" . $modems . "</font>";
                                                $finalcoma++;
                                                $cadena .= (count($sf_sms['aplicaciones'][$aplicacion]['autorizados']['unico']['modems']) == $finalcoma) ? '' : ', ';
                                                $cadena .= "<input name='sms[aplicaciones][$aplicacion][autorizados][otros][" . $i . "][modems][]' type='hidden' value='" . $modems . "' />";
                                            }
                                            $cadena .= "<input name='sms[aplicaciones][$aplicacion][autorizados][otros][" . $i . "][dato]' type='hidden' value='" . $sf_sms['aplicaciones'][$aplicacion]['autorizados']['unico']['dato'] . "'/></td>";
                                            $cadena .= "<td><a class='elimina' style='cursor: pointer;'><img src='/images/icon/delete.png'/></a></td>";
                                            $cadena .= "<tr/>";
                                            echo $cadena;
                                            $i++;
                                        }
                                        $count_delete_cargo= $i;
                                        echo "<input type='hidden' id='count_delete_cargo' value='" . $count_delete_cargo . "'";
                                    ?>
                                </tbody>
                                </table>
                                <hr>
                                <input <?php echo ($sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['activo']) == 'true' ? 'checked': ''; ?> type="checkbox" name="sms[aplicaciones][<?php echo $aplicacion; ?>][autorizados_particulares][activo]" value="true" onClick="javascript: fn_conmutar()" id="particulares">&nbsp;Autorizar funcionares espec&iacute;ficos
                            </td>
                        </tr>
                        <tr id="tr_particulares" style="display: <?php echo ($sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['activo']) == 'true' ? '': 'none'; ?>">
                            <td width="110"><b>Autorizados Particulares</b></td>
                            <td>
                                Unidades:<br />
                                    <select name="sms[aplicaciones][<?php echo $aplicacion; ?>][autorizados_particulares][unico][unidad]" id="autorizados_particulares_unidad_id" onchange="
                                        <?php
                                        echo jq_remote_function(array('update' => 'div_funcionarios_autorizados',
                                                                'url' => 'configuracion/particularesAutorizados',
                                                                'with' => "'unidad_id=' +this.value",))
                                        ?>">

                                        <?php
                                        foreach ($unidades as $clave => $valor) {
                                            $list_id = explode("&&", $clave); ?>
                                            <option value="<?php echo $list_id[0]; ?>">
                                            <?php echo html_entity_decode($valor); ?>
                                            </option>
                                            <?php } ?>
                                    </select>

                                    <div id="div_funcionarios_autorizados">
                                        <br />Funcionarios:<br />
                                        <select name="sms[aplicaciones][<?php echo $aplicacion; ?>][autorizados_particulares][unico][funcionario]" id="autorizados_particulares_funcionario_id">
                                            <option value=""></option>
                                        </select>
                                        </div>

                                        <div>
                                        <table id="grilla" class="lista">
                                            <tbody>
                                                <?php
                                                $count_delete_particular= 0;
                                                $i= 0;
                                                if (isset($sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['otros'])){
                                                    for ($i= 0; $i < count($sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['otros']); $i++) {
                                                            list($unidad_id, $funcionario_id) = explode('#', $sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['otros'][$i]['dato']);

                                                            $otros = Doctrine::getTable('Funcionarios_FuncionarioCargo')->unidadCargoFuncionario($unidad_id, $funcionario_id);

                                                            if(count($otros)>0){
                                                                $funcionario_nombre = $otros[0]['primer_nombre'] . ' ';
                                                                $funcionario_nombre .= $otros[0]['segundo_nombre'] . ', ';
                                                                $funcionario_nombre .= $otros[0]['primer_apellido'] . ' ';
                                                                $funcionario_nombre .= $otros[0]['segundo_apellido'];

                                                                $cadena = "<tr>";
                                                                $cadena .= "<td><font class='f16b'>" . $otros[0]['unidad'] . "</font><br/>";
                                                                $cadena .= "<font class='f16n'>" . $otros[0]['ctnombre'] . " / " . $funcionario_nombre . "</font><br/>";
                                                                $finalcoma= 0;
                                                                foreach ($sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['otros'][$i]['modems'] as $modems) {
                                                                    $cadena .= "<font class='f11n'>" . $modems . "</font>";
                                                                    $finalcoma++;
                                                                    $cadena .= (count($sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['otros'][$i]['modems'])== $finalcoma) ? '' : ', ';
                                                                    $cadena .= " <input name='sms[aplicaciones][mensajes_externos][autorizados_particulares][otros][" . $i . "][modems][]' type='hidden' value='" . $modems . "' /> ";
                                                                }
                                                                $cadena .= "<input name='sms[aplicaciones][mensajes_externos][autorizados_particulares][otros][" . $i . "][dato]' type='hidden' value='" . $unidad_id . "#" . $funcionario_id . "'/>" . "</td>";
                                                                $cadena .= "<td><a class='elimina' style='cursor: pointer;'><img src='/images/icon/delete.png'/></a></td>";
                                                                $cadena .= "</tr>";
                                                                echo $cadena;
                                                            }
                                                    }

                                                }
                                                if (isset($sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['unico'])){
                                                    list($unidad_id, $funcionario_id) = explode('#', $sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['unico']['dato']);
                                                    $otros = Doctrine::getTable('Funcionarios_FuncionarioCargo')->unidadCargoFuncionario($unidad_id, $funcionario_id);

                                                    if(count($otros)>0){
                                                        $funcionario_nombre = $otros[0]['primer_nombre'] . ' ';
                                                        $funcionario_nombre .= $otros[0]['segundo_nombre'] . ', ';
                                                        $funcionario_nombre .= $otros[0]['primer_apellido'] . ' ';
                                                        $funcionario_nombre .= $otros[0]['segundo_apellido'];

                                                        $cadena = "<tr>";
                                                        $cadena .= "<td><font class='f16b'>" . $otros[0]['unidad'] . "</font><br/>";
                                                        $cadena .= "<font class='f16n'>" . $otros[0]['ctnombre'] . " / " . $funcionario_nombre . "</font><br/>";
                                                        $finalcoma= 0;
                                                        foreach ($sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['unico']['modems'] as $modems) {
                                                            $cadena .= "<font class='f11n'>" . $modems . "</font>";
                                                            $finalcoma++;
                                                            $cadena .= (count($sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['unico']['modems']) == $finalcoma) ? '' : ', ';
                                                            $cadena .= " <input name='sms[aplicaciones][mensajes_externos][autorizados_particulares][otros][" . $i . "][modems][]' type='hidden' value='" . $modems . "' /> ";
                                                        }
                                                        $cadena .= "<input name='sms[aplicaciones][mensajes_externos][autorizados_particulares][otros][" . $i . "][dato]' type='hidden' value='" . $unidad_id . "#" . $funcionario_id . "'/>" . "</td>";
                                                        $cadena .= "<td><a class='elimina' style='cursor: pointer;'><img src='/images/icon/delete.png'/></a></td>";
                                                        $cadena .= "</tr>";
                                                        echo $cadena;
                                                        $i++;
                                                    }
                                                }
                                                $count_delete_particular= $i;
                                                echo "<input type='hidden' id='count_delete_particular' value='" . $count_delete_particular . "'";
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                        </tr>
                    </table>
                    <br/>
                <?php
                endif;
                } ?>
            </div>
        </div>
    </div>

    <ul class="sf_admin_actions">
        <?php
        $masdeuno= false;
        if(count($device) > 1) {
            $masdeuno= true;
        }
         ?>
        <li class="sf_admin_action_save">
            <button id="guardar_documento" onClick="javascript: validate_modems('<?php echo $masdeuno; ?>'); return false;" style="height: 35px; margin-left: 130px">
                <?php echo image_tag('icon/filesave.png', array('style'=> 'vertical-align: middle')) ?>&nbsp;<strong>Guardar cambios</strong>
            </button>
        </li>
    </ul>

    </form>
</fieldset>