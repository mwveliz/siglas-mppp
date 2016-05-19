<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>SIGLAS - <?php echo sfConfig::get('sf_siglas'); ?></title>

    <?php
       header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
       header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora
       header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
       header ("Pragma: no-cache");
    ?>

    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/images/icon/siglas.ico" />
    <link rel="stylesheet" type="text/css" media="screen" href="/css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/css/chat.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/css/fullcalendar.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/css/theme/jquery-ui.css" />
    <?php
        $tema = "estandar";
        if ($session_usuario = $sf_user->getAttribute('session_usuario')) {
            $tema = $session_usuario['tema'];
            $tema = str_replace('.jpg', '', $tema);
        }
    ?>
    <link rel="stylesheet" type="text/css" media="screen" href="/css/temas/<?php echo $tema; ?>.css" />
    <?php include_stylesheets() ?>
    
    
    <script type="text/javascript" src="/js/jquery-nucleo.js"></script>
    <?php include_javascripts() ?>
    <!-- NUEVO JQUERY -->
    <!--<script type="text/javascript" src="/js/UINuevo/jquery.js"></script>-->
    <!--<script type="text/javascript" src="/js/UINuevo/jquery-ui.min.js"></script>-->
    <!--<script type="text/javascript" src="/js/jquery.corner.js"></script>-->
    <script type="text/javascript" src="/js/jquery-migrate-1.2.1.js"></script>
    <script type="text/javascript" src="/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/js/jquery.gradient.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.js"></script>
    <script type="text/javascript" src="/js/accion.js"></script>
    <script type="text/javascript" src="/js/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="/js/jquery.imgareaselect.min.js"></script>
    <script type="text/javascript" src="/js/jquery.textarea-expander.js"></script>
    <script type="text/javascript" src="/js/highcharts/highcharts.js"></script>
    <script type="text/javascript" src="/js/highcharts/modules/exporting.js"></script>
    <script type="text/javascript" src="/js/fullcalendar.js"></script>
    <script type="text/javascript" src="/js/jquery-timepicker.js"></script>
    
  </head>
  <body style="background-color:white;">

<?php include(sfConfig::get("sf_root_dir").'/lib/partial/window_calendar.php'); ?>
<script>   
    function ver_manual(id){
        jQuery.ajax({
            url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>manuales/index',
            type:'POST',
            dataType:'html',
            data:'man='+id,
            success:function(data, textStatus){
                jQuery('#manual_ver').html(data);
            }})

        $("#manual_div").slideDown();
    };

    function cerrar_manual(){
        $("#manual_div").slideUp();
        $("#manual_ver").html('')
    };

    function ver_firma(id){
//        jQuery.ajax({
//            url:'<?php echo sfConfig::get('sf_app_acceso_url'); ?>firma/ver',
//            type:'POST',
//            dataType:'html',
//            data:'certificado='+id,
//            success:function(data, textStatus){
//                jQuery('#div_firma_'+ id).html(data);
//            }})

        $("#div_firma_"+ id).slideDown();
    };

    function cerrar_firma(id){
        $("#div_firma_"+ id).slideUp();
    };

    function ver_firma_tecnica(id){
        $("#div_firma_detalles_tecnicos_"+ id).slideDown();
    };

    function cerrar_firma_tecnica(id){
        $("#div_firma_detalles_tecnicos_"+ id).slideUp();
    };

    function abrir_notibar(action){
        $("#content_notificacion_arriba").css('top', '-420px');
        var alto= '0';
        jQuery.ajax({
            url:'<?php echo sfConfig::get('sf_app_comunicaciones_url'); ?>notibar/'+action,
            type:'POST',
            async: false,
            dataType:'html',
            beforeSend: function(Obj){
                    jQuery('#content_notificacion_arriba_inner').html('<div style="text-align: center; padding-top: 40px">Cargando notificaciones...</div>');
                },
            success:function(data, textStatus){
                jQuery('#content_notificacion_arriba_inner').html(data);
                alto= parseInt($("#content_notificacion_arriba_inner").css('height')) + 80;
        }});
        if(alto< '215')
            alto= '215';
        $('#content_notificacion_arriba').animate({ top: '+='+alto },200);
    };
    
    function cerrar_notibar(){
        $("#content_notificacion_arriba").animate({top:"-=580px"},700);
    };

    function notibar_count(){
        jQuery.ajax({
            url:'<?php echo sfConfig::get('sf_app_comunicaciones_url'); ?>notibar/groupsCount',
            type:'POST',
            dataType:'html',
            success:function(data, textStatus){
                jQuery('#noti_bar').html(data);
        }});
    }

    <?php
    if($sf_user->getAttribute('header_ruta')){ ?>
        $(document).ready(function () {
            if ($("#sf_admin_container").length>0){
                $("#sf_admin_container").prepend('<div><u><?php echo $sf_user->getAttribute('header_ruta'); ?></u></div>');
            }
        });
    <?php }elseif($sf_user->isAuthenticated()) { ?>
        $(document).ready(function () {
            notibar_count();
        });
    <?php } ?>
        
    function config_menu(){
        if ($('#div_config_menu').is (':visible'))
            $("#div_config_menu").slideUp("fast");
        else
            $("#div_config_menu").slideToggle( "fast" );
    }
    
    $('#contenedor').live("click",function(){
        $("#div_config_menu").slideUp("fast");
    });
</script>

<div id="contenedor">
    <div id="header" style="z-index: 1000;border:0px solid red;">
      <table width="100%" border="0" style="border:0px solid yellow">
          <?php
                if (!$sf_user->getAttribute('usuario_id')) {
                // ############ PARA NO AGREGAR OTRO LAYOUT VALIDO SI NO ESTA LOGEADO Y COLOCO EN ENCABEZADO VZLA  ############
          ?>
          <tr>
              <td>
                  <table width="100%" border='0'>
                      <tr style="background-color: white;">
                          <td align="left">
                                <?php echo image_tag('organismo/banner_izquierdo.png'); ?>
                          </td>
                          <td align="right">
                                <?php //echo image_tag('organismo/banner_derecho.png'); ?>
                          </td>
                      </tr>
                      <tr align="center">
							<td colspan="4" class='linea_menu' height="120px" align='center' >
								<div class="banner_siglas">&nbsp;</div>
							</td>
                       </tr>
                  </table>
               </td>
          </tr>
          <?php } else { ?>
          <tr>
              <td colspan="2" class="barra_principal">
		<div style="position: relative; top: 0px;height:50px; left: 0px;border:BLUE solid 0px">
					  <table width="100%">
                      <tr style="background-color: white;">
                          <td align="left">
                                <?php echo image_tag('organismo/banner_izquierdo.png'); ?>
                          </td>
                          <td align="right">
                                <?php //echo image_tag('organismo/banner_derecho.png'); ?>
                          </td>
                      </tr>
                  </table>
                  </div>
                  <div class='cintillo_interno'>
					
                  
                  </div>
		  <div class="barra_principal">
                  <!-- ############ ENCABEZADO ############ -->
                  <!-- ############ BOTONES DE INICIO Y CERRAR SESION ############ -->
         
                  <div style="position: absolute; top: 8px; left: 0px; z-index: 1900; border:red solid 0px;height:35px">
                      <table style="height: 40px;border:red solid 0px" cellpadding="0" cellspacing="0" >
                          <tr style="border:red solid 0px">
                              <td width="24"></a></td>
                              <td>&nbsp;<a href="<?php echo sfConfig::get('sf_app_acceso_url'); ?>usuario/session">INICIO</a></td>
                              <td>&nbsp;</td>
                              
                          </tr>
                      </table>
                  </div>
				          <!-- ############ FIN BOTONES DE INICIO Y CERRAR SESION ############ -->
                  <div style="position: absolute; top: 5px; left: 40%;">
                      <ul id="noti_bar"></ul>
                  </div>

                  <div style="position: absolute; top: 5px; right: 20px;border:red solid 0px;">
                      <table style="height: 40px;" cellpadding="0" cellspacing="0" >
                          <tr>
                              <td class="mensaje_expira" style="display: none;">
                                  <div style="position: abosolute;">
                                    <div onclick="$('#menu_expira').toggle();" style=" cursor: pointer;">
                                        <img src="/images/icon/error.png"/>
                                    </div>
                                    <div id="menu_expira" style="display: none; width:230px; position: absolute; top: 31px; background-color: #F5F5F5; border: solid 0px; text-align: justify; padding: 10px;">
                                        Cambiar el tiempo maximo de inactividad antes de que se expire la sesi&oacute;n a:&nbsp;&nbsp;
                                        <select onchange="cambiar_tiempo_expira($(this).val()); $('#menu_expira').hide();">
                                            <option value="6" <?php if($sf_user->getAttribute('sf_session_expira') == 6) echo "selected"; ?>>6 minutos</option>
                                            <option value="10" <?php if($sf_user->getAttribute('sf_session_expira') == 10) echo "selected"; ?>>10 minutos</option>
                                            <option value="20" <?php if($sf_user->getAttribute('sf_session_expira') == 20) echo "selected"; ?>>20 minutos</option>
                                            <option value="30" <?php if($sf_user->getAttribute('sf_session_expira') == 30) echo "selected"; ?>>30 minutos</option>
                                            <option value="60" <?php if($sf_user->getAttribute('sf_session_expira') == 60) echo "selected"; ?>>1 hora</option>
                                            <option value="120" <?php if($sf_user->getAttribute('sf_session_expira') == 120) echo "selected"; ?>>2 horas</option>
                                            <option value="300" <?php if($sf_user->getAttribute('sf_session_expira') == 300) echo "selected"; ?>>5 horas</option>
                                            <option value="100000" <?php if($sf_user->getAttribute('sf_session_expira') == 100000) echo "selected"; ?>>No expirar</option>
                                        </select>
                                    </div>
                                  </div>
                              </td>
                              <td class="mensaje_expira" style="color: red; display: none; cursor: pointer; vertical-align: central;" onclick="$('#menu_expira').toggle();">
                                <font>&nbsp;Su sesión expirará en&nbsp;</font>
                                <font width="5" id="expira_minutos"></font>
                                <font>&nbsp;minuto y&nbsp;</font>
                                <font width="10" id="expira_segundos"></font>
                                <font>&nbsp;segundos&nbsp;&nbsp;</font>
                              </td>
                              <?php
                                $session_usuario = $sf_user->getAttribute('session_usuario');
                                $session_funcionario = $sf_user->getAttribute('session_funcionario');
                              ?>
                              <td width="24" style="border:solid 0px red">
                                  <a href="javascript: config_menu();">
                                    <?php if(file_exists(sfConfig::get("sf_root_dir").'/web/images/fotos_personal/'.$session_funcionario['cedula'].'.jpg')){ ?>
                                        <img src="/images/fotos_personal/<?php echo $session_funcionario['cedula']; ?>.jpg" width="35"/><br/>
                                    <?php } else { ?>
                                        <img src="/images/other/siglas_photo_small_<?php echo $session_funcionario['sexo'].substr($session_funcionario['cedula'], -1); ?>.png" width="35"/><br/>
                                    <?php } ?>
                                  </a>
                              </td>
                              <td>&nbsp;<a href="javascript: config_menu()"><?php echo $session_funcionario['primer_nombre'] . ' ' . $session_funcionario['primer_apellido']; ?></a></td>
                              <td>&nbsp;<a href="javascript: config_menu()"><img src="/images/icon/config_white.png" style="vertical-align: middle"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                              <td width="24">&nbsp;</td>
                              <td>&nbsp;<a href="<?php echo sfConfig::get('sf_app_acceso_url'); ?>usuario/salir">Salir</a></td>
                          </tr>
                      </table>
                  </div>
              </td>
          </tr>
			  <div style="position: absolute; right: 0px; top: 0px; z-index: 1901;">
				<div id="manual_div" style="padding: 4px; border-radius: 10px 10px 10px 10px; background-color: #000; z-index: 200000; position: absolute; right: 0px; top: 50px; width: 550px; height:400px; display: none;">
					<div class="inner" style="border-radius: 8px 8px 8px 8px; background-color: #ebebeb; z-index: 200001; height:400px;">
						<div style="top: -15px; left: -15px; position: absolute;">
							<a href="#" onclick="javascript:cerrar_manual(); return false;"><?php echo image_tag('icon/icon_close.png'); ?></a>
						</div>
						<div id="manual_ver" style="overflow: auto; height:390px; width: 540px; top: 10px; left: 10px; position: absolute;"></div>
					</div>
				</div>
			  </div>
          <?php } ?>
    	</table>
</div>

    <div id='div_config_menu' style="z-index: 99999;">
    <div id="menu_arrow_up">
        <img src="/images/icon/menu_arrow_up.png"/>
    </div>
    <table width='100%'>
        <tr>
            <td><a class="label_link" href="<?php echo sfConfig::get('sf_app_funcionarios_url'); ?>perfil" onClick="config_menu()"><img src="/images/icon/menu_icon_perfil.png"/><br/><br/>Perfil</a></td>
            <td><a class="label_link" href="<?php echo sfConfig::get('sf_app_funcionarios_url'); ?>ficha" onClick="config_menu()"><img src="/images/icon/menu_icon_ficha.png"/><br/><br/>Ficha</a></td>
            <td><a class="label_link" href="<?php echo sfConfig::get('sf_app_acceso_url'); ?>temas" onClick="config_menu()"><img src="/images/icon/menu_icon_temas.png"/><br/><br/>Temas</a></td>
        </tr>
        <tr>
			<td>
				<br/>
			</td>
			<td></td>
			<td>
			</td>
		</tr>
        <tr>
            <td><a class="label_link" style="cursor: pointer;" onclick="javascript: open_window_calendar(); cargar_calendario(); config_menu(); return false;"><img src="/images/icon/menu_icon_calendario.png"/><br/><br/>Calendario</a></td>
            <td><a class="label_link" href="javascript:ver_manual(0); config_menu()"><img src="/images/icon/menu_icon_ayuda.png"/><br/><br/>Ayuda</a></td>
            <td><a class="label_link" href="<?php echo sfConfig::get('sf_app_acceso_url'); ?>usuario/cambioClave?user=<?php echo $session_usuario['usuario_nombre']; ?>" onClick="config_menu()"><img src="/images/icon/menu_icon_seguridad.png"/><br/><br/>Contrase&ntilde;a</a></td>
        </tr>
    </table>
    <div id="stick_more">
        <font style='position: absolute; top: 15px; left: 135px; font-size: 15px; color: #AD8686'>M&aacute;s</font>
    </div>
</div>

<div id="content_notificacion_arriba" style="position: fixed">
    <div id="content_notificacion_arriba_inner"></div>

    <div id="header_notificacion_arriba">
        <a title="Cerrar" href="#" onclick="javascript:cerrar_notibar(); return false;">
            <?php echo image_tag('other/notibar_close.png'); ?>
        </a>
    </div>
</div>

<div id="cuerpo_sesion">
    <table width="100%" border="0">
          <tr>
               <!-- ############ MENU ############ -->
              <?php
                    if ($sf_user->getAttribute('usuario_id')) {

                        // ############ URL ESCRITA  ############
                        if($sf_request->getReferer()==null || substr($sf_request->getReferer(),0,strlen("http://".$_SERVER['SERVER_NAME']))!="http://".$_SERVER['SERVER_NAME'] ){
                           $sf_user->getAttributeHolder()->clear();
                           $sf_user->setFlash('error', 'Parece que se ha intentado violar el sistema mediante URL. Se ha registrado este evento.');
                           echo "<script language='JavaScript'>location.href='".sfConfig::get('sf_app_acceso_url')."usuario';</script>";

                        }

                        // ############ PARA NO AGREGAR OTRO LAYOUT VALIDO SI ESTA LOGEADO Y CREO EL TD AMPLIO PARA EL MENU  ############
              ?>
                    <td id ="eee" width = "30" valign="top" align="center">

                      <script>
                          function mostrarmenu()
                          {
                              document.getElementById("menuidin").style.left = "-5px";
                              document.getElementById("menuidex").style.width = "250px";
                          }

                          function ocultarmenu()
                          {
                              document.getElementById("menuidin").style.left = "-196px";
                              document.getElementById("menuidex").style.width = "60px";
                          }

                          function filtrovisible()
                          {
                              document.getElementById('sf_admin_bar').style.visibility='visible';
                          }
                      </script>

                      <div id="menuidex" style="position: fixed; width: 60px; height: 0px; z-index: 1000;">
                          <table cellpadding="0" cellspacing="0" id="rrrr">
                              <tr>
                                  <td>

                                      <div id="menuidin" style="position: absolute; top: 50px; left:-196px;" onMouseover="javascript:mostrarmenu()" onmouseout="javascript:ocultarmenu()">
                                           <div id="menu_div" class="barra_herramientas_fond">
                                              <table cellpadding="0" cellspacing="0" width = "180">
                                                  <tr>
                                                      <td>
                                                          <?php
                                                          //Correspondencia sin leer
                                                          $no_leida_mia= 0;
                                                          $no_leida_otros= 0;
                                                          if($sf_user->hasAttribute('funcionario_id')) {
                                                                $funcionarios_ids= Array(0);
                                                                if($sf_user->hasAttribute('funcionario_autoridades_autorizadas')) {
                                                                    $unidad_autoridad= $sf_user->getAttribute('funcionario_autoridades_autorizadas');
                                                                    for($i=0; $i < count($unidad_autoridad); $i++) {
                                                                        $funcionarios_ids[]= $unidad_autoridad[$i]['funcionario_id'];
                                                                    }

                                                                    $recibidas_otros= Doctrine::getTable('Correspondencia_receptor')->sinLeerCantidad($funcionarios_ids);
                                                                    $no_leida_otros= $recibidas_otros[0]['total'];
                                                                }

                                                                $funcionarios_ids= Array($sf_user->getAttribute('funcionario_id'));
                                                                $recibidas_mias= Doctrine::getTable('Correspondencia_receptor')->sinLeerCantidad($funcionarios_ids);
                                                                $no_leida_mia= $recibidas_mias[0]['total'];
                                                          }

                                                          $no_leida_mia= ($no_leida_mia > 10) ? '+10' : $no_leida_mia;
                                                          $no_leida_otros= ($no_leida_otros > 10) ? '+10' : $no_leida_otros;

                                                          $icon= '';
                                                          if($no_leida_mia > 0)
                                                              $icon.= '<div title="Sin leer enviada a mí" id="icon_no_leidos"><font style="color: #ebebeb; vertical-align: middle; font-size: ' . (($no_leida_mia == '+10') ? '9' : '10') . 'px">'. $no_leida_mia .'</font></div>';
                                                          if($no_leida_otros > 0)
                                                              $icon.= '<div title="Sin leer enviada a la(s) Autoridad(es) de la Unidad" id="icon_no_leidos_otros"><font style="color: #ebebeb; vertical-align: middle; font-size: ' . (($no_leida_otros == '+10') ? '9' : '10') . 'px">'. $no_leida_otros .'</font></div>';

                                                          $menu= str_replace('###sin_leer###', ' '.$icon, $sf_user->getAttribute('zmenu'));

                                                          echo html_entity_decode($menu);
                                                          ?>

                                                      </td>
                                                  </tr>
                                              </table>
                                          </div>
                                          <div style="position: absolute; top: 0px; right: -40px;"><img src="/images/other/menu_open.png"></div>
                                      </div>

                                  </td>
                              </tr>
                          </table>
                      </div>
                  </td>
              <?php } ?>

              <td valign="top" align="left" >

                  <table width="100%" border ="0" style="border:0px red solid;">


                      <tr>
                          <td>&nbsp;&nbsp;</td>
                          <td valign="top">
                               <div class='contenido_interno'>
                      			<!-- ############ CONTENIDO22 ############ -->
					<?php echo $sf_content ?>
				</div>
                          </td>
                          <td>&nbsp;&nbsp;</td>
                      </tr>

                  </table>

              </td>
          </tr>

      </table>
</div>
  <?php
        if (!$sf_user->getAttribute('usuario_id')) {
        // ############ PARA NO AGREGAR OTRO LAYOUT VALIDO SI NO ESTA LOGEADO Y COLOCO EN ENCABEZADO VZLA  ############
  ?>
  <?php } else {
      if(!strpos($_SERVER["REQUEST_URI"], "cambioClave"))
            include_partial("global/chat");
            include_partial("global/sessionTime");
      }
      ?><div class="footer_organismo" >
      	<!--<div class="footer_imagen_organismo_izq"></div>
        <div class="footer_imagen_organismo_der"></div>
		<div class="cintfoot_nombre_organismo"><?php echo sfConfig::get('sf_organismo');?>
			<?php
			$sf_oficinasClave = sfYaml::load(sfConfig::get("sf_root_dir")."/config/siglas/oficinasClave.yml");
		?>
		 <br/>
		 <?php
		$informatica = Doctrine::getTable('Organigrama_Unidad')->find($sf_oficinasClave['informatica']['seleccion']);
		?>
		<?php
		echo $informatica->getNombre();
		?>
		<br/>
		Caracas - Venezuela - <?php echo date("Y"); ?>
		</div>-->
    	</div>
  </body>
</html>
<?php $sf_user->setAttribute('session_count_token',0); ?>
