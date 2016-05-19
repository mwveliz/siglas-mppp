<fieldset id="sf_fieldset_oficinas_clave">
    <form method="post" action="<?php echo sfConfig::get('sf_app_acceso_url').'configuracion/saveFirmaElectronica'; ?>"> 
    <h2>Firma Electronica</h2>
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <div class="help">Seleccione las herramientas en las que desea usar firma electronica</div>
            <label for="">Estatus</label>
            <div class="content">
                <label for="">Correspondencia</label>
                <div class="content">
                    <input type="radio" name="firma_electronica[correspondencia][activo]" value="true" <?php if($sf_firmaElectronica['correspondencia']['activo'] == true) echo "checked"; ?>/> Activo&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="firma_electronica[correspondencia][activo]" value="false" <?php if($sf_firmaElectronica['correspondencia']['activo'] == false) echo "checked"; ?>/> Inactivo
                </div>
                <hr/>
                <label for="">Archivo</label>
                <div class="content">
                    <input type="radio" name="firma_electronica[archivo][activo]" value="true" <?php if($sf_firmaElectronica['archivo']['activo'] == true) echo "checked"; ?>/> Activo&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="firma_electronica[archivo][activo]" value="false" <?php if($sf_firmaElectronica['archivo']['activo'] == false) echo "checked"; ?>/> Inactivo
                </div>
                <hr/>
                <label for="">Acceso</label>
                <div class="content">
                    <input type="radio" name="firma_electronica[acceso][activo]" value="true" <?php if($sf_firmaElectronica['acceso']['activo'] == true) echo "checked"; ?>/> Activo&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="firma_electronica[acceso][activo]" value="false" <?php if($sf_firmaElectronica['acceso']['activo'] == false) echo "checked"; ?>/> Inactivo
                </div>
                <hr/>
                <label for="">Organigrama</label>
                <div class="content">
                    <input type="radio" name="firma_electronica[organigrama][activo]" value="true" <?php if($sf_firmaElectronica['organigrama']['activo'] == true) echo "checked"; ?>/> Activo&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="firma_electronica[organigrama][activo]" value="false" <?php if($sf_firmaElectronica['organigrama']['activo'] == false) echo "checked"; ?>/> Inactivo
                </div>
                <hr/>
                <label for="">Funcionarios</label>
                <div class="content">
                    <input type="radio" name="firma_electronica[funcionarios][activo]" value="true" <?php if($sf_firmaElectronica['funcionarios']['activo'] == true) echo "checked"; ?>/> Activo&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="firma_electronica[funcionarios][activo]" value="false" <?php if($sf_firmaElectronica['funcionarios']['activo'] == false) echo "checked"; ?>/> Inactivo
                </div>
                <hr/>
                <label for="">Herramientas</label>
                <div class="content">
                    <input type="radio" name="firma_electronica[herramientas][activo]" value="true" <?php if($sf_firmaElectronica['herramientas']['activo'] == true) echo "checked"; ?>/> Activo&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="firma_electronica[herramientas][activo]" value="false" <?php if($sf_firmaElectronica['herramientas']['activo'] == false) echo "checked"; ?>/> Inactivo
                </div>
                <hr/>
                <label for="">RRHH</label>
                <div class="content">
                    <input type="radio" name="firma_electronica[rrhh][activo]" value="true" <?php if($sf_firmaElectronica['rrhh']['activo'] == true) echo "checked"; ?>/> Activo&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="firma_electronica[rrhh][activo]" value="false" <?php if($sf_firmaElectronica['rrhh']['activo'] == false) echo "checked"; ?>/> Inactivo
                </div>
                <hr/>
                <label for="">Inventario</label>
                <div class="content">
                    <input type="radio" name="firma_electronica[inventario][activo]" value="true" <?php if($sf_firmaElectronica['inventario']['activo'] == true) echo "checked"; ?>/> Activo&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="firma_electronica[inventario][activo]" value="false" <?php if($sf_firmaElectronica['inventario']['activo'] == false) echo "checked"; ?>/> Inactivo
                </div>
                <hr/>
                <label for="">Proveedores</label>
                <div class="content">
                    <input type="radio" name="firma_electronica[proveedores][activo]" value="true" <?php if($sf_firmaElectronica['proveedores']['activo'] == true) echo "checked"; ?>/> Activo&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="firma_electronica[proveedores][activo]" value="false" <?php if($sf_firmaElectronica['proveedores']['activo'] == false) echo "checked"; ?>/> Inactivo
                </div>
                <hr/>
                <label for="">Seguridad</label>
                <div class="content">
                    <input type="radio" name="firma_electronica[seguridad][activo]" value="true" <?php if($sf_firmaElectronica['seguridad']['activo'] == true) echo "checked"; ?>/> Activo&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="firma_electronica[seguridad][activo]" value="false" <?php if($sf_firmaElectronica['seguridad']['activo'] == false) echo "checked"; ?>/> Inactivo
                </div>
                <hr/>
                <label for="">Comunicaciones</label>
                <div class="content">
                    <input type="radio" name="firma_electronica[comunicaciones][activo]" value="true" <?php if($sf_firmaElectronica['comunicaciones']['activo'] == true) echo "checked"; ?>/> Activo&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="firma_electronica[comunicaciones][activo]" value="false" <?php if($sf_firmaElectronica['comunicaciones']['activo'] == false) echo "checked"; ?>/> Inactivo
                </div>
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