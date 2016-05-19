<?php
$correlativos = $valores['correlativos'];
    foreach ($correlativos as $correlativo) {
    echo $correlativo->getUltimoCorrelativo().'<br/>';
}

?>