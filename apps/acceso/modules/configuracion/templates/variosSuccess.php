<?php use_helper('jQuery'); ?>

<script>
    $(document).ready(function(){
        fn_dar_eliminar();
    });
    
    function fn_agregar_fecha(){
        if($("#fecha_day").val()!=null && $("#descripcion").val()!=null)
        {
            var check = 'f';
            if($("#repetir").is(':checked')) {  
                check = 't';
            }
            
            if(parseInt($("#fecha_day").val())<10) { dia = '0'+$("#fecha_day").val(); } else { dia = $("#fecha_day").val(); }
            if(parseInt($("#fecha_month").val())<10) { mes = '0'+$("#fecha_month").val(); } else { mes = $("#fecha_month").val(); }
            
            cadena = "<tr>";
            cadena = cadena + "<td><font class='f16b'>" + dia + '-' + mes + '-' + $("#fecha_year").val() + "</font><br/>";
            cadena = cadena + "<input name='varios[dias_no_laborables][" + $("#fecha_year").val() + '-' + mes + '-' + dia + "]' type='hidden' value='" + $("#descripcion").val() +  '#' + check + "'/>" + "</td>";
            cadena = cadena + "<td>" + $("#descripcion").val() + "</td>";
            cadena = cadena + "<td><a class='elimina' style='cursor: pointer;'><img src='/images/icon/delete.png'/></a></td></tr>";
            $("#fechas_procesadas").append(cadena);
            fn_dar_eliminar();
        }
        else
        { alert('Debe seleccionar una fecha y escribir su descripción para poder agregar otro'); }
    };

    function fn_dar_eliminar(){
        $("a.elimina").click(function(){
            $(this).parent().parent().fadeOut("normal", function(){
                    $(this).remove();
                })
        });
    };
</script>

<fieldset id="sf_fieldset_email">
    <form method="post" action="<?php echo sfConfig::get('sf_app_acceso_url').'configuracion/saveVarios'; ?>"> 
    <h2>Dias NO laborales</h2>
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Fecha</label>
            <div class="content">
            <?php 
                $years = range(date('Y'), date('Y')+1);
                $w = new sfWidgetFormJQueryDate(array(
                'culture' => 'es',
                'date_widget' => new sfWidgetFormI18nDate(array(
                                'format' => '%day%-%month%-%year%',
                                'culture'=>'es',
                                'empty_values' => array('day'=>'<- Día ->',
                                'month'=>'<- Mes ->',
                                'year'=>'<- Año ->'),
                                'years' => array_combine($years, $years)))
                ),array('name'=>'fecha',));
                
                echo $w->render('fecha');
            ?>   
            </div>
        </div>
    </div>

    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Descripción</label>
            <div class="content">
                <input id="descripcion" type="text" size="50" name="descripcion" value=""/>
            </div>
            <div class="help">Escriba el motivo del día. Ejemplo: Natalicio del Libertador Simón Bolívar</div>
        </div>
    </div>  
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <div class="content">
                <input type="checkbox" size="50" id="repetir" name="repetir" value=""/> Repetir anualmente
                &nbsp;&nbsp;
                <a href="#" onclick="javascript: fn_agregar_fecha(); return false;"><img src="/images/icon/new.png"/>&nbsp;Agregar al listado</a>
                <br/><br/>
                <table id="fechas_procesadas">
                    <?php 
                    $dias_no_laborables = $sf_varios['dias_no_laborables'];
                    
                    foreach ($dias_no_laborables as $dia => $detalles) { ?>
                        <tr>
                            <td><font class='f16b'><?php echo date("d-m-Y", strtotime($dia)); ?></font><br/>
                            <input name='varios[dias_no_laborables][<?php echo $dia; ?>]' type='hidden' value='<?php echo $detalles; ?>'/></td>
                            <td><?php $descripcion = explode('#',$detalles); echo trim($descripcion[0]); ?></td>
                            <td><a class='elimina' style='cursor: pointer;'><img src='/images/icon/delete.png'/></a></td>
                        </tr>
                    <?php } ?>
                    
                </table>
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

