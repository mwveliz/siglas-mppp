<fieldset id="sf_fieldset_personas_externas">
    <?php
        $organismo_info = Doctrine::getTable('Organismos_Organismo')->find($organismo_id);
    ?>

    
    <div id="sf_admin_header">
        <ul class="sf_admin_actions trans">
          <li class="sf_admin_action_regresar_modulo"><a href="configuracion?opcion=organismosExternos">Regresar</a></li>
        </ul>
    </div>
    
    
    <h2>Personas del Organismo Externo "<?php echo $organismo_info->getNombre(); ?>"</h2>

    <script>
    $(document).ready(function(){
        $('#div_persona_button_conbine').click(function () {
            
            count_combine = 0;
            $(".personas_check").each(function () {
                if ($(this).is(':checked')) {
                    count_combine++;
                }
            });
            
            if(count_combine > 1){ 
                $("#div_persona_nombre_combine").toggle("slow");
                $("#persona_nombre_combine").val('Escriba el nombre corregido');
                $("#div_persona_info_combine").toggle("slow");
                $("#div_persona_button_save_combine").css("left",left_x);
            } else {
                alert('Debe seleccionar al menos dos personas para poder combinarlos');
            }
        });
        
        $('#persona_nombre_combine').focus(function () {
            if($(this).val()=='Escriba el nombre corregido')
                $(this).val(null);
        });
        
        $('#div_persona_button_save_combine').click(function () {
            var error = null;
            if(!$("#persona_nombre_combine").val()){
                error = 'Escriba el nombre corregido del Organismo';
            }

            if(error==null) { 
                count_combine = 0; var check = new Array();
                $(".personas_check").each(function () {
                    if ($(this).is(':checked')) {
                        check[count_combine] = $(this).val();
                        count_combine++;
                    }
                });

                if(count_combine > 1){ 
                    $('#personas').html('<?php echo image_tag('icon/cargando.gif', array('size'=>'25x25')); ?>');
                    $.ajax({
                        
                        url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>configuracion/savePersonasExternasCombine',
                        type:'POST',
                        dataType:'html',
                        data:'datos[persona]='+$("#persona_nombre_combine").val()+
                            '&datos[personas_ids]='+check,
                        success:function(data, textStatus){
                            jQuery('#personas').html(data);
                        }})

                    $("#div_persona_info_combine").hide();
                    $("#div_persona_nombre_combine").hide();
                    $("#div_persona_button_open_combine").hide();
                }
            } else {
                alert(error);
            }
        });
        
        
    });
    
    function editar_persona(id) {
        if ($('#link_'+id).length === 0) {
            jQuery('#persona_'+id).html('<input type="text" id="persona_n_'+id+'" size="30" value="'+$('#persona_'+id).text()+'" /><input type="hidden" id="persona_o_'+id+'" value="'+$('#persona_'+id).text()+'" /><div></div><a id="link_'+id+'" href="javascript: save_persona('+id+')"><img style="vertical-align: middle" src="/images/icon/filesave.png" />&nbsp;<x id="link_save">Guardar cambios</x></a>');
        }else {
            jQuery('#persona_'+id).html($('#persona_o_'+id).val());
        }
    }
    
    function save_persona(id) {
        var persona= $('#persona_n_'+id).val();

        if(persona !== '') {
            $.ajax({
                url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>configuracion/savePersonasEdit',
                type:'POST',
                dataType:'json',
                data:'id='+id+
                    '&persona='+persona,
                beforeSend: function(Obj){
                    $('#link_save').html('Espere...');
                },
                success:function(json, textStatus){
                    $('#persona_'+id).html(json.persona);
                    if(json.pross === 'error') {
                        alert('Error al guardar persona');
                    }
                }});
        }else {
            alert('Por favor, rellene los campos');
        }
    }
    
    </script>
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Personas actuales</label>
            <div class="content" style="position: relative;">

                
                <div style="position: absolute; top: -20px;">
                    <div style="position: absolute; left: 0px; cursor: pointer;" id="div_persona_button_conbine"><?php echo image_tag('icon/combine2.png'); ?></div>
                    <div style="position: absolute; left: 20px; display: none;" id="div_persona_nombre_combine"><input type="text" id="persona_nombre_combine" size="30"/></div>

                    <div style="position: absolute; left: 290px; display: none;" id="div_persona_info_combine">
                        <div style="position: absolute; top: 3px; left: 0px; cursor: pointer;" id="div_persona_button_save_combine"><?php echo image_tag('icon/filesave.png'); ?></div>
                    </div>
                </div>
                
                <div id="personas" style="position: relative;">
                    <table>
                        <tr>
                            <th></th>
                            <th style="width: 250px;">Nombre</th>
                            <th style="min-width: 20px;">Cargos</th>
                            <th style="min-width: 20px;"></th>
                        </tr>

                        <?php
                            $personas = Doctrine::getTable('Organismos_Persona')->createQuery('a')->where('status = \'A\'')->andWhere('organismo_id = '.$organismo_id)->orderBy('nombre_simple')->execute();

                            $i=1; $personas_ids = '';
                            foreach ($personas as $persona) {
                                $personas_ids.=$persona->getId().',';
                                echo '<tr>';
                                echo '<td><input type="checkbox" name="personas_ids[]" class="personas_check" value="'.$persona->getId().'"/></td>';
                                echo '<td class="personas_text" id="persona_'.$persona->getId().'">'.$persona->getNombreSimple().'</td>';
                                echo '<td id="preople_cargos_'.$persona->getId().'">'.image_tag('icon/cargando.gif').'</td>';
                                echo '<td style="text-align: center;"><a href="#">'.image_tag('icon/combine_people.png').'</a>';
                                echo '&nbsp;&nbsp;&nbsp;<a href="javascript: editar_persona('.$persona->getId().');">'.image_tag('icon/edit.png', array('title'=>'Editar organismo')).'</a>';
                                echo '</td>';
                                echo '</tr>';
                                $i++;
                            }
                            
                            $personas_ids .= '###';
                            $personas_ids = str_replace(",###", "", $personas_ids);
                        ?>
                    </table>
                    
                    <script>
                        var personas_ids = new Array(<?php echo $personas_ids; ?>);
                        var ACTIVO_PERSONAS = false;
                        var i = 0;
                        function contar_cargos(){
                            if(i<personas_ids.length){
                                if (ACTIVO_PERSONAS == false){
                                    ACTIVO_PERSONAS = true;
                                    $('#preople_cargos_'+personas_ids[i]).load("<?php echo sfConfig::get('sf_app_acceso_url'); ?>configuracion/contarCargosPersonas?persona_id="+personas_ids[i], 
                                    null, function (){
                                        ACTIVO_PERSONAS = false;
                                        i++;
                                    }).fadeIn("slow");
                                }
                            } else {
                                clearInterval(intervalo_contar);
                            }
                        }
                        var intervalo_contar = setInterval("contar_cargos()", 100);
                    </script>
                </div>
            </div>

            <div class="help">Seleccione las personas que desea unificar.</div>
        </div>
    </div> 
</fieldset>

