<?php use_helper('jQuery'); ?>

<script language="JavaScript" type="text/javascript">
function conmutar(){
    if(document.export_form.all.checked==true){
        document.export_form.unidades_clave.checked= true;
        document.export_form.correo_electronico.checked= true;
        document.export_form.sms.checked= true;
        document.export_form.datos_basicos.checked= true;
        document.export_form.recursos_humanos.checked= true;
        document.export_form.varios.checked= true;
    }else{
        document.export_form.unidades_clave.checked= false;
        document.export_form.correo_electronico.checked= false;
        document.export_form.sms.checked= false;
        document.export_form.datos_basicos.checked= false;
        document.export_form.recursos_humanos.checked= false;
        document.export_form.varios.checked= false;
    }
}

function Valida(){
   var inv= 0;
   for (i=0;i<document.export_form.elements.length;i++){
      if(document.export_form.elements[i].type == "checkbox"){
          if(document.export_form.elements[i].checked==true){
              inv++;
          }
      }
   }
   if(inv != 0)
       return true;
   else{
       alert('Debe tildar al menos una (1) opción');
       return false;
   }
       
}
</script>

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
    <h1>Respaldo de Configuraciones</h1>

    <div id="sf_admin_content">

        <div class="sf_admin_form">
            <fieldset id="sf_fieldset_oficinas_clave">
                <form method="post" name="export_form" action="<?php echo sfConfig::get('sf_app_acceso_url') . 'configuracion/exportarConfigDo'; ?>" onsubmit="return Valida()">
                    <h2>Exportaci&oacute;n de Configuraci&oacute;n</h2>

                    <div class="sf_admin_form_row sf_admin_text">
                        <div>
                            <label for="">Exportar solo</label>
                            <div class="content">
                                <input type="checkbox" name="unidades_clave" value="true">&nbsp;Unidades Clave<br/>
                                <input type="checkbox" name="correo_electronico" value="true">&nbsp;Correo Electr&oacute;nico<br/>
                                <input type="checkbox" name="sms" value="true">&nbsp;Mensajeria de Texto (SMS)<br/>
                                <input type="checkbox" name="datos_basicos" value="true">&nbsp;Datos B&aacute;sicos<br/>
                                <input type="checkbox" name="recursos_humanos" value="true">&nbsp;Recursos Humanos<br/>
                                <input type="checkbox" name="varios" value="true">&nbsp;Varios (D&iacute;as No Laborables)<br/><br/>
                                <input type="checkbox" name="all" value="true" onChange="javascript:conmutar()">&nbsp;<b>Todos</b><br/>
                            </div>
                            <div class="help">Seleccione los items que desea respaldar.</div>
                        </div>
                    </div>

                    <div class="sf_admin_form_row sf_admin_text">
                        <div>
                            <label for="">Respaldo</label>
                            <div class="content">
                                <?php $sf_respaldo = sfYaml::load(sfConfig::get("sf_root_dir")."/config/siglas/configRespaldo.yml");?>
                                <?php echo $sf_respaldo['fecha_respaldo']?>
                            </div>
                            <div class="help">Fecha del &Uacute;ltimo respaldo realizado.</div>
                        </div>
                    </div>
                    <ul class="sf_admin_actions">
                        <li class="sf_admin_action_save"><input value="Exportar" type="submit"/></li>
                    </ul>
                </form>
            </fieldset>
        </div>
    </div>
</div>
