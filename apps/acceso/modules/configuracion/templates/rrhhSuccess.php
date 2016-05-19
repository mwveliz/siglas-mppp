<fieldset id="sf_fieldset_email">
    <form method="post" action="<?php echo sfConfig::get('sf_app_acceso_url').'configuracion/saveRrhh'; ?>"> 
    <h2>Recursos Humanos</h2>
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Conexión RRHH</label>
            <div class="content">
                <div style="position: relative; height: 100px;">
                    <div style="position: absolute; top: 0px;">Servidor:</div>
                    <div style="position: absolute; top: 0px; left: 100px;">
                        <input type="text" name="rrhh[conexion_rrhh][host]" value="<?php echo $sf_rrhh['conexion_rrhh']['host']; ?>"/>
                    </div>
                    <div style="position: absolute; top: 20px;">Manejador:</div>
                    <div style="position: absolute; top: 20px; left: 100px;">
                        <select name="rrhh[conexion_rrhh][driver]" style="width: 170px;">
                            <option value=""></option>
                            <option value="pgsql" <?php if($sf_rrhh['conexion_rrhh']['driver']=="pgsql") echo "selected"; ?>>PostgreSQL</option>
                            <option value="mysql" <?php if($sf_rrhh['conexion_rrhh']['driver']=="mysql") echo "selected"; ?>>MySQL</option>
                            <option value="oracle" <?php if($sf_rrhh['conexion_rrhh']['driver']=="oracle") echo "selected"; ?>>Oracle</option>
                        </select>
                    </div>
                    <div style="position: absolute; top: 40px;">Puerto:</div>
                    <div style="position: absolute; top: 40px; left: 100px;">
                        <input type="text" name="rrhh[conexion_rrhh][port]" value="<?php echo $sf_rrhh['conexion_rrhh']['port']; ?>"/>
                    </div>
                    <div style="position: absolute; top: 60px;">Base de Datos:</div>
                    <div style="position: absolute; top: 60px; left: 100px;">
                        <input type="text" name="rrhh[conexion_rrhh][dbname]" value="<?php echo $sf_rrhh['conexion_rrhh']['dbname']; ?>"/>
                    </div>
                    <div style="position: absolute; top: 80px;">Usuario:</div>
                    <div style="position: absolute; top: 80px; left: 100px;">
                        <input type="text" name="rrhh[conexion_rrhh][user]" value="<?php echo $sf_rrhh['conexion_rrhh']['user']; ?>"/>
                    </div>
                    <div style="position: absolute; top: 100px;">Clave:</div>
                    <div style="position: absolute; top: 100px; left: 100px;">
                        <input type="text" name="rrhh[conexion_rrhh][password]" value="<?php echo $sf_rrhh['conexion_rrhh']['password']; ?>"/>
                    </div>
                </div>
                <br/><br/>
            </div>
            <div class="help">Configure los parametros de conexión con la base de datos del sistema de recursos humanos</div>
        </div>
    </div>
    
    <?php 
    if($sf_rrhh) { 
        $manager = Doctrine_Manager::getInstance()
                ->openConnection(
                $sf_rrhh['conexion_rrhh']['driver'] . '://' .
                $sf_rrhh['conexion_rrhh']['user'] . ':' .
                $sf_rrhh['conexion_rrhh']['password'] . '@' .
                $sf_rrhh['conexion_rrhh']['host'] . '/' .
                $sf_rrhh['conexion_rrhh']['dbname'], 'sistemaRRHH');
    ?>
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Recibos de Pago</label>
            <div class="content">
            </div>
            <div class="help"></div>
        </div>
    </div>
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Constancias de Trabajo</label>
            <div class="content">
            </div>
            <div class="help"></div>
        </div>
    </div>
    
    <div class="sf_admin_form_row sf_admin_text">
        <div>
            <label for="">Sueldos Basicos</label>
            <div class="content">
                <?php 
                $tipos_personal = Doctrine::getTable('VSiglasTipoPersonal')->createQuery('a')->orderBy('nombre')->execute();
                
                if($tipos_personal){
                    foreach ($tipos_personal as $tipo_personal) {
                        echo $tipo_personal->getNombre()."<br/>"; ?>
                        Concepto <select name="rrhh[documentos][conceptos_sueldo_basico][<?php echo $tipo_personal->getId(); ?>][codigo]">
                        <?php 
                        $conceptos = Doctrine::getTable('VSiglasPagosRegulares')->conceptosTipoPersonal($tipo_personal->getId());
                        foreach ($conceptos as $concepto) { 
                            echo "<option value='".$concepto->getConceptoCodigo()."'>".$concepto->getConceptoCodigo()." - ".$concepto->getConceptoDescripcion()."</option>";
                        } ?>
                        </select><br/>

                        Prefijo <input type="text" name="rrhh[documentos][conceptos_sueldo_basico][<?php echo $tipo_personal->getId(); ?>][prefijo]"/>
                    <br/><br/>
                <?php
                    }
                } else { echo "ERROR DE CONEXIÓN O DATOS CON RRHH. VERIFIQUE LOS PARAMETROS DE CONEXIÓN Y VISTAS"; }
                ?>
            </div>
            <div class="help">Seleccione los conceptos que correspondan con los sueldos basicos de cada tipo de personal.</div>
        </div>
    </div>
    <?php 
        Doctrine_Manager::getInstance()->closeConnection($manager);
    } 
    ?>
    
    <ul class="sf_admin_actions">
        <li class="sf_admin_action_save"><input value="Guardar" type="submit" id="guardar_documento"></li> 
    </ul>

    </form>         
</fieldset>