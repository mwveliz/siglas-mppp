<?php use_helper('jQuery'); ?>

<script>
    function open_form_nomenclador(){
        $('#div_form_nomencladores').toggle('slow');
    }
</script>

<div>
    <form method="post" action="<?php echo sfConfig::get('sf_app_acceso_url').'configuracion/saveCorrelativo'; ?>">
    <fieldset>
        <h2 style="cursor: pointer;" onclick="open_form_nomenclador();">Nomencladores de correlativos de correspondencia</h2>
        <div id="div_form_nomencladores" style="display: none;">
            <div class="sf_admin_form_row sf_admin_text">
                <div>
                    <label for="">Nomencladores</label>
                    <div class="content">
                        <?php foreach ($nomencladores['correspondencia'] as $nomenclador => $status) { ?>
                            <input type="checkbox" name="correlativo[nomenclador][<?php echo $nomenclador; ?>]" value="true" <?php if($status == true) echo "checked"; ?>/>&nbsp;&nbsp;<?php echo $nomenclador; ?><br/>
                        <?php } ?>
                    </div>

                    <div class="help">Seleccione los nomencladores que desea publicar para la creación de la correspondencia</div>
                </div>
            </div>
            <ul class="sf_admin_actions">
                <li class="sf_admin_action_save">
                    <button id="guardar_documento" onClick="javascript: this.form.submit();" style="height: 35px; margin-left: 130px">
                        <?php echo image_tag('icon/filesave.png', array('style' => 'vertical-align: middle')) ?>&nbsp;<strong>Guardar cambios</strong>
                    </button>
                </li>
            </ul>
        </div>
    </fieldset>
    </form>  
    
    <fieldset>
        <h2>Adminsitración de correlativos de correspondencia</h2>
        <br/>
        <table style="width: 100%;">
            <tr style="" class="sf_admin_row">
                <th>Unidades</th>
                <th style="background-color: green; text-align: center; color: white">Correlativos asignados</th>
                <th style="background-color: #E7EEF6; text-align: center;">Acciones</th>
            </tr>
            <?php  foreach ( $organigrama as $unidad_id=>$unidad_nombre ) { if($unidad_id!='') { ?>
                <tr class="sf_admin_row">
                    <td>
                        <?php echo html_entity_decode($unidad_nombre); ?>
                    </td>
                    <td style="background-color: #3dc83d; text-align: center;"><?php echo $correlativos[$unidad_id]['count']; ?></td>
                    <td style="background-color: #FFFFFC; text-align: center;"><?php echo link_to(image_tag('icon/edit.png'), 'configuracion/editGroupCorrelativo?id='.$unidad_id); ?></td>
                </tr>
            <?php } } ?>
            <tr>
                <td style="text-align: right"><b>TOTAL:</b></td>
                <td style="background-color: #3dc83d; text-align: center;"><b><?php echo $correlativos['total']; ?></b></td>
                <td colspan="2"></td>
            </tr>
        </table>
        <div id="sf_admin_footer"> </div>
    </fieldset>
</div>