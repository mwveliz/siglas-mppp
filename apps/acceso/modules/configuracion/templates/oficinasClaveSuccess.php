<fieldset id="sf_fieldset_oficinas_clave">
    <form method="post" action="<?php echo sfConfig::get('sf_app_acceso_url').'configuracion/saveOficinasClave'; ?>"> 
    <h2>Unidades clave del organigrama</h2>

    <?php foreach ($sf_oficinasClave as $oficina => $detalles) { ?>
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="correspondencia_n_correspondencia_emisor"><?php echo $detalles['nombre']; ?></label>
            <div class="content">
                <?php 
                    $w = new sfWidgetFormChoice(array(
                          'choices'  => Doctrine::getTable('Organigrama_Unidad')->combounidad(),
                          'expanded' => false, 'multiple' => false
                        ));

                    echo $w->render("oficinas[".$oficina."][seleccion]",$detalles['seleccion']);
                ?>
            </div>

            <div class="help"><?php echo $detalles['help']; ?></div>
        </div>
    </div>
    <?php } ?>
        <ul class="sf_admin_actions">
            <li class="sf_admin_action_save">
                <button id="guardar_documento" onClick="javascript: this.form.submit();" style="height: 35px; margin-left: 130px">
                    <?php echo image_tag('icon/filesave.png', array('style' => 'vertical-align: middle')) ?>&nbsp;<strong>Guardar cambios</strong>
                </button>
            </li>
        </ul>

    </form>         
</fieldset>