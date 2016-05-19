<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$filename=explode('/', $_REQUEST['filename']);
$p_id=$_REQUEST['p_id'];
$imagen = $filename[9];

$conn_string = "host=localhost port=5432 dbname=centros_dbv2 user=u_fmnh password=123456";
$dbconn = pg_connect($conn_string);
if (!$dbconn) {
  echo "<b>Ocurrio un error inesperado Procesando la imagen <br />. Contacte al administrador del sistema\n</b>";
  exit();
}

pg_close($dbconn);

$query = "INSERT INTO persona_imagen (persona_id,imagen) VALUES (".$p_id.",'".$imagen."');";

$dbconn = pg_connect($conn_string);
pg_query($dbconn, $query);
pg_close($dbconn);
    
$query = "SELECT * FROM persona_imagen where persona_id = ".$p_id." order by id desc limit 1;";
$dbconn = pg_connect($conn_string);
$result = pg_query($dbconn, $query);
while ($row = pg_fetch_row($result)) {
    $load_img = $row[2];
}
pg_close($dbconn);

?>
<link rel="stylesheet" type="text/css" media="screen" href="/css/styles_form.css" />        
<style type="text/css">

#camera {
    background: url("/images/cam_bg.jpg") repeat-y scroll 0 0 transparent;
    border: 1px solid #F0F0F0;
    border-radius: 5px;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.6);
    height: 390px;
    width: 450px;

}

#camera_content {
 width:450px
}

#btn_camara{
    position: relative;
    text-align: center;
    top:-35px;
}
</style>

<div id="camera">
    <div id="flash_notice" style="display: block; width:400px"">
            Se han guardado los datos correctamente!          
    </div>
    <p style="text-align: center">
        <img src="/uploads/persona/<?php echo $load_img; ?>">
    </p>
    <p style="text-align: center">
        <b><a href="#" onclick="parent.location.reload().window.close( )">Cierre la ventana para continuar !</a></b>
    </p>   
</div>
