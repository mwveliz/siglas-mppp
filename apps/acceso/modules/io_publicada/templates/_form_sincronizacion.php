<script>
    function toogle_frecuencia()
    {
        if($('#siglas_servicios_publicados_tipo').val()=='consulta'){
            $('#div_crontab').hide();
        } else {
            $('#div_crontab').show();
        }
    }
</script>

<div class="sf_admin_form_row sf_admin_text sf_admin_form_field_tipo">
    <div>
        <label for="siglas_servicios_publicados_tipo">Tipo</label>
        <div class="content">
            <select id="siglas_servicios_publicados_tipo" name="siglas_servicios_publicados[tipo]" onchange="toogle_frecuencia();">
                <option value="consulta" <?php if(!$form->isNew()) { if($form['tipo']->getValue() == 'consulta') { echo "selected"; } } ?>>Consulta</option>
                <option value="actualizacion" <?php if(!$form->isNew()) { if($form['tipo']->getValue() == 'actualizacion') { echo "selected"; } } ?>>Actualización</option>
            </select>
        </div>
        <div class="help">
            <b><i><u>Consulta</u></i></b>: Se activa el servicio para que los clientes soliciten a este servidor datos cuando ellos lo desean.<br/>
            <b><i><u>Actualización</u></i></b>: Se activa el servicio para que el servidor envíe frecuentemente datos al cliente mediante crontab.
        </div>
    </div>
</div>

<div id="div_crontab" class="sf_admin_form_row sf_admin_text sf_admin_form_field_crontab" style="display: none;">
    <div>
        <label for="siglas_servicios_publicados_crontab">Crontab</label>
        <div class="content">
            
            <?php 
                if(!$form->isNew()) { 
                    if($form['crontab']->getValue() != 'false') { 
                        list($crontab_minuto, $crontab_hora, $crontab_dia_mes, $crontab_mes, $crontab_dia_semana) = explode(' ',$form['crontab']->getValue());
                    } else {
                        $crontab_minuto='#'; 
                        $crontab_hora='#'; 
                        $crontab_dia_mes='#'; 
                        $crontab_mes='#'; 
                        $crontab_dia_semana='#'; 
                    }
                } 
            ?>
            
            <table>
                <tr>
                    <th>Minutos</th>
                    <th>Horas</th>
                    <th>Día del Mes</th>
                    <th>Mes</th>
                    <th>Día de Semana</th>
                </tr>
                <tr>
                    <td>
                        <select id="crontab_minuto" name="frecuencia_crontab[minuto]">
                            <option value="*" <?php if(!$form->isNew()) { if($crontab_minuto == "*") { echo "selected"; } } ?>>Todos los minutos</option>
                            <?php for($i=0;$i<=59;$i++){ $i_char = ''.$i; ?>
                                <option value="<?php echo  $i; ?>" <?php if(!$form->isNew()) { if($crontab_minuto == $i_char) { echo "selected"; } } ?>><?php echo  $i; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <select id="crontab_hora" name="frecuencia_crontab[hora]">
                            <option value="*" <?php if(!$form->isNew()) { if($crontab_hora == '*') { echo "selected"; } } ?>>Todas las horas</option>                            
                            <?php for($i=0;$i<=23;$i++){ $i_char = ''.$i; ?>
                                <option value="<?php echo  $i; ?>" <?php if(!$form->isNew()) { if($crontab_hora == $i_char) { echo "selected"; } } ?>><?php echo  $i; if($i==0) echo ' AM'; if($i==12) echo ' PM'; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <select id="crontab_dia_mes" name="frecuencia_crontab[dia_mes]">
                            <option value="*" <?php if(!$form->isNew()) { if($crontab_dia_mes == '*') { echo "selected"; } } ?>>Todos los dias</option>
                            <?php for($i=1;$i<=31;$i++){ $i_char = ''.$i; ?>
                                <option value="<?php echo  $i; ?>" <?php if(!$form->isNew()) { if($crontab_dia_mes == $i_char) { echo "selected"; } } ?>><?php echo  $i; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <select id="crontab_mes" name="frecuencia_crontab[mes]">
                            <option value="*" <?php if(!$form->isNew()) { if($crontab_mes == '*') { echo "selected"; } } ?>>Todos los meses</option>
                            <optgroup label="Meses individuales">
                                <option value="1" <?php if(!$form->isNew()) { if($crontab_mes == '1') { echo "selected"; } } ?>>Eneros</option>
                                <option value="2" <?php if(!$form->isNew()) { if($crontab_mes == '2') { echo "selected"; } } ?>>Febreros</option>
                                <option value="3" <?php if(!$form->isNew()) { if($crontab_mes == '3') { echo "selected"; } } ?>>Marzos</option>
                                <option value="4" <?php if(!$form->isNew()) { if($crontab_mes == '4') { echo "selected"; } } ?>>Abriles</option>
                                <option value="5" <?php if(!$form->isNew()) { if($crontab_mes == '5') { echo "selected"; } } ?>>Mayos</option>
                                <option value="6" <?php if(!$form->isNew()) { if($crontab_mes == '6') { echo "selected"; } } ?>>Junios</option>
                                <option value="7" <?php if(!$form->isNew()) { if($crontab_mes == '7') { echo "selected"; } } ?>>Julios</option>
                                <option value="8" <?php if(!$form->isNew()) { if($crontab_mes == '8') { echo "selected"; } } ?>>Agostos</option>
                                <option value="9" <?php if(!$form->isNew()) { if($crontab_mes == '9') { echo "selected"; } } ?>>Septiembres</option>
                                <option value="10" <?php if(!$form->isNew()) { if($crontab_mes == '10') { echo "selected"; } } ?>>Octubres</option>
                                <option value="11" <?php if(!$form->isNew()) { if($crontab_mes == '11') { echo "selected"; } } ?>>Noviembres</option>
                                <option value="12" <?php if(!$form->isNew()) { if($crontab_mes == '12') { echo "selected"; } } ?>>Diciembres</option>
                            </optgroup>
                            <optgroup label="Meses agrupados">
                                <option value="1,3,5,7,9,11" <?php if(!$form->isNew()) { if($crontab_mes == '1,3,5,7,9,11') { echo "selected"; } } ?>>Meses impares</option>
                                <option value="2,4,6,8,10,12" <?php if(!$form->isNew()) { if($crontab_mes == '2,4,6,8,10,12') { echo "selected"; } } ?>>Meses pares</option>
                                <option value="1,4,7,10" <?php if(!$form->isNew()) { if($crontab_mes == '1,4,7,10') { echo "selected"; } } ?>>Trimestral</option>
                                <option value="1,7" <?php if(!$form->isNew()) { if($crontab_mes == '1,7') { echo "selected"; } } ?>>Semestral</option>
                            </optgroup>
                        </select>
                    </td>
                    <td>
                        <select id="crontab_dia_semana" name="frecuencia_crontab[dia_semana]">
                            <option value="*" <?php if(!$form->isNew()) { if($crontab_dia_semana == '*') { echo "selected"; } } ?>>Toda la semana</option>
                            <optgroup label="Dias individuales">
                                <option value="1" <?php if(!$form->isNew()) { if($crontab_dia_semana == '1') { echo "selected"; } } ?>>Lunes</option>
                                <option value="2" <?php if(!$form->isNew()) { if($crontab_dia_semana == '2') { echo "selected"; } } ?>>Martes</option>
                                <option value="3" <?php if(!$form->isNew()) { if($crontab_dia_semana == '3') { echo "selected"; } } ?>>Miercoles</option>
                                <option value="4" <?php if(!$form->isNew()) { if($crontab_dia_semana == '4') { echo "selected"; } } ?>>Jueves</option>
                                <option value="5" <?php if(!$form->isNew()) { if($crontab_dia_semana == '5') { echo "selected"; } } ?>>Viernes</option>
                                <option value="6" <?php if(!$form->isNew()) { if($crontab_dia_semana == '6') { echo "selected"; } } ?>>Sabados</option>
                                <option value="0" <?php if(!$form->isNew()) { if($crontab_dia_semana == '0') { echo "selected"; } } ?>>Domingos</option>
                            </optgroup>
                            <optgroup label="Dias agrupados">
                                <option value="1-5" <?php if(!$form->isNew()) { if($crontab_dia_semana == '1-5') { echo "selected"; } } ?>>Lunes a Viernes</option>
                                <option value="1,3,5" <?php if(!$form->isNew()) { if($crontab_dia_semana == '1,3,5') { echo "selected"; } } ?>>Lunes, Miercoles y Viernes</option>
                                <option value="2,4,6" <?php if(!$form->isNew()) { if($crontab_dia_semana == '2,4,6') { echo "selected"; } } ?>>Martes, Jueves y Sabados</option>
                                <option value="0,6" <?php if(!$form->isNew()) { if($crontab_dia_semana == '0,6') { echo "selected"; } } ?>>Sabados y Domingos</option>
                            </optgroup>
                        </select>
                    </td>
                </tr>
            </table>

        </div>
        <div class="help">
            Seleccione el conjunto de la frecuencia con que desea que el servidor envie datos a los clientes del web service.
        </div>
    </div>
</div>

<script>toogle_frecuencia();</script>