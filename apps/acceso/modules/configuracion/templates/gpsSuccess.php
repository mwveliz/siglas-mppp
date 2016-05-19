<script>
    $(document).ready(function(){
        $("form").submit(function() {
            if($("#admin_movil").val())
                fn_agregar();
            
            return true;
        });
    });
    
    function fn_agregar(){
        if($("#admin_movil").val())
        {
            if((/^\d{7,7}$/.test($("#admin_movil").val()))) {
                i= $("#tlf_guardados tbody").find("tr").length;
                cadena = "<tr>";
                cadena = cadena + "<td><font class='f17b'>" + jQuery.trim($("#codigo_movil option:selected").text())+"-"+$("#admin_movil").val() + "</font><br/>";
                cadena = cadena + "<input name='gps[tlf][otros]["+i+"]' type='hidden' value='" + $("#codigo_movil").val() + $("#admin_movil").val() + "'/>" + "</td>";
                cadena = cadena + "<td><a class='elimina' style='cursor: pointer;'><img src='/images/icon/delete.png'/></a></td>";
                $("#tlf_guardados tbody").append(cadena);
                $('#archivo').val('');
                $('#admin_movil').val('');
                fn_dar_eliminar();
                fn_cantidad();
            }else{
                alert('El número no es correcto');
            }
        }
        else
        { alert('Debe escribir un número telefónico valido para agregar otro.'); }
    }
    
    function fn_cantidad(){
            cantidad = $("#tlf_guardados tbody").find("tr").length;
            $("#span_cantidad").html(cantidad);
    };    

    function fn_dar_eliminar(){
        $("a.elimina").click(function(){
            $(this).parent().parent().fadeOut("normal", function(){
                    $(this).remove();
                })
        });
    };
    
    function fn_conExcel(){
        $("#admin_movil").removeClass('required');
    }
    
    function change_selector_time() {
        var type_time= $('#selector_time').val();
        if(type_time === 's') {
            $('#frecuencia_activo_segundos').show();
            $('#frecuencia_activo_minutos').hide();
            $('#frecuencia_activo_horas').hide();
        }else {
            if(type_time === 'm') {
                $('#frecuencia_activo_segundos').hide();
                $('#frecuencia_activo_minutos').show();
                $('#frecuencia_activo_horas').hide();
            }else {
                if(type_time === 'h') {
                    $('#frecuencia_activo_segundos').hide();
                    $('#frecuencia_activo_minutos').hide();
                    $('#frecuencia_activo_horas').show();
                }
            }
        }
    }
</script>
<fieldset id="sf_fieldset_gps">
    <?php
    $frecuancia_activo= $sf_gps['recuperacion']['frecuencia_activo'];
    $frecuancia_inactivo= $sf_gps['recuperacion']['frecuencia_inactivo'];
    list($f_act_time, $f_act_type)= explode('#', $frecuancia_activo);
    list($f_inact_time, $f_inact_type)= explode('#', $frecuancia_inactivo);
    ?>
    <form method="post" action="<?php echo sfConfig::get('sf_app_acceso_url').'configuracion/saveGps'; ?>"> 
    <h2>Tracker GPS (Sistema de Posicionamiento Global)</h2>
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Estatus</label>
            <div class="content">
                <input type="radio" name="gps[activo]" value=true <?php if($sf_gps['activo'] == true) echo "checked"; ?>/> Activo&nbsp;&nbsp;&nbsp;
                <input type="radio" name="gps[activo]" value=false <?php if($sf_gps['activo'] == false) echo "checked"; ?>/> Inactivo
            </div>
        </div>
    </div>
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="telefonos_id">Administradores</label>
            <div class="content">
                <select name="codigo_movil" id="codigo_movil">
                    <option value="0412">0412</option>
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                </select>
                <input id="admin_movil" name="gps[tlf][unico]" value="" />
            </div>
            <div class="help">Seleccione el codigo y escriba el n&uacute;mero telef&oacute;nico asignado a SIGLAS.</div>
        </div>
    </div>

    <div class="sf_admin_form_row sf_admin_text">
        <div class="content">

            <a class='partial_new_view partial' href="#" onClick="javascript: fn_agregar(); return false;">Agregar otro administrador</a>  
            <div style="padding-left: 0px; color: #aaa;">Si posee mas de un modem asignado a SIGLAS, agregue el n&uacute;mero como otro administrador.</div>
            <div style="max-height: 200px; overflow-y: auto; overflow-x: hidden; width: 300px;">
                <table id="tlf_guardados" width="150">
                <tbody>
                <?php 
                $td = ''; $k = 0;
                $gps_conf = sfYaml::load(sfConfig::get("sf_root_dir")."/config/siglas/gps.yml");

                foreach ($gps_conf['administradores'] as $variable) {
                    $td .= "<tr>";
                    $td .= "<td>".$variable."</td>";

                    $td .= '<td>
                                <input name="gps[tlf][otros]['.$k.']" type="hidden" value="'.$variable.'"/>
                                <a class="elimina" style="cursor: pointer;">
                                    <img src="/images/icon/delete.png"/>
                                </a>
                            </td>';
                    $td .= "</tr>";
                    $k++;
                }

                echo $td;
                echo "<script>
                        fn_dar_eliminar(); 
                        fn_cantidad(); 
                    </script>";
                ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Tracking</label>
            <div class="content">
                    <table width="600">
                        <tr>
                            <th colspan="2"><b>Recuperaci&oacute;n de Informaci&oacute;n de rastreo</b></th>
                        </tr>
                        <tr>
                            <td>
                                <b>Frecuencia activo:&nbsp;</b>
                                <select id="frecuencia_activo_segundos" style="display: <?php echo ($f_act_type== 's')? 'inline': 'none'; ?>" name="gps[recuperacion][frecuencia_activo_s]">
                                    <option value="20#s" <?php echo (($f_act_time== 20)? 'selected' : '') ?>>20</option>
                                    <option value="40#s" <?php echo (($f_act_time== 40)? 'selected' : '') ?>>40</option>
                                    <option value="60#s" <?php echo (($f_act_time== 60)? 'selected' : '') ?>>60</option>
                                </select>
                                <select id="frecuencia_activo_minutos" style="display: <?php echo ($f_act_type== 'm')? 'inline': 'none'; ?>" name="gps[recuperacion][frecuencia_activo_m]">
                                    <option value="300#m" <?php echo (($f_act_time== 300)? 'selected' : '') ?>>5</option>
                                    <option value="600#m" <?php echo (($f_act_time== 600)? 'selected' : '') ?>>10</option>
                                    <option value="1800#m" <?php echo (($f_act_time== 1800)? 'selected' : '') ?>>30</option>
                                </select>
                                <select id="frecuencia_activo_horas" style="display: <?php echo ($f_act_type== 'h')? 'inline': 'none'; ?>" name="gps[recuperacion][frecuencia_activo_h]">
                                    <option value="3600#h" <?php echo (($f_act_time== 3600)? 'selected' : '') ?>>1</option>
                                </select>
                                &nbsp;&nbsp;
                                <select id="selector_time" name="gps[recuperacion][frecuencia_activo_selector]" onChange="change_selector_time()">
                                    <option value="s" <?php echo (($f_act_type== 's')? 'selected' : '') ?>>Segundos</option>
                                    <option value="m" <?php echo (($f_act_type== 'm')? 'selected' : '') ?>>Minutos</option>
                                    <option value="h" <?php echo (($f_act_type== 'h')? 'selected' : '') ?>>Horas</option>
                                </select>
                                <p class="help" style="margin-left: 9em">Una frecuencia mayor a 60 segundos, podria generar un seguimiento ineficiente, pero el costo del servicio del operador telef&oacute;nico ser&aacute;a mucho menor.</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Frecuencia inactivo:&nbsp;</b>
                                <select name="gps[recuperacion][frecuencia_inactivo]">
                                    <?php for($i=1; $i <= 12; $i++)
                                        echo ('<option value="'. $i .'#h" '. (($f_inact_time== $i)? 'selected' : '') .'>'. $i .'</option>'); ?>
                                </select>&nbsp;<?php echo ($f_inact_type== 's')? 'Segundos' : 'Horas' ?>
                            </td>
                        </tr>
                    </table>
                    <br/>
            </div>
        </div>
    </div>
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Alertas</label>
            <div class="content">
                    <table width="600">
                        <tr>
                            <th colspan="2"><b>Recuperaci&oacute;n de Informaci&oacute;n de alertas</b></th>
                        </tr>
                        <tr>
                            <td><b>Estatus:&nbsp;</b>
                            <input type="radio" name="gps[alertas][status]" value=true <?php echo ($sf_gps['alertas']['status'] == true)? "checked" : ""; ?>/> Activo&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="gps[alertas][status]" value=false <?php echo ($sf_gps['alertas']['status'] == false)? "checked" : "" ; ?>/> Inactivo
                            </td>
                        </tr>
                    </table>
                    <br/>
            </div>
        </div>
    </div>
    
    
    <ul class="sf_admin_actions">
        <li class="sf_admin_action_save">
            <button id="guardar_documento" onClick="javascript: this.form.submit();" style="height: 35px; margin-left: 130px">
                <?php echo image_tag('icon/filesave.png', array('style' => 'vertical-align: middle')) ?>&nbsp;<strong>Guardar cambios</strong>
            </button>
        </li>
    </ul>

    </form>         
</fieldset>