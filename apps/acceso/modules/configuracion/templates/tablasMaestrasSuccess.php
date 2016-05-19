<script>
    function toogle_info(){
        $('.div_form').hide();
        if($('#select_tablas_maestras').val()!=''){
            $('#div_'+$('#select_tablas_maestras').val()).show();
        }
    }
    
    function saveInfo(table){
        $.ajax({
            url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>configuracion/saveTablasMaestras',
            type:'POST',
            dataType:'html',
            data:'&id='+$("#id_"+table).val()+
                 '&value='+$("#value_"+table).val()+
                 '&table='+table,
            success:function(data, textStatus){
                var cadena = '<tr>'+
                                '<td style="min-width: 255px;">'+$("#value_"+table).val()+'</td>'+
                                '<td title="Recarge para poder editar o eliminar"><?php echo image_tag('icon/error.png'); ?></td>'+
                             '</tr>';
                
                $('#grilla_tipo_educacion_adicional').prepend(cadena);
                $('#id_'+table).val('');
                $('#value_'+table).val('');
                
                $('#div_flashes').html(data);
            }});
    }
</script>
            
<fieldset id="sf_fieldset_oficinas_clave">
    <h2>Tablas Maestras del sistema</h2>
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label>Informacion</label>
            <div class="content">
                <select id="select_tablas_maestras" onchange="toogle_info();">
                    <option value=""></option>
                    <option value="parentesco">Parentesco</option>
                    <option value="XXXXXXXXXXXx">Especialidad en educacion media</option>
                    <option value="XXXXXXXXXXXx">Nivel Academico</option>
                    <option value="tipo_educacion_adicional">Tipos educacion adicional</option>
                </select>
            </div>
        </div>
    </div>
    
    <div id="div_flashes"></div>
    
    <div id="div_tipo_educacion_adicional" class="sf_admin_form_row sf_admin_text div_form" style="display: none;">
        <div>
            <label for="">Tipos educacion adicional</label>
            <div class="help">
                Los tipos de informacion adicional se usan para clasificar los estudios que no son basados 
                en educacion media y universitaria, es decir cursos, congresos, ponencias, etc.
            </div>
            <div class="content">
                <div id="form_tabla_tipo_educacion_adicional">
                    <input type="hidden" value="" id="id_tipo_educacion_adicional"/>
                    <input type="text" value="" size="40" id="value_tipo_educacion_adicional"/>
                    <a href="#" title="Guardar Informacion" onclick="saveInfo('tipo_educacion_adicional'); return false;"><?php echo image_tag('icon/filesave.png'); ?></a>
                </div>
                <br/>
                <table id="grilla_tipo_educacion_adicional">
                    <?php 
                        $tipos_educacion_adicional = Doctrine::getTable('Public_TipoEducacionAdicional')
                                    ->createQuery('a')
                                    ->where("status = 'A'")
                                    ->orderBy('nombre')
                                    ->execute();
                        
                        foreach ($tipos_educacion_adicional as $tipo_educacion_adicional) { ?>
                            <tr>
                                <td style="min-width: 255px;"><?php echo $tipo_educacion_adicional->getNombre(); ?></td>
                                <td>
                                    <a href="#" style="text-decoration: none" title="Editar" onclick="edit_info(<?php echo $tipo_educacion_adicional->getId(); ?>,<?php echo $tipo_educacion_adicional->getNombre(); ?>); return false;" >
                                        <?php echo image_tag('icon/edit.png'); ?>
                                    </a>
                                    &nbsp;&nbsp;
                                    <a href="#" style="text-decoration: none" title="Eliminar" onclick="delete_info(); return confirm('¿Esta seguro de que desea eliminar el registro?');" >
                                        <?php echo image_tag('icon/delete.png'); ?>
                                    </a>
                                </td>
                            </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>        
</fieldset>