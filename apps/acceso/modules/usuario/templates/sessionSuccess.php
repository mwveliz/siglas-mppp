<?php $session_usuario = $sf_user->getAttribute('session_usuario'); ?>
<table width="100%">
    <?php if ($sf_user->hasFlash('notice')): ?>
    <tr>
        <td colspan="2">
            <div class="tr_n"><?php echo $sf_user->getFlash('notice') ?></div><br/>
        </td>
    </tr>
    <?php endif; ?>
    <?php if ($sf_user->hasFlash('error')): ?>
    <tr>
        <td colspan="2">
            <div class="tr_e"><?php echo $sf_user->getFlash('error') ?></div><br/>
        </td>
    </tr>
    <?php endif; ?>

    <tr>
        <td>
            <table>
                <tr>
                    <?php if($session_usuario['enlace_id']==1) { ?>
                    <td>
                        <?php
                            // BUSCA SI EL FUNCIONARIO TIENE LOS DATOS BASICO COMPLETOS
                            $datos_iniciales_personal = Doctrine::getTable('Funcionarios_Funcionario')->find($sf_user->getAttribute('funcionario_id'));
                            $anio_inicio = date('Y')-80; $anio_inicio = $anio_inicio.'-01-01';
                            
                            if($datos_iniciales_personal['f_nacimiento']<$anio_inicio || $datos_iniciales_personal['estado_nacimiento_id'] == '' || $datos_iniciales_personal['sexo'] == '' || $datos_iniciales_personal['edo_civil'] == '') {
                                // SI NO TIENE LOS DATOS BASICOS COMPLETOS MUESTRA EL FORMULARIO DE DATOS BASICOS
                                include_partial('usuario/informacion_inicial_personal');
                            } else {
                                // SI YA TIENE LOS DATOS BASICOS COMPLETOS
                                $supervisores_good = TRUE;
                                $session_cargos = $sf_user->getAttribute('session_cargos');

                                foreach ($session_cargos as $session_cargo) {
                                    // BUSCA SI ALGUNO DE SUS CARGOS NO TIENE SUPERVISOR INMEDIATO
                                    
                                    if($supervisores_good == TRUE){
                                        $datos_iniciales_laboral = Doctrine::getTable('Organigrama_Cargo')->find($session_cargo['cargo_id']);

                                        if($datos_iniciales_laboral->getPadreId() == '') {
                                            // SI NO TIENE SUPERVISOR INMEDIATO EL CARGO MOSTRAR FORMULARIO DE DATOS LABORALES
                                            $supervisores_good = FALSE;
                                            include_partial('usuario/informacion_inicial_laboral', array('supervisor_cargo_id'=>$session_cargo['cargo_id']));
                                        } else {
                                            // REVISAR SI EL SUPERVISOR INMEDIATO QUE SELECCIONO TODAVIA EXISTE
                                            $supervisor = Doctrine::getTable('Funcionarios_FuncionarioCargo')->findOneByCargoIdAndStatus($datos_iniciales_laboral->getPadreId(),'A');
                                            $funcionario_sup = Doctrine::getTable('Funcionarios_Funcionario')->find($supervisor['funcionario_id']);
                                            if(!$funcionario_sup){
                                                //SI EL SUPERVISOR INMEDIATO FUE CAMBIADO MOSTRAR FORMULARIO DE INFORMACION LABORAL PARA SELECCIONAR UN NUEVO SUPERVISOR
                                                $supervisores_good = FALSE;
                                                include_partial('usuario/informacion_inicial_laboral', array('supervisor_cargo_id'=>$session_cargo['cargo_id'], 'supervisor_cambiado'=>TRUE));
                                            }                                                                      
                                        }
                                    }
                                }
                                
                                // SI EL FUNCIONARIO NO HA VALIDADO UN EMAIL MOSTRAR FORMULARIO DE VALIDACION DE EMAIL
                                if($datos_iniciales_personal['email_validado'] != TRUE && $supervisores_good == TRUE) {
                                    include_partial('usuario/informacion_inicial_contacto');
                                }  
                            }
                        ?>
                        <table>
                            <tr>
                                <td>
                                    <?php if(file_exists(sfConfig::get("sf_root_dir").'/web/images/fotos_personal/'.$datosfuncionario_list[0]['ci'].'.jpg')){ ?>
                                        <img src="/images/fotos_personal/<?php echo $datosfuncionario_list[0]['ci']; ?>.jpg" width="150"/><br/>
                                    <?php } else { ?>
                                        <img src="/images/other/siglas_photo_small_<?php echo $datosfuncionario_list[0]['sexo'].substr($datosfuncionario_list[0]['ci'], -1); ?>.png" width="150"/><br/>
                                    <?php } ?>
                                </td>
                                <td>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                                <td>
                        
                        <h2>
                            <?php
                                echo $datosfuncionario_list[0]['primer_apellido'].' '.
                                     $datosfuncionario_list[0]['segundo_apellido'].', '.
                                     $datosfuncionario_list[0]['primer_nombre'].' '.
                                     $datosfuncionario_list[0]['segundo_nombre'].' ';
                            ?>
                        </h2>

                        <b>Cédula</b>&nbsp;&nbsp;<?php echo $datosfuncionario_list[0]['ci']; ?><br/><br/>

                        <?php  foreach ($datosfuncionario_list as $datosfuncionario) { ?>
                    
                        <table>
                            <tr>
                                <td colspan="2"><h2><?php echo $datosfuncionario->getUnombre(); ?></h2></td>
                            </tr>
                            <tr>
                                <td><b>Condición</b></td>
                                <td><?php echo $datosfuncionario->getCcnombre(); ?></td>
                            </tr>
                            <tr>
                                <td><b>Tipo</b></td>
                                <td><?php echo $datosfuncionario->getCtnombre(); ?></td>
                            </tr>
                            <tr>
                                <td><b>Grado</b></td>
                                <td><?php echo $datosfuncionario->getCgnombre(); ?></td>
                            </tr>
                            <tr>
                                <td><b>Código de Nómina</b>&nbsp;&nbsp;</td>
                                <td><?php echo $datosfuncionario->getCnomina(); ?></td>
                            </tr>
                        </table>

                        <?php }?>
                        
                                </td>
                            </tr>
                        </table>

                    </td>
                    <?php } //elseif($session_usuario['enlace_id']==2) { ?>
<!--                    <td>
                        <h2>
                            <b>RIF</b>&nbsp;&nbsp;<?php echo $datosproveedor_list['rif']; ?><br/><br/>
                        </h2>

                        <table>
                            <tr>
                                <td><b>Razon Social</b></td>
                                <td><?php echo $datosproveedor_list['razon_social']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Tipo de Proveedor&nbsp;&nbsp;</b></td>
                                <td><?php echo $datosproveedor_list['tipo_empresa']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Sector</b></td>
                                <td><?php echo $datosproveedor_list['sector']; ?></td>
                            </tr>
                        </table>

                    </td>-->
                    <?php //} ?>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td colspan="2"><h2>USUARIO <?php echo strtoupper($session_usuario['usuario_nombre']); ?></h2></td>
                            </tr>
                            <tr>
                                <td><b>Ultima conexión</b></td>
                                <td><?php echo date('d-m-Y g:i:s a', strtotime($session_usuario['ultima_conexion'])); ?></td>
                            </tr>
                            <tr>
                                <td><b>Cantidad de Visitas&nbsp;&nbsp;</b></td>
                                <td><?php echo $session_usuario['visitas']; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
        <td width="271">
           
        </td>

    </tr>
    <tr>
        <td>

        </td>
    </tr>
</table>
