
	<div align="center">	
            <table border="0" width="600" style='border:blue solid 0px;'>
                <tr>
                    <td align="center">
                        <?php
                        if ($sf_user->hasFlash('actualizar')) {
                            $sf_user->getFlash('actualizar');
                            $agente = $_SERVER["HTTP_USER_AGENT"];
                            if (preg_match("/Firefox\/2\./", $agente) ||
                                preg_match("/Firefox\/3\./", $agente) ||
                                preg_match("/Firefox\/4\./", $agente) ||
                                preg_match("/Firefox\/5\./", $agente) ||
                                preg_match("/Firefox\/6\./", $agente) ||
                                preg_match("/Firefox\/7\./", $agente) ||
                                preg_match("/Firefox\/8\./", $agente) ||
                                preg_match("/Firefox\/9\./", $agente) ||
                                preg_match("/Firefox\/10\./", $agente) ||
                                preg_match("/Firefox\/11\./", $agente) ||
                                preg_match("/Firefox\/12\./", $agente) ||
                                preg_match("/Firefox\/13\./", $agente) ||
                                preg_match("/Firefox\/14\./", $agente) ||
                                preg_match("/Firefox\/15\./", $agente) ||
                                preg_match("/Firefox\/16\./", $agente) ||
                                preg_match("/Firefox\/17\./", $agente) ||
                                preg_match("/Firefox\/18\./", $agente) ||
                                preg_match("/Firefox\/19\./", $agente) ||
                                preg_match("/Firefox\/20\./", $agente) ||
                                preg_match("/Firefox\/21\./", $agente) ||
                                preg_match("/Firefox\/22\./", $agente) ||
                                preg_match("/Firefox\/23\./", $agente) ||
                                preg_match("/Firefox\/24\./", $agente)) {
                                $nav = "Firefox";
                                $url = "http://www.mozilla.org/es-ES/firefox/new/";
                            } elseif (preg_match("/MSIE 4./",$agente) ||
                                preg_match("/MSIE 4\./",$agente) ||
                                preg_match("/MSIE 5\./",$agente) ||
                                preg_match("/MSIE 6\./",$agente) ||
                                preg_match("/MSIE 7\./",$agente) ||
                                preg_match("/MSIE 8\./",$agente) ||
                                preg_match("/MSIE 9\./",$agente)) {
                                $nav = "Internet Explorer";
                                $url = "http://windows.microsoft.com/es-es/internet-explorer/downloads/ie";
                            } elseif (preg_match("/Opera\/8./",$agente) ||
                                preg_match("/Opera\/8\./",$agente) ||
                                preg_match("/Opera\/9\./",$agente) ||
                                preg_match("/Opera\/10\./",$agente) ||
                                preg_match("/Opera\/11\./",$agente)) {
                                $nav = "Opera";
                                $url = "http://www.opera.com/download/";
                            } elseif (preg_match("/Chrome\/6./", $agente) ||
                                preg_match("/Chrome\/6\./", $agente) ||
                                preg_match("/Chrome\/7\./", $agente) ||
                                preg_match("/Chrome\/8\./", $agente) ||
                                preg_match("/Chrome\/9\./", $agente) ||
                                preg_match("/Chrome\/10\./", $agente) ||
                                preg_match("/Chrome\/11\./", $agente) ||
                                preg_match("/Chrome\/12\./", $agente) ||
                                preg_match("/Chrome\/13\./", $agente) ||
                                preg_match("/Chrome\/14\./", $agente) ||
                                preg_match("/Chrome\/15\./", $agente) ||
                                preg_match("/Chrome\/16\./", $agente) ||
                                preg_match("/Chrome\/17\./", $agente) ||
                                preg_match("/Chrome\/18\./", $agente) ||
                                preg_match("/Chrome\/19\./", $agente) ||
                                preg_match("/Chrome\/20\./", $agente) ||
                                preg_match("/Chrome\/21\./", $agente) ||
                                preg_match("/Chrome\/22\./", $agente) ||
                                preg_match("/Chrome\/23\./", $agente) ||
                                preg_match("/Chrome\/24\./", $agente) ||
                                preg_match("/Chrome\/25\./", $agente) ||
                                preg_match("/Chrome\/26\./", $agente) ||
                                preg_match("/Chrome\/27\./", $agente) ||
                                preg_match("/Chrome\/28\./", $agente) ||
                                preg_match("/Chrome\/29\./", $agente) ||
                                preg_match("/Chrome\/30\./", $agente)) {
                                $nav = "Chrome";
                                $url = "https://www.google.com/chrome?hl=es";
                            }
                            ?>

                            <div style="position: absolute; background-color: white; text-align: center;">
                                <h2 style="background-color: #DFD8D8;">¡¡¡UPSS!!! Se ha detectado una versión antigua de "<?php echo $nav; ?>"</h2>
                                <div style="position: relative; width: 650px; background-color: white; text-align: justify;">
                                    Bienvenido una vez mas al Sistema de Correspondencia, para nosotros el mejoramiento continuo de esta herramienta es de gran importancia,
                                    es por ello que siempre estamos actualizándonos a las ultimas tecnologías de la Web. 
                                    Por este motivo se han desarrollado mejoras que tu navegador no puede manejar, es
                                    por ello que te invitamos a actualizar tu navegador y así poder seguir disfrutando del Sistema de Correspondencia y todos sus beneficios.
                                </div><br/><br/>
                                <div style="position: relative; width: 650px; background-color: white; text-align: justify;">
                                    Para actualizar tu <b><?php echo $nav; ?></b> ingresa en <a href="<?php echo $url; ?>"><?php echo $nav ?></a> para descargar la ultima versión o comunícate con la 
                                    Oficina de Tecnología.<br/><br/>
                                    <?php if ($nav == "Internet Explorer") { ?>
                                        Te recomendamos cambiar tu navegador a uno basado en software libre como: "Firefox" o "Chrome", para un uso y resguardo más seguro de tu información
                                    <?php } ?>
                                    <br/>
                                    <br/>
                                </div>
                                <div style="position: absolute; top: 50px; left: -80px; z-index: 100;"><?php echo image_tag("other/firefox.jpg"); ?></div>
                                <div style="position: absolute; top: 50px; right: -80px; z-index: 100;"><?php echo image_tag("other/opera.jpg"); ?></div>
                            </div>
                            <?php } ?>
			<div style="padding-bottom:20%;padding-top:20%;">
                        <table style="width:600px;border:green solid 0px;">
                            
                            <tr>
                                <td>
                                    <table border='0' >
                                        <?php if ($sf_user->hasFlash('notice')): ?>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="tr_n"><?php echo $sf_user->getFlash('notice') ?></div><br/>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if ($sf_user->hasFlash('error')): ?>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="tr_e"><?php echo $sf_user->getFlash('error') ?></div><br/>
                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                        <form id="formlogin" name="formlogin" method="post" action="<?php echo sfConfig::get('sf_app_acceso_url'); ?>usuario/login">
                                            <tr  height='40px'>
                                                <td width='10px' align='center'><div class='estilo_letra' style='font-size:20px; position:relative; left:-20px'>Usuario</div></td>
                                                <td width='150px' align='left'><input class='inputText_sesion' value="" name="usuario" type="text" style="width: 250px;"/></td>
                                            </tr>
                                            
                                            <tr height='40px'>
                                                <td width='10px' align='center'><div class='estilo_letra' style='font-size:20px; position:relative; left:-20px'>Contraseña</div></td>
                                                <td width='350px' align='left'><input class='inputText_sesion' name="contrasena" value="" type="password" style="width: 250px;"/></td>
                                            </tr>
                                            <tr>
												<td width='300px' align='center'><a style="text-decoration: none; font-size: 12px" href="<?php echo sfConfig::get('sf_app_acceso_url'); ?>"><div></a>&nbsp;
                                                <td width='300px' valign="top" align='center'>
                                                    <input name="entrar" type = "submit" value="Iniciar Sesi&oacute;n"/>
                                                </td>
                                            </tr>
                                        </form>
                                    </table>
                                    
                                </td>
                            </tr>
                      <!--                            <tr>
                                <td align="center">
                                    <table border="0" width="350">
                                        <?php if ($sf_user->hasFlash('error_doc')): ?>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="tr_e"><?php echo $sf_user->getFlash('error_doc') ?></div><br/>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <form id="formdoc" name="formdoc" method="post" action="<?php echo sfConfig::get('sf_app_herramientas_url'); ?>sigefirrhh/validar">
                                            <tr>
                                                <td rowspan="4"  align="center"><?php echo image_tag("icon/okdoc.png"); ?></td>
                                                <td colspan="2"><b>Validación de Documentos<b/><br/>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>Código</td>
                                                <td><input name="codigo" type="text" style="width: 190px;"/></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td valign="top"><input name="consultar" type = "submit" value="Consultar"/></td>
                                            </tr>
                                        </form> 
                                    </table>
                                </td>
                            </tr>-->
                        </table>
			</div>
                    </td>
                </tr>
            </table>
</div>
