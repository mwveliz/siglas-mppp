<html><body>
<?php

$conn_string = "host=localhost port=5432 dbname=centros_dbv2 user=u_fmnh password=123456";
$dbconn = pg_connect($conn_string);
if (!$dbconn) {
  echo "<b>Ocurrio un error inesperado. Contacte al administrador del sistema\n</b>";
  exit;
}

pg_close($dbconn);

?>
<!-- First, include the JPEGCam JavaScript Library -->
	<script type="text/javascript" src="webcam.js"></script>
	<!-- Configure a few settings -->
	<script language="JavaScript">
		webcam.set_api_url( 'test.php' );
		webcam.set_quality( 100 ); // JPEG quality (1 - 100)
		webcam.set_shutter_sound( false ); // play shutter click sound
	</script>
<link rel="stylesheet" type="text/css" media="screen" href="/css/styles_form.css" />        
<style type="text/css">

#camera {
    background: url("/images/cam_bg.jpg") repeat-y scroll 0 0 transparent;
    border: 1px solid #F0F0F0;
    border-radius: 5px;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.6);
    height: 380px;
    width: 450px;

}

#camera_content {
 width:450px;
 height: 600px
}

#btn_camara{
    position: relative;
    text-align: center;
    top:-35px;
}
</style>

<div id="camera_content">
    <div id="camera">
        <br />
        <p style="text-align: center;">
                <script language="JavaScript">
                    document.write( webcam.get_html(400, 300) );
                </script>
        </p>
        
    </div>
    <div id="btn_camara">
        <button  type="button" class="btn primary-btn" onClick="webcam.freeze()">Capturar</button>
        <button  type="button" class="btn primary-btn" onClick="do_upload()">Guardar</button>
        <button  type="button" class="btn primary-btn" onClick="webcam.reset()">Reset</button>
    </div>
	<script language="JavaScript">
		webcam.set_hook( 'onComplete', 'my_completion_handler' );

		function do_upload() {
			// upload to server
			document.getElementById('upload_results').innerHTML = '<h2>Cargando...</h2>';
			webcam.upload();
		}

		function my_completion_handler(msg) {
			// extract URL out of PHP output
			if (msg.match(/(http\:\/\/\S+)/)) {
				var image_url = RegExp.$1;
				// show JPEG image in page
				document.getElementById('upload_results').innerHTML =
					'<h2>Cargando Imagen..!</h2>' +
					'<!--h3>JPEG URL: ' + image_url + '</h3-->' +
					'<img src="' + image_url + '">';

				// reset camera for another shot
				webcam.reset();
                                window.location.href = 'save_picture.php?filename='+image_url+'&p_id=<?php echo $_REQUEST['p_id']?>';
			}
			else alert("PHP Error: " + msg);
		}
	</script>
    <div id="upload_results" style="background-color:#eee;"></div>

</div>
</body></html>