<script type="text/javascript" src="/js/jqueryTooltip.js"></script>
<?php use_helper('jQuery'); ?>

<a class="vbsn" href="<?php echo sfConfig::get('sf_app_acceso_url'); ?>configuracion/index">
    <?php echo image_tag('icon/mail_list.png'); ?>&nbsp;Volver a Configuraciones
</a>&nbsp;&nbsp;&nbsp;
<a class="vbs" href="<?php echo sfConfig::get('sf_app_acceso_url'); ?>configuracion/exportarConfig">
    <?php echo image_tag('icon/filesave.png'); ?>&nbsp;Respaldar Configuraciones
</a>&nbsp;&nbsp;&nbsp;
<a class="vbs" href="<?php echo sfConfig::get('sf_app_acceso_url'); ?>configuracion/importarConfig">
    <?php echo image_tag('icon/reset.png'); ?>&nbsp;Restaurar Configuraciones
</a><br/><br/>
<div id="sf_admin_container">
    <h1>Restauraci&oacute;n de Configuraciones</h1>

    <?php if ($sf_user->hasFlash('notice')): ?>
      <div class="notice"><?php echo $sf_user->getFlash('notice'); ?></div>
    <?php endif; ?>

    <?php if ($sf_user->hasFlash('error')): ?>
      <div class="error"><?php echo $sf_user->getFlash('error'); ?></div>
    <?php endif; ?>

    <div id="sf_admin_content">

        <div class="sf_admin_form">
            <fieldset id="sf_fieldset_oficinas_clave">
                <form method="post" name="export_form" enctype="multipart/form-data" action="<?php echo sfConfig::get('sf_app_acceso_url') . 'configuracion/importarConfigProcess'; ?>">
                    <h2>Importaci&oacute;n de Configuraci&oacute;n </h2>

                    <div class="sf_admin_form_row sf_admin_text">
                        <div>
                            <label for="">Respaldo</label>
                            <div class="content">
                                <input name="archivo" type="file" id="archivo" />&nbsp;<?php echo image_tag('icon/error', array('class'=> 'tooltip', 'title'=> '[!]OJO[/!]No use respaldos NO institucionales', 'style'=> 'vertical-align: middle'));?>
                            </div>
                            <div class="help">Seleccione un archivo de respaldo YAML (.yml) desde <br/>su equipo para reestablecer configuraciones.</div>
                        </div>
                    </div>
                    <ul class="sf_admin_actions">
                        <li class="sf_admin_action_save"><input value="Importar" type="submit"/></li>
                    </ul>
                </form>
            </fieldset>
        </div>
    </div>
</div>

