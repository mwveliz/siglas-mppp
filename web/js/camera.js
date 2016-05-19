webcam.set_api_url('/picture/htdocs/test.php');
webcam.set_quality(100); // JPEG quality (1 - 100)
webcam.set_shutter_sound(false); // play shutter click sound

webcam.set_hook('onComplete', 'my_completion_handler');
function do_freeze() {
    // freeze image
    webcam.freeze();
    $("#btn_capturar").fadeOut(100);
    $("#btn_guardar").fadeIn(200);
    $("#btn_reset").fadeIn(200);
    $("#button_guardar").show();

}
function do_reset() {
    // reset image
    $("#btn_capturar").fadeIn(200);
    $("#btn_guardar").fadeOut(200);
    $("#btn_reset").fadeOut(200);
    $("#webcam").show();
    $("#fotografia").fadeIn(200);
    $("#camera_imagen").hide();
    webcam.reset();

}

function ShowError(json) {
    alert(json[0]._notice);
}
