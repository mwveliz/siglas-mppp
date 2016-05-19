<?php echo ($device == 'no_conn') ? 'Sin conexión a Base de Datos Gammu...' : 'Dispositivos Conectados:<hr>'; ?>
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
                            <td><font style="color: #383737 "><?php echo (($device[$i]['id'] == '')? 'modem'.($i+1) : $device[$i]['id']) ?></font></td>
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
                }elseif ($device != 'no_conn') {
                    ?>
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
//if ($device != 'no_conn' && $device != '') {
//    echo 'Capacidad de envío: ';
//    $capacidad = 0;
//    $capacidad = count($device) * 200;
//    echo $capacidad . ' Mensajes simultaneos';
//}
?>
<!--<input type="hidden" name="sms[capacidad]" value="<?php echo $capacidad ?>">
<br/>-->
<font style='font-size: 10px; color: #777'>Si ha realizado cambios en el hardware actualice la información</font><br/><br>