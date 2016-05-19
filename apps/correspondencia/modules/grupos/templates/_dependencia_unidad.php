<?php use_helper('jQuery'); ?>
<?php $unidades = Doctrine::getTable('Organigrama_Unidad')->combounidad(); ?>

<div class="sf_admin_form_row sf_admin_foreignkey sf_admin_form_field_correspondencia_funcionario_unidad_dependencia_unidad_id">
    <div>
        <label for="correspondencia_funcionario_unidad_dependencia_unidad_id">Unidad</label>
        <div class="content">
            <select name="correspondencia_funcionario_unidad[dependencia_unidad_id]" id="correspondencia_funcionario_unidad_dependencia_unidad_id" onchange="
                <?php
                    echo jq_remote_function(array('update' => 'funidad',
                    'url' => 'grupos/funcionarioAutorizadoCorrespondencia',
                    'with'     => "'u_id=' +this.value+'&ua_id=' +$('#correspondencia_funcionario_unidad_autorizada_unidad_id').val()",)) ?>">

                    <option value=""></option>

                <?php foreach( $unidades as $clave=>$valor ) { 
                    if($clave != '') { ?>
                    <option value="<?php echo $clave; ?>" <?php if($clave == $form['dependencia_unidad_id']->getValue()) echo "selected"; ?>>
                        <?php echo $valor; ?>
                    </option>
                <?php }} ?>
            </select>

        </div>
    </div>
</div>