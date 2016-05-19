<?php $organigrama = Doctrine::getTable('Organigrama_Unidad')->comboUnidad(); ?>

<script>
    function buscar_correlativos(unidad_id){
        $('#correlativos_'+unidad_id).html('<?php echo image_tag('icon/cargando.gif', array('size'=>'25x25')); ?>');

        $.ajax({
            url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>configuracion/extraConfig',
            type:'POST',
            dataType:'html',
            data:'configuracion=gestionCorrespondencia'+
                '&funcion=correlativos'+
                '&parametros[unidad_id]='+unidad_id,
            success:function(data, textStatus){
                $('#correlativos_'+unidad_id).html(data)
            }});
    }
</script>

<div>   
    <fieldset><h2>GESTIÓN AUTOMATIZADA DE CORRESPONDENCIA</h2></fieldset>
        <br/>
        <table style="width: 100%;">
            <tr style="" class="sf_admin_row">
                <th>Unidades</th>
                <th>Correlativos</th>
                <th>Permisos de Grupo</th>
                <th>Acciones</th>
            </tr>
            <?php  foreach ( $organigrama as $unidad_id=>$unidad_nombre ) { if($unidad_id!='') { ?>
                <tr class="sf_admin_row">
                    <td>
                        <?php echo html_entity_decode($unidad_nombre); ?>
                    </td>
                    <td id="correlativos_<?php echo $unidad_id; ?>">
                        <a href="#" onclick="buscar_correlativos(<?php echo $unidad_id; ?>); return false;">Ver</a>
                    </td>
                    <td>grupo</td>
                    <td>
                        <?php echo link_to(image_tag('icon/grupos.png'), 'configuracion/editGroupCorrespondencia?id='.$unidad_id, array('title'=>'Crear correlativos')); ?>
                        <?php echo link_to(image_tag('icon/correlativo.png'), 'configuracion/editGroupCorrespondencia?id='.$unidad_id, array('title'=>'Crear permisos de grupo')); ?>
                    </td>
                </tr>

                
            <?php } } ?>
        </table>
    <div id="sf_admin_footer"> </div>
</div>