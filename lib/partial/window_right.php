<?php use_helper('jQuery'); ?>

<script>
    function open_window_right(){
        $("#header_window_right").css('right', '-875px');
        $("#content_window_right").css('right', '-892px');
        $("#div_wait_window_right").show();

        $("#content_window_right").animate({right:"+=892px"},1000);
        $("#header_window_right").animate({right:"+=892px"},1000);
    };

    function close_window_right(){
        $("#content_window_right").animate({right:"-=892px"},1000);
        $("#header_window_right").animate({right:"-=892px"},1000);
        $("#div_wait_window_right").hide();

        $('#content_window_right').html('');
        
        //codigo para borrar variables creadas si se cierra la ventana
        $.ajax({
            url:'<?php echo sfConfig::get('sf_app_correspondencia_url'); ?>formatos/cleanSession',
            type:'POST',
            dataType:'html'
        });
    };
    
    function close_window_right_update_father(){
        $("#content_window_right").animate({right:"-=892px"},1000);
        $("#header_window_right").animate({right:"-=892px"},1000);
        $("#div_wait_window_right").hide();

        $('#content_window_right').html('');
        window.location.reload();
    };
</script>

<div id="div_wait_window_right" 
     style="display: none; position: fixed; 
            left: 0px; top: 0px; width: 100%; 
            height: 100%; background-color: black; 
            opacity: 0.4; filter:alpha(opacity=40); 
            z-index: 999;">&nbsp;
</div>

<div id="header_window_right">
    <a title="Cerrar" href="#" onclick="javascript:close_window_right(); return false;">
        <?php echo image_tag('other/menu_close.png'); ?>
    </a>
</div>

<div id="content_window_right"></div>
