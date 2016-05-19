<fieldset id="sf_fieldset_oficinas_clave">
    <form method="post" action="<?php echo sfConfig::get('sf_app_acceso_url').'configuracion/saveInteroperabilidad'; ?>"> 
    <h2>Interoperabilidad</h2>
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Herramientas</label>
            <div class="content">
                <a href="<?php echo sfConfig::get('sf_app_acceso_url').'io'; ?>">
                    <img src="/images/icon/gob_trust.png"/>
                    Organismos de confianza
                </a>
            </div>
            <div class="help">
                Los organismos de confianza son instituciones del Estado Venezolano que actualmente usan el SIGLAS 
                de manera certificada, aquí podrá ver un listado de dichos organismos y podrá activar la conexión de 
                interoperabilidad así permitirle el acceso a los web services que este organismo provee.
            </div>
            <div class="content">
                <hr/>
                <a href="<?php echo sfConfig::get('sf_app_acceso_url').'io_publicada'; ?>">
                    <img src="/images/icon/send_ws.png"/>
                    Publicación de servicios para consumo externos
                </a>
            </div>
            <div class="help">
                En este enlace podrá publicar web services de forma segura para que otros organismos del 
                estado lo accedan mediante la plataforma SIGLAS-IO, permitiendo que los datos que se envían 
                y reciben viajen de manera segura, es decir cifrados y firmados electrónicamente.
            </div>
            <div class="content">
                <hr/>
                <a href="<?php echo sfConfig::get('sf_app_acceso_url').'io_disponible'; ?>">
                    <img src="/images/icon/receive_ws.png"/>
                    Servicios disponibles externos para consumo interno
                </a>
            </div>
            <div class="help">
                En este enlace podrá ver los web services que otros organismos del 
                estado han publicado mediante la plataforma SIGLAS-IO, permitiendo que sean consultados.
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