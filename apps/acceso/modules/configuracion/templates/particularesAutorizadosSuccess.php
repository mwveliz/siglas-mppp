<br />Funcionarios:<br />    
<select name="sms[aplicaciones][mensajes_externos][autorizados_particulares][unico][funcionario]" id="autorizados_particulares_funcionario_id">
      <?php foreach ($funcionarios as $funcionario) { ?>
      <option value="<?php echo $funcionario->getId()?>" <?php if($funcionario->getId() == $funcionario_selected) echo "selected"; ?>>
            <?php echo $funcionario->getCtnombre(); ?> /
            <?php echo $funcionario->getPrimer_nombre(); ?>
            <?php echo $funcionario->getSegundo_nombre(); ?>,
            <?php echo $funcionario->getPrimer_apellido(); ?>
            <?php echo $funcionario->getSegundo_apellido(); ?>
      </option>
      <?php } ?>
   </select>

   <?php
   $device= Sms::count_device();
   //SI SOLO HAY UN MODEM SIEMPRE ENVIA 'ALL'
   if (is_array($device)) {
        if (count($device) > 1) {
            $nodevice= false;
            $cadena_mod = "<br/><br/>Modems asisgnados:&nbsp;<br/>";
            for ($i = 0; $i < count($device); $i++) {
                $cadena_mod.= "<input type='checkbox' class='parti_unico_modem' checked name='sms[aplicaciones][mensajes_externos][autorizados_particulares][unico][modems][]' value='" . $device[$i]['id'] . "'>&nbsp;<font style='vertical-align: top'>" . $device[$i]['id'] . "</font><br/>";
            }
            echo $cadena_mod . ' ';
        } else {
            $nodevice= true;
            $cadena_mod = "<input type='hidden' name='sms[aplicaciones][mensajes_externos][autorizados_particulares][unico][modems][]' value='' />";
            echo $cadena_mod . '<br/>';
        }
   }else {
        $nodevice = true;
        $cadena_mod = "<input type='hidden' name='sms[aplicaciones][mensajes_externos][autorizados_particulares][unico][modems][]' value='' />";
        echo $cadena_mod . '<br/>';
   }
   ?>

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <a class='partial_new_view partial' href="#" onclick="javascript: fn_agregar_particular(<?php echo $nodevice ?>); return false;">Agregar otro</a><br/><br/>