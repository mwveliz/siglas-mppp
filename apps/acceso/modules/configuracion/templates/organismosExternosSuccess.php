<?php use_helper('jQuery'); ?>
<fieldset id="sf_fieldset_organismos_externos">
    <h2>Organismos Externos</h2>

    <script>
    $(document).ready(function(){
        
        $("#organismo_nombre").keyup(function () {
            if($("#organismo_nombre").val().length > 2 || $("#organismo_nombre").val().length < 1){   
                var filter = $(this).val(), count = 0;
                $(".organismos_text").each(function () {
                    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                        $(this).parent().hide();
                    } else {
                        $(this).parent().show();
                        count++;
                    }
                });

                if(count==0)
                    $("#div_organismo_button_open").show("slow");
                else
                    $("#div_organismo_button_open").hide("slow");
            }
        });
        
        $('#div_organismo_button_find').click(function () {
            $("#div_organismo_nombre").toggle("slow");
            $("#organismo_nombre").val(null);
            $("#select_organismo option").show();
            $("#div_organismo_button_open").hide();
            $("#div_organismo_info").hide();
        });

        $('#div_organismo_button_open').click(function () {
            $("#div_organismo_info").toggle("slow");
            $("#organismo_siglas").val('<- SIGLAS ->');
            var left_x = parseFloat(($("#organismo_tipo").css("width")).replace('px','')) + 130;
            $("#div_organismo_button_save").css("left",left_x);
        });
        
        $('#organismo_siglas').focus(function () {
            if($(this).val()=='<- SIGLAS ->')
                $(this).val(null);
        });
        
        $('#div_organismo_button_save').click(function () {
            var error = null;
            if(!$("#organismo_nombre").val()){
                error = 'Escriba el nombre del Organismo';
            } else if(!$("#organismo_siglas").val()) {
                error = 'Escriba las siglas que identifican el Organismo.';
            } else if(!$("#organismo_tipo").val()) {
                error = 'Seleccione el Tipo de Organismo.';
            } 

            if(error==null) { 
                $.ajax({
                    url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>configuracion/saveOrganismosExternosNew',
                    type:'POST',
                    dataType:'html',
                    data:'datos[organismo]='+$("#organismo_nombre").val()+
                        '&datos[siglas]='+$("#organismo_siglas").val()+
                        '&datos[tipo]='+$("#organismo_tipo").val(),
                    success:function(data, textStatus){
                        jQuery('#organismos').html(data);
                    }})
            
                $("#div_organismo_info").hide();
                $("#div_organismo_nombre").hide();
                $("#div_organismo_button_open").hide();
            } else {
                alert(error);
            }
        });
        
        $('#div_organismo_button_conbine').click(function () {
            
            count_combine = 0;
            $(".organismos_check").each(function () {
                if ($(this).is(':checked')) {
                    count_combine++;
                }
            });
            
            if(count_combine > 1){ 
                $("#div_organismo_nombre_combine").toggle("slow");
                $("#organismo_nombre_combine").val('Escriba el nombre corregido');
                $("#div_organismo_info_combine").toggle("slow");
                $("#organismo_siglas_combine").val('<- SIGLAS ->');
                var left_x = parseFloat(($("#organismo_tipo_combine").css("width")).replace('px','')) + 130;
                $("#div_organismo_button_save_combine").css("left",left_x);
            } else {
                alert('Debe seleccionar al menos dos organismos para poder combinarlos');
            }
        });
        
        $('#organismo_siglas_combine').focus(function () {
            if($(this).val()=='<- SIGLAS ->')
                $(this).val(null);
        });
        
        $('#organismo_nombre_combine').focus(function () {
            if($(this).val()=='Escriba el nombre corregido')
                $(this).val(null);
        });
        
        $('#div_organismo_button_save_combine').click(function () {
            var error = null;
            if(!$("#organismo_nombre_combine").val()){
                error = 'Escriba el nombre corregido del Organismo';
            } else if(!$("#organismo_siglas_combine").val()) {
                error = 'Escriba las siglas que identifican el Organismo.';
            } else if(!$("#organismo_tipo_combine").val()) {
                error = 'Seleccione el Tipo de Organismo.';
            } 

            if(error==null) { 
                count_combine = 0; var check = new Array();
                $(".organismos_check").each(function () {
                    if ($(this).is(':checked')) {
                        check[count_combine] = $(this).val();
                        count_combine++;
                    }
                });

                if(count_combine > 1){ 
                    $.ajax({
                        
                        url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>configuracion/saveOrganismosExternosCombine',
                        type:'POST',
                        dataType:'html',
                        data:'datos[organismo]='+$("#organismo_nombre_combine").val()+
                            '&datos[siglas]='+$("#organismo_siglas_combine").val()+
                            '&datos[tipo]='+$("#organismo_tipo_combine").val()+
                            '&datos[organismos_ids]='+check,
                        success:function(data, textStatus){
                            $('#organismos_combine').html(data);
                        }})

                    $("#div_organismo_info_combine").hide();
                    $("#div_organismo_nombre_combine").hide();
                    $("#div_organismo_button_open_combine").hide();
                }
            } else {
                alert(error);
            }
        });
         
    });
    
    function save_organismo(id) {
        var nombre= $('#nombre_n_'+id).val();
        var siglas= $('#siglas_n_'+id).val();

        if(nombre !== '' && siglas !== '') {
            $.ajax({
                url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>configuracion/saveOrganismosEdit',
                type:'POST',
                dataType:'json',
                data:'id='+id+
                    '&nombre='+nombre+
                    '&siglas='+siglas,
                beforeSend: function(Obj){
                    $('#link_save').html('Espere...');
                },
                success:function(json, textStatus){
                    $('#nombre_'+id).html(json.nombre);
                    $('#siglas_'+id).html(json.siglas);
                    if(json.pross === 'error') {
                        alert('Error al guardar organismo');
                    }
                }});
        }else {
            alert('Por favor, rellene los campos');
        }
    }
    
    function editar_organismo(id) {
        if ($('#link_'+id).length === 0) {
            jQuery('#siglas_'+id).html('<input type="text" id="siglas_n_'+id+'" size="15" value="'+$('#siglas_'+id).text()+'" /><input type="hidden" id="siglas_o_'+id+'" value="'+$('#siglas_'+id).text()+'" />');
            jQuery('#nombre_'+id).html('<input type="text" id="nombre_n_'+id+'" size="50" value="'+$('#nombre_'+id).text()+'" /><input type="hidden" id="nombre_o_'+id+'" value="'+$('#nombre_'+id).text()+'" />&nbsp;<a id="link_'+id+'" href="javascript: save_organismo('+id+')"><img style="vertical-align: middle" src="/images/icon/filesave.png" />&nbsp;<x id="link_save">Guardar cambios</x></a>');
        }else {
            jQuery('#siglas_'+id).html($('#siglas_o_'+id).val());
            jQuery('#nombre_'+id).html($('#nombre_o_'+id).val());
        }
    }
    
    function personas_externas(organismo_id)
    {
        <?php
        echo jq_remote_function(array('update' => 'contenido_opciones',
        'url' => 'configuracion/personasExternas',
        'with'=> "'organismo_id='+organismo_id",));
        ?>
    };
    
    function organismos_distancia()
    {
        var distancia = $('#distancia_organismos').val();
        $('#contenido_opciones').html('<?php echo image_tag('icon/cargando.gif', array('size'=>'25x25')); ?> Cargando organismos con distancia '+distancia+'...');
                
        $.ajax({
            url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>configuracion/organismosExternos',
            type:'POST',
            dataType:'html',
            data:'distancia='+distancia,
            success:function(data, textStatus){
                $('#contenido_opciones').html(data);
            }});
    }
    
</script>
    <br/>
    <div class="error" id="error_organismo" style="display: none;"></div>
    <div class="notice" id="notice_organismo" style="display: none;"></div>
    <br/>
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="correspondencia_n_correspondencia_emisor">Organismos actuales</label>
            <div class="content" style="position: relative;">
                <a href="#" onclick="organismos_distancia(); return false;">
                    Filtrar organismos similares - 
                </a>
                &nbsp;Distancia: 
                <select id="distancia_organismos">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <br/>
                <a href="configuracion/prepararPersonasExternasCombineMasivo">
                    Depuracion masiva de personas
                </a>
                <div style="position: absolute; top: -20px;">
                    <div style="position: absolute; left: 0px; cursor: pointer;" id="div_organismo_button_conbine"><?php echo image_tag('icon/combine2.png'); ?></div>
                    <div style="position: absolute; left: 16px; cursor: pointer;" id="div_organismo_button_find"><?php echo image_tag('icon/find.png'); ?></div>
                    
                    <div style="position: absolute; left: 36px; display: none;" id="div_organismo_nombre"><input type="text" id="organismo_nombre" size="65"/></div>
                    <div style="position: absolute; left: 36px; display: none;" id="div_organismo_nombre_combine"><input type="text" id="organismo_nombre_combine" size="65"/></div>
                    <div style="position: absolute; top: 3px; left: 546px; cursor: pointer; display: none;" id="div_organismo_button_open"><?php echo image_tag('icon/new.png'); ?></div>
                    
                    <div style="position: absolute; left: 566px; display: none;" id="div_organismo_info">
                        <div style="position: absolute; left: 0px;">
                            <input type="text" id="organismo_siglas" size="10"/>
                        </div>
                        <div style="position: absolute; left: 105px;">
                            <select id="organismo_tipo">
                                <option value=""><- Tipo de Oganismo -></option>
                                
                                <?php 
                                    $organismos_tipo = Doctrine::getTable('Organismos_OrganismoTipo')->findAll();
                                    foreach ($organismos_tipo as $organismo_tipo) { ?>
                                    <option value="<?php echo $organismo_tipo->getId(); ?>"><?php echo $organismo_tipo->getNombre(); ?></option>
                                <?php } ?>
                            </select>   
                        </div>
                        <div style="position: absolute; top: 3px; left: 0px; cursor: pointer;" id="div_organismo_button_save"><?php echo image_tag('icon/filesave.png'); ?></div>
                    </div>
                    
                    <div style="position: absolute; left: 566px; display: none;" id="div_organismo_info_combine">
                        <div style="position: absolute; left: 0px;">
                            <input type="text" id="organismo_siglas_combine" size="10"/>
                        </div>
                        <div style="position: absolute; left: 105px;">
                            <select id="organismo_tipo_combine">
                                <option value=""><- Tipo de Oganismo -></option>
                                
                                <?php 
                                    $organismos_tipo = Doctrine::getTable('Organismos_OrganismoTipo')->findAll();
                                    foreach ($organismos_tipo as $organismo_tipo) { ?>
                                    <option value="<?php echo $organismo_tipo->getId(); ?>"><?php echo $organismo_tipo->getNombre(); ?></option>
                                <?php } ?>
                            </select>   
                        </div>
                        <div style="position: absolute; top: 3px; left: 0px; cursor: pointer;" id="div_organismo_button_save_combine"><?php echo image_tag('icon/filesave.png'); ?></div>
                    </div>
                </div>
                <div id="organismos_combine"></div>
                <div id="organismos" style="position: relative;">
                    <table>
                        <tr>
                            <th></th>
                            <th style="width: 150px;">SIGLAS</th>
                            <th style="min-width: 250px;">Nombre</th>
                            <th style="min-width: 20px;">Personas</th>
                            <th style="min-width: 20px;"></th>
                        </tr>

                        <?php 
                            $i=1; $organismos_ids = '';
                            foreach ($organismos as $organismo) {
                                $organismos_ids.=$organismo->getId().',';
                                echo '<tr id="tr_organismo_id_'.$organismo->getId().'" height="40px">';
                                echo '<td><input id="check_id_'.$organismo->getId().'" type="checkbox" name="organismos_ids[]" class="organismos_check" value="'.$organismo->getId().'"/></td>';
                                echo '<td class="organismos_text" id="siglas_'.$organismo->getId().'">'.$organismo->getSiglas().'</td>'; 
                                echo '<td class="organismos_text" id="nombre_'.$organismo->getId().'">'.$organismo->getNombre().'</td>';
                                echo '<td id="people_'.$organismo->getId().'">'.image_tag('icon/cargando.gif').'</td>';
                                echo '<td style="text-align: center;"><a href="javascript: personas_externas('.$organismo->getId().');">'.image_tag('icon/combine_people.png', array('title'=>'Ver miembros')).'</a>&nbsp;&nbsp;';
                                echo '<a href="javascript: editar_organismo('.$organismo->getId().');">'.image_tag('icon/edit.png', array('title'=>'Editar organismo')).'</a>';
                                echo '</td>';
                                echo '</tr>';
                                $i++;
                            }
                            
                            $organismos_ids .= '###';
                            $organismos_ids = str_replace(",###", "", $organismos_ids);
                        ?>
                        <tr>
                            <th colspan="5">TOTAL DE ORGANISMOS: <?php echo $i-1; ?></th>
                        </tr>
                    </table>
                    
                    <script>
                        var organismos_ids = new Array(<?php echo $organismos_ids; ?>);
                        var ACTIVO_ORGANISMO = false;
                        var i = 0;
                        function contar_personas(){
                            if(i<organismos_ids.length){
                                if (ACTIVO_ORGANISMO == false){
                                    ACTIVO_ORGANISMO = true;
                                    $('#people_'+organismos_ids[i]).load("<?php echo sfConfig::get('sf_app_acceso_url'); ?>configuracion/contarPersonasOrganismos?organismo_id="+organismos_ids[i], 
                                    null, function (){
                                        ACTIVO_ORGANISMO = false;
                                        i++;
                                    }).fadeIn("slow");
                                }
                            } else {
                                clearInterval(intervalo_contar);
                            }
                        }
                        var intervalo_contar = setInterval("contar_personas()", 100);
                    </script>
                </div>
            </div>

            <div class="help">Seleccione los organismos que desea unificar.</div>
        </div>
    </div>      
</fieldset>

