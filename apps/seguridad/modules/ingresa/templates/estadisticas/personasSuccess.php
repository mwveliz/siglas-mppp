<?php 
$visitas = $estadistica_datos;
$total_personas = 0;
$total_visitas = 0;
$tiempo_estadia_maximo = 0;
$tiempo_estadia_minimo = 0;
$tiempo_estadia_promedio = 0;
?>

<div style="position: relative;">
    <div id="sf_admin_content">        
        <fieldset><h2>CANTIDAD DE VISITAS POR PERSONA</h2></fieldset>
        <br/>

        <table style="width: 100%;">
            <?php  foreach ($visitas as $persona) { ?>
            <tr class="sf_admin_row">
                <td>
                    <div style="position: relative; height: 150px;">
                        <div style="position: absolute; left: 130px; top: 0px;">
                            <b>Cantidad de visitas: <?php echo $persona['total']; ?></b><br/>
                            Cédula: <?php echo $persona['ci']; ?><br/>
                            Nombre: <?php echo $persona['nombre'].' '.$persona['apellido']; ?><br/>
                        </div>
                        <div id="other_visit_<?php echo $persona['ci']; ?>" style="position: absolute; right: 0px; bottom: 0px; max-height: 74px; max-width: 450px; overflow-y: auto; overflow-x: hidden;"></div>

                        <?php $i=0; foreach ($persona['visitas'] as $visita) { ?>
                            <?php if($i==0){ ?>
                                <div style="position: absolute; left: 0px; top: 0px;">
                                    <img src="/uploads/seguridad/<?php echo $visita['foto']; ?>" height="145"/>
                                </div>
                                <div style="position: absolute; left: 130px; top: 65px;">
                                    <b>Ultima visita:</b><br/>
                                    Desde <?php echo date('d-m-Y h:i:s A', strtotime($visita['f_ingreso'])); ?> hasta <?php echo date('d-m-Y h:i:s A', strtotime($visita['f_egreso'])); ?><br/>
                                    <?php
                                    $f_ingreso = new DateTime($visita['f_ingreso']);
                                    $f_egreso = new DateTime($visita['f_egreso']);
                                    $interval = $f_ingreso->diff($f_egreso);
                                    $years = $interval->format('%y');
                                    $months = $interval->format('%m');
                                    $days = $interval->format('%d'); 
                                    $hour = $interval->format('%h'); 
                                    $minute = $interval->format('%i'); 
                                    $second = $interval->format('%s');
                                    
                                    echo 'Estadia de ';
                                    if($years>0) { echo $years; echo ($years==1) ? ' año con ' : ' años con '; }
                                    if($months>0) { echo $months; echo ($months==1) ? ' mes con ' : ' meses con '; }
                                    if($days>0) { echo $days; echo ($days==1) ? ' día con ' : ' días con '; }
                                    if($hour>0) { echo $hour; echo ($hour==1) ? ' hora con ' : ' horas con '; }
                                    if($minute>0) { echo $minute; echo ($minute==1) ? ' minuto y ' : ' minutos con '; }
                                    if($second>0) { echo $second; echo ($second==1) ? ' segundo.' : ' segundos.'; }            
                                    
                                    $segundos_total = strtotime($visita['f_egreso']) - strtotime($visita['f_ingreso']);
                                    ?>
                                    <br/>
                                    Unidad: <?php echo $visita['unidad']; ?><br/>
                                    Motivo: <?php echo $visita['motivo']; ?><br/>
                                </div>
                            <?php } else { ?>
                                <img src="/uploads/seguridad/<?php echo $visita['foto']; ?>" height="70" id="new_other_visit_<?php echo $persona['ci'].'_'.$i; ?>" class="tooltip" title="Desde <?php echo date('d-m-Y h:i:s A', strtotime($visita['f_ingreso'])); ?> hasta <?php echo date('d-m-Y h:i:s A', strtotime($visita['f_egreso'])); ?>
<?php
$f_ingreso = new DateTime($visita['f_ingreso']);
$f_egreso = new DateTime($visita['f_egreso']);
$interval = $f_ingreso->diff($f_egreso);
$years = $interval->format('%y');
$months = $interval->format('%m');
$days = $interval->format('%d'); 
$hour = $interval->format('%h'); 
$minute = $interval->format('%i'); 
$second = $interval->format('%s');?>

Estadia de <?php 
if($years>0) { echo $years; echo ($years==1) ? ' año con ' : ' años con '; }
if($months>0) { echo $months; echo ($months==1) ? ' mes con ' : ' meses con '; }
if($days>0) { echo $days; echo ($days==1) ? ' día con ' : ' días con '; }
if($hour>0) { echo $hour; echo ($hour==1) ? ' hora con ' : ' horas con '; }
if($minute>0) { echo $minute; echo ($minute==1) ? ' minuto y ' : ' minutos y '; }
if($second>0) { echo $second; echo ($second==1) ? ' segundo.' : ' segundos.'; }            

$segundos_total = $segundos_total + (strtotime($visita['f_egreso']) - strtotime($visita['f_ingreso']));
?>

Unidad: <?php echo $visita['unidad']; ?>

Motivo: <?php echo $visita['motivo']; ?>"
                                />
                                <script>
                                    $('#new_other_visit_<?php echo $persona['ci'].'_'.$i; ?>').appendTo('#other_visit_<?php echo $persona['ci']; ?>');
                                    $('#other_visit_<?php echo $persona['ci']; ?>').append('&nbsp;');
                                </script>
                            <?php } ?>
                        <?php $i++; } ?>
                        <div style="position: absolute; top: 0px; right: 0px; text-align: right;">
                            Tiempo total en la institución: 
                            <?php 
                                $dias = floor($segundos_total / 86400);
                                $horas = floor(($segundos_total - ($dias * 86400)) / 3600);
                                $minutos = floor(($segundos_total - ($dias * 86400) - ($horas * 3600)) / 60);
                                $segundos = $segundos_total % 60;

                                if($dias>0) { echo $dias; echo ($dias==1) ? ' día con ' : ' días con '; }
                                if($horas>0) { echo $horas; echo ($horas==1) ? ' hora con ' : ' horas con '; }
                                if($minutos>0) { echo $minutos; echo ($minutos==1) ? ' minuto y ' : ' minutos y '; }
                                if($segundos>0) { echo $segundos; echo ($segundos==1) ? ' segundo.' : ' segundos.'; }    
                            ?><br/>
                            Promedio de tiempo por visita: 
                            <?php 
                                $segundos_promedio = round($segundos_total/$persona['total']);
                                $dias = floor($segundos_promedio / 86400);
                                $horas = floor(($segundos_promedio - ($dias * 86400)) / 3600);
                                $minutos = floor(($segundos_promedio - ($dias * 86400) - ($horas * 3600)) / 60);
                                $segundos = $segundos_promedio % 60;

                                if($dias>0) { echo $dias; echo ($dias==1) ? ' día con ' : ' días con '; }
                                if($horas>0) { echo $horas; echo ($horas==1) ? ' hora con ' : ' horas con '; }
                                if($minutos>0) { echo $minutos; echo ($minutos==1) ? ' minuto y ' : ' minutos y '; }
                                if($segundos>0) { echo $segundos; echo ($segundos==1) ? ' segundo.' : ' segundos.'; }    
                            ?>
                        </div>
                    </div>
                </td>
            </tr>
            <?php } ?>
      </table>

    </div>
    <div id="sf_admin_footer"> </div>
</div>