<?php use_helper('jQuery'); ?>

<script>
    $(document).ready(function(){
        $("form").submit(function() {
            
            if ($("#archivo_estante_unidad_duena_id").val() == "") {
                $("#error_unidad_autoriza").show();
                return false;
            } else  {
                return true;
            }
        });
    });
</script>

<?php
$boss= false;
if($sf_user->getAttribute('funcionario_gr') == 99) {
    $boss= true;
    $funcionario_unidades_cargo = Doctrine::getTable('Funcionarios_FuncionarioCargo')->unidadDelCargoDelFuncionario($sf_user->getAttribute('funcionario_id'));
}

$funcionario_unidades_admin = Doctrine::getTable('Archivo_FuncionarioUnidad')->adminFuncionarioGrupo($sf_user->getAttribute('funcionario_id'));

$cargo_array= array();
if($boss) {
    foreach($funcionario_unidades_cargo as $unidades_cargo) {
        $cargo_array[]= $unidades_cargo->getUnidadId();
    }
}

$admin_array= array();
for($i= 0; $i< count($funcionario_unidades_admin); $i++) {
    $admin_array[]= $funcionario_unidades_admin[$i][0];
}

$nonrepeat= array_merge($cargo_array, $admin_array);

$funcionario_unidades= array();
foreach ($nonrepeat as $valor){
    if (!in_array($valor, $funcionario_unidades)){
        $funcionario_unidades[]= $valor;
    }
} ?>

<div class="sf_admin_form_row sf_admin_foreignkey sf_admin_form_field_archivo_estante_unidad_duena_id">
    <div class="error" id="error_unidad_autoriza" style="display: none;">Seleccione la unidad dueña del estante que esta creando.</div>
    <div>
        <label for="archivo_estante_unidad_duena_id">Unidad</label>
        <div class="content">
            <select name="archivo_estante[unidad_duena_id]" id="archivo_estante_unidad_duena_id">

                <?php 
                if(count($funcionario_unidades)>1) { ?>
                    <option value=""></option>
                <?php } ?>
                <?php foreach( $funcionario_unidades as $unidades ) { 
                    $unidad = Doctrine_Core::getTable('Organigrama_Unidad')->find($unidades);
                    ?>
                    <option value="<?php echo $unidades; ?>" <?php if($unidades == $form['unidad_duena_id']->getValue()) echo "selected"; ?>>
                        <?php echo $unidad->getNombre(); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>