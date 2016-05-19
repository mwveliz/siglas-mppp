<fieldset id="sf_fieldset_email">
    
    <h2>Cache del Sistema</h2>
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="correspondencia_n_correspondencia_emisor">Correspondencia</label>
            <div class="content">
                Ultimo Borrado: <?php if(isset($sf_cache['correspondencia']['ultimo_borrado'])) echo $sf_cache['correspondencia']['ultimo_borrado']; else echo "Nunca"; ?>&nbsp;&nbsp;
                <form method="post" action="<?php echo sfConfig::get('sf_app_acceso_url').'configuracion/saveCache?cache=correspondencia'; ?>"> 
                    <input value="Borrar" type="submit" name="correspondencia"/>
                </form> 
            </div>
        </div>
    </div>

    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="correspondencia_n_correspondencia_emisor">Organigrama</label>
            <div class="content">
                Ultimo Borrado: <?php if(isset($sf_cache['organigrama']['ultimo_borrado'])) echo $sf_cache['organigrama']['ultimo_borrado']; else echo "Nunca"; ?>&nbsp;&nbsp;
                <form method="post" action="<?php echo sfConfig::get('sf_app_acceso_url').'configuracion/saveCache?cache=organigrama'; ?>"> 
                    <input value="Borrar" type="submit" name="organigrama"/>
                </form> 
            </div>
        </div>
    </div>  
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="correspondencia_n_correspondencia_emisor">Organismos Externos</label>
            <div class="content">
                Ultimo Borrado: <?php if(isset($sf_cache['organismos']['ultimo_borrado'])) echo $sf_cache['organismos']['ultimo_borrado']; else echo "Nunca"; ?>&nbsp;&nbsp;
                <form method="post" action="<?php echo sfConfig::get('sf_app_acceso_url').'configuracion/saveCache?cache=organismos'; ?>"> 
                    <input value="Borrar" type="submit" name="organismos"/>
                </form> 
            </div>
        </div>
    </div>  
</fieldset>