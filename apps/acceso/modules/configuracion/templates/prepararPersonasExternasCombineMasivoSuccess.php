<div id="sf_admin_container">
    
    <h1>Personas repetidas por organismos externos</h1>
    
    <div>
        <ul class="sf_admin_actions trans">
          <li class="sf_admin_action_regresar_modulo"><a href="<?php echo sfConfig::get('sf_app_acceso_url'); ?>configuracion?opcion=organismosExternos">Regresar</a></li>
        </ul>
    </div>
    
    <div id="sf_admin_content">
        <div class="trans">
            <?php echo html_entity_decode($cadena); ?>
        </div>
    </div>

</div>