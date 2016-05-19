<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="stylesheet" type="text/css" media="screen" href="/css/main.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="/css/default.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="/css/global.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="/css/theme/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="/css/style.css" />

        <script type="text/javascript" src="/js/jquery-nucleo.js"></script>
        <script type="text/javascript" src="/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="/js/jquery-ui.js"></script>
        <script type="text/javascript" src="/js/accion.js"></script>


    </head>
    <body style="margin-right:0px; margin-left:0px; margin-top:0px" bgproperties="fixed">

        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>
                    <table width="100%">
                        <tr style="background-color: white;">
                            <td align="left">
                                <img src="/images/other/banner_izquierdo.png" />                          
                            </td>
                            <td align="right">
                                <img src="/images/other/banner_derecho.png" />                          
                            </td>
                        </tr>
                        <tr align="left">
                            <td colspan="4" class="linea_menu"  height="28" >&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- ############ MENU ############ -->


            <td valign="top">

                <table width="100%" border ="0" cellpadding="0" cellspacing="0">

                    <!-- ############ CONTENIDO ############ -->

                    <tr>
                        <td>&nbsp;&nbsp;</td>
                        <td valign="top">
                            <table align="center" border ="0" width="500">

                                <tr>
                                    <td colspan="2">
                                        <br/><br/><br/>
                                    </td>
                                </tr>
                                <tr class="alerta404">
                                    <td width="100" align="center">
                                        <img alt="login required" class="sfTMessageIcon" src="/images/other/tools48.png" />        </td>

                                    <td>
                                        <div class="sfTMessageWrap">
                                            <h1>Disculpe ha ocurrido un inconveniente</h1>
                                            <h5>Intente nuevamente.</h5>
                                        </div>
                                    </td>
                                </tr>
                                <tr>

                                    <td colspan="2" class="sfTMessageInfo">
                                        <br/><br/><br/>
                                        <ul>
                                            <div class='partial_link partial'>
                                                <a href="/acceso.php/usuario">Ir al inicio de sesión</a>                </div>


                                            <div class='partial_link partial'>
                                                <a href="javascript:history.go(-1)">Regresar a la página anterior</a>
                                            </div>

                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <br/><br/><br/>
                                    </td>
                                </tr>
                            </table>                          </td>

                        <td>&nbsp;&nbsp;</td>
                    </tr>

                </table>

            </td>
            </tr>
            <!-- ############ BARRA FINAL DE PAGUINA ############ -->
            <tr>
                <td colspan="2" height="5" bgcolor="#939090"></td>

            </tr>
            <!-- ############ ENUNCIADO FINAL DE PAGUINA ############ -->
            <tr>
              <td colspan="2" class="pie" align="center">
                    <?php echo sfConfig::get('sf_organismo'); ?>
                    <br/>
                    <b>Gerencia de Sistemas</b>
                    <br/>
                    Caracas - Venezuela - <?php echo date("Y"); ?>
              </td>
            </tr>
        </table>

    </body>
</html>
