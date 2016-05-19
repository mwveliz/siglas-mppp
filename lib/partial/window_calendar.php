<script>
    jQuery(function($) {
            $.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '<Ant',
                nextText: 'Sig>',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                weekHeader: 'Sm',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''};
            $.datepicker.setDefaults($.datepicker.regional['es']);
    });
    function open_window_calendar(){
        $("#header_window_calendar").css('right', '-875px');
        $("#content_window_calendar").css('right', '-892px');
        $("#div_wait_window_calendar").show();

        $("#content_window_calendar").animate({right:"+=892px"},1000);
        $("#header_window_calendar").animate({right:"+=892px"},1000);
    };

    function close_window_calendar(){
        $("#content_window_calendar").animate({right:"-=892px"},1000);
        $("#header_window_calendar").animate({right:"-=892px"},1000);
        $("#div_wait_window_calendar").hide();

        $('#content_window_calendar').html('');
    };
    
    function cargar_calendario(id){
        $('#content_window_calendar').html('<?php echo image_tag('icon/cargando.gif', array('size'=>'25x25')); ?> Cargando calendario...');
        jQuery.ajax({
            url:'<?php echo sfConfig::get('sf_app_herramientas_url'); ?>calendario',
            type:'POST',
            dataType:'html',
            data: "usuario_delega_id="+id,
            success:function(data, textStatus){
                $('#content_window_calendar').html(data);
            },
            complete: function () { 
                $('#startTime').datepicker({
                    autoSize: true,
                    constrainInput: true,
                    dateFormat: 'yy-mm-dd',
                    onSelect: function(dateText, inst) {
                        $('#endTime').datepicker('option', 'minDate', dateText);
                    }
                });
                $('#endTime').datepicker({
                    autoSize: true,
                    constrainInput: true,
                    dateFormat: 'yy-mm-dd',
                    onSelect: function(dateText, inst) {
                        $('#startTime').datepicker('option', 'maxDate', dateText);
                    },
                    onOpen: function(dateText, inst) {
                          alert("My date is: " + dateText);
                    }
                });
            }
        });
    }
    
    function complete()
    {
            $("#reset").click(function() {
                $("#eventName").val('');
                $("#startTime").val('');
                $("#endTime").val('');
                $("#eventName").focus();
                $('#endTime').datepicker("option", "minDate", "")
                $('#startTime').datepicker("option", "maxDate", "")
            });
    }
</script>

<div id="div_wait_window_calendar" 
     style="display: none; position: fixed; 
            left: 0px; top: 0px; width: 100%; 
            height: 100%; background-color: black; 
            opacity: 0.4; filter:alpha(opacity=40); 
            z-index: 999;">&nbsp;
</div>

<div id="header_window_calendar">
    <a title="Cerrar" href="#" onclick="javascript:close_window_calendar(); return false;">
        <?php echo image_tag('other/menu_close.png'); ?>
    </a>
</div>
<div>
    <div id="content_window_calendar"></div>
    <script type="text/javascript" id="javascript">
    </script>
</div>