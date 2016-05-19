<?php use_helper('jQuery'); ?>

<script>
    function text_help_appear() {
        if ($('input[id=asistente_noempty]').attr('checked')){
            $("#text_help").show();
        }else{
            $("#text_help").hide();
        }
    }
</script>

<fieldset id="sf_fieldset_autenticacion">
    <form method="post" action="<?php echo sfConfig::get('sf_app_acceso_url').'configuracion/saveAutenticacion'; ?>"> 
    <h2>Autenticación</h2>

    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Metodo</label>
            <div class="content">
                <input type="radio" name="autenticacion[metodo]" value="siglas" <?php if($sf_autenticacion['metodo'] == "siglas") echo "checked"; ?>/> Usuario interno SIGLAS<br/>
                <input type="radio" name="autenticacion[metodo]" value="ldap" <?php if($sf_autenticacion['metodo'] == "ldap") echo "checked"; ?>/> Usuario de directorio activo LDAP<br/>
                <input type="radio" name="autenticacion[metodo]" value="ambos" <?php if($sf_autenticacion['metodo'] == "ambos") echo "checked"; ?>/> Usuario SIGLAS o LDAP
            </div>
        </div>
    </div>
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Parametros LDAP</label>
            <div class="content">
                    <table width="600">
                        <tr>
                            <td width="110"><b>Conector</b></td>
                            <td>
                                <div style="position: relative; height: 60px;">
                                    <div style="position: absolute; top: 0px;">URL:</div>
                                    <div style="position: absolute; top: 0px; left: 55px;">
                                        <input type="text" name="autenticacion[parametros_ldap][url]" value="<?php echo $sf_autenticacion['parametros_ldap']['url']; ?>"/>
                                    </div>
                                    <div style="position: absolute; top: 20px;">DC:</div>
                                    <div style="position: absolute; top: 20px; left: 55px;">
                                        <input type="text" name="autenticacion[parametros_ldap][dc]" value="<?php echo $sf_autenticacion['parametros_ldap']['dc']; ?>"/>
                                    </div>
                                    <div style="position: absolute; top: 40px;">Versión:</div>
                                    <div style="position: absolute; top: 40px; left: 55px;">
                                        <input type="text" name="autenticacion[parametros_ldap][version]" value="<?php echo $sf_autenticacion['parametros_ldap']['version']; ?>"/>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    
                    <br/>
            </div>
        </div>
    </div>

    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Asistente de Ingreso</label>
            <div class="content">
                <input type="radio" id="asistente_empty" name="autenticacion[asistente][activo]" onClick="javascript: text_help_appear();" value="noempty" <?php echo ((isset($sf_autenticacion['asistente']))? ((isset($sf_autenticacion['asistente']['activo']))? (($sf_autenticacion['asistente']['activo'] == "noempty")? 'checked' : '') : 'checked') : 'checked') ?>/> Usar asistente SIGLAS<br/>
                <input type="radio" id="asistente_noempty" name="autenticacion[asistente][activo]" onClick="javascript: text_help_appear();" value="empty" <?php echo ((isset($sf_autenticacion['asistente']))? ((isset($sf_autenticacion['asistente']['activo']))? (($sf_autenticacion['asistente']['activo'] == "empty")? 'checked' : '') : '') : '') ?>/> No usar asistente SIGLAS<br/>
                <div id="text_help" style="display: <?php echo ((isset($sf_autenticacion['asistente']))? (($sf_autenticacion['asistente']['activo'] == "empty")? 'block' : 'none') : 'none') ?>">
                    <textarea id="text" name="autenticacion[asistente][text]" rows="4" cols="30" maxlength="70"><?php echo ((isset($sf_autenticacion['asistente']))? ((isset($sf_autenticacion['asistente']['text']))? $sf_autenticacion['asistente']['text'] : '') : '') ?></textarea>
                    <label for="">Texto de ayuda:<br/><font style="font-size: 10px; color: red">*</font><font style="font-size: 9px">Este campo es opcional y sustituir&aacute;a la entrada al asistente</font></label>
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