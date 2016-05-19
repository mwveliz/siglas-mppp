<?php use_helper('jQuery'); ?>

<script>
$(function() {

    $('#fecha_inicial').datepicker({
      autoSize: true, 
      constrainInput: true, 
      dateFormat: 'yy-mm-dd', 
      maxDate: 'M D', 
      onSelect: function(dateText, inst) { 
        $('#fecha_final').datepicker("option", "minDate",dateText); 
      } 
    });
    $('#fecha_final').datepicker({
      autoSize: true, 
      constrainInput: true, 
      dateFormat: 'yy-mm-dd', 
      maxDate: 'M D', 
      onSelect: function(dateText, inst) { 
        $('#fecha_inicial').datepicker("option", "maxDate",dateText); 
      } 
    });
});
    function abrir_estadistica() {
        if($("#estadistica_unidad_id").val() != ''){
            $('#form_config').slideUp();
            $('#button_otras').show();
            $('#div_estadisticas_visita').html('<?php echo image_tag('icon/cargando.gif', array('size'=>'25x25')); ?> Generando grafico ...');
                <?php
                echo jq_remote_function(array('update' => 'div_estadisticas_visita',
                'url' => 'ingresa/estadisticaSeleccionada',
                'with'     => "'&tipo='+$('#estadistica_tipo').val()+'&fi='+$('#fecha_inicial').val()+'&ff='+$('#fecha_final').val()"))
                ?>
        }
        else{ $('#estadistica_unidad_id').css('outline','red solid 1px'); }
    }
    function abrir_config(){
        $('#button_otras').hide();
        $('#form_config').slideDown();
    }
</script>


<div id="sf_admin_container">
<h1>Estadísticas de Visitantes</h1>
    <div id="sf_admin_header">

            <li class="sf_admin_action_back">
                <a href="<?php echo sfConfig::get('sf_app_seguridad_url').'ingresa'; ?>">Regresar</a>
            </li>
            
            <li class="sf_admin_action_back" id="button_otras" style="display: none;">
                <a href="#" onclick="abrir_config();">Otras estadisticas</a>
            </li>

    </div>

    <div id="sf_admin_content">
        <div id="form_config" class="sf_admin_form trans">

            <div class="sf_admin_form_row sf_admin_foreignkey sf_admin_form_field_visita_estadisticas_fechas">
                <div>
                    <label for="">Rango de fecha</label>
                    <div class="content">
                        Desde: <input name="fecha_inicial" type="text" id="fecha_inicial" /> 
                        Hasta: <input name="fecha_final" type="text" id="fecha_final" />
                    </div>
                    <div class="help">Si no se selecciona el rango de fechas las consultas se ejecutaran desde el inicio hasta la fecha actual.</div>
                </div>
            </div>

            <div class="sf_admin_form_row sf_admin_foreignkey sf_admin_form_field_visita_estadisticas_fechas">
                <div>
                    <label for="">Tipo de consulta</label>
                    <div class="content">
                        <select name="estadistica_tipo" id="estadistica_tipo">
                            <option value="motivos">Motivos de visita</option>
                            <option value="unidades">Unidades visitadas</option>
                            <option value="fechas">Visitas diarias</option>
                            <option value="personas">Visitas por persona</option>
                            <option value="vigilantes">Registros por personal</option>
                        </select>
                        <input type="button" value="Procesar" onclick="abrir_estadistica();"/>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="div_estadisticas_visita" class="trans"></div>
        
    </div>
</div>
