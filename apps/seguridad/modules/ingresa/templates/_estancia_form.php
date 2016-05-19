<div class="sf_admin_form_row sf_admin_text">
    <div id="error_pase" class="error" style="display: none;"></div>
    <div>
        <label for="">N° de pase</label>
        <div class="content" id="llave_ingreso_id">
            <input id="seguridad_ingreso_llave_ingreso_id" name="seguridad_ingreso[llave_ingreso_id]" maxlength="4" size="4" onkeydown="return solo_num(event)"/>
            <script>
                var key_into = new Array();
                <?php
                $llaves_ocupadas = Doctrine::getTable('Seguridad_LlaveIngreso')->getAllOrderBy(array('n_pase'));
                
                foreach ($llaves_ocupadas as $llave_ocupada) {
                    echo "key_into[".$llave_ocupada->getNPase()."] = '".$llave_ocupada->getStatus()."';";
                }
                ?>
            </script>
        </div>
    </div>
</div>