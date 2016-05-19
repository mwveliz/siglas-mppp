<div style="width: 300px; max-height: 150px; overflow-y: auto; overflow-x: auto; font-size: 10px;">
<pre>
<?php
$parametros_salida = sfYaml::load($siglas_servicios_disponibles->getParametrosSalida());
print_r($parametros_salida);
?>
</pre>
</div>