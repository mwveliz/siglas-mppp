<fieldset id="sf_fieldset_crontab">
    <form method="post" action="<?php echo sfConfig::get('sf_app_acceso_url').'configuracion/saveCrontab'; ?>"> 
    <h2>Tareas automaticas (Crontab)</h2>
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Estatus</label>
            <div class="content">
                <input type="radio" name="crontab[activo]" value=true <?php if($sf_crontab['activo'] == true) echo "checked"; ?>/> Activo&nbsp;&nbsp;&nbsp;
                <input type="radio" name="crontab[activo]" value=false <?php if($sf_crontab['activo'] == false) echo "checked"; ?>/> Inactivo
            </div>
        </div>
    </div>
    
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Aplicaciones</label>
            <div class="content">
                <?php foreach ($sf_crontab['aplicaciones'] as $aplicacion => $detalles) { ?>
                    <table width="600">
                        <tr>
                            <th colspan="2"><b><?php echo ucwords($aplicacion); ?></b></th>
                        </tr>
                        <?php foreach ($detalles as $key => $valores) { ?>
                            <tr>
                                <td>
                                    <input type="radio" name="crontab[aplicaciones][<?php echo $aplicacion; ?>][<?php echo $key; ?>][activo]" value="true" <?php if($valores['activo'] == TRUE) echo "checked"; ?>/> Activa&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="crontab[aplicaciones][<?php echo $aplicacion; ?>][<?php echo $key; ?>][activo]" value="false" <?php if($valores['activo'] == FALSE) echo "checked"; ?>/> Inactiva&nbsp;&nbsp;&nbsp;<br/>
                                    <b>Tipo:</b> <?php echo $valores['tipo']; ?><br/>
                                    <b>Descripcion:</b> <?php echo $valores['comment']; ?><br/>
                                    <b>Ejecucion:</b> <i class="gris_medio"><?php echo $valores['frecuency']; ?> cd <?php echo sfConfig::get("sf_root_dir"); ?> && symfony <?php echo $valores['task']; ?></i>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    
                    <br/>
                <?php } ?>
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