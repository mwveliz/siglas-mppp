$(document).ready(function()
{
    $('#menu').parent().css('padding', '4px');
    $(".sf_admin_td_actions a").each(function(i, el)
    {
        el.title = el.innerHTML;
        el.innerHTML = '&nbsp;'
    });
        
    $(".sf_admin_actions  li  a").each(function (){
        $("#sf_admin_header").append($(this).parent().clone());
    });
   

    $("#sf_admin_header").wrapInner('<ul class="sf_admin_actions">');
    
    $("[class=sf_admin_actions]"). addClass('trans');

    $(".error_list li").each(function(i, el)
    {
        if($(this).text()=='Required.'){
            $(this).html('Requerido.');
    }
    });
    
    $('#sf_admin_content img').each(function() {
        $(this).attr("src", $(this).attr("src").replace('/images/../images/', '/images/icon/'));
    });
    
//    $('.sf_admin_pagination a img').each(function() {
//        $(this).attr("src", $(this).attr("src").replace('/images/../images/', '/images/icon/'));
//    });
    
    $('.sf_admin_boolean img').each(function() {
        $(this).attr("src", $(this).attr("src").replace('/images/../images/', '/images/icon/'));
    });

    $(".sf_admin_filter label").each(function(i, el)
    {
        if($(this).text()=='is empty'){
            $(this).html('Vacio.');}
    });
    $(".sf_admin_filter").dialog({width: 500, autoOpen: false, title: "Filtro"});


    $(".abrir_detalles").click(function (){
        if ($(this).next().is(":visible")){
            $(this).next().slideUp('slow');

            $(this).children().not(".no").text('Mostrar');
            $(this).removeClass("partial_close").addClass("partial_open");
        }else{
            $(this).next().slideDown('slow');

            $(this).children().not(".no").text('Ocultar');
            $(this).removeClass("partial_open").addClass("partial_close");
        }
    })
    
    $(".mielemento").fadeIn(100)
    .animate({top:"-=20px"},100).animate({top:"+=20px"},100)
    .animate({top:"-=20px"},100).animate({top:"+=20px"},100)
    .animate({top:"-=20px"},100).animate({top:"+=20px"},100)
    .animate({top:"-=20px"},100).animate({top:"+=20px"},100)
    .animate({top:"-=20px"},100).animate({top:"+=20px"},100)
    .animate({top:"-=20px"},100).animate({top:"+=20px"},100)
    .animate({top:"-=20px"},100).animate({top:"+=20px"},100);     
    
    $(".abrir_config").click(function (){
        if ($(this).parent().parent().find("div.detalles:visible").length >0){
            $(this).parent().parent().find("div.detalles").slideUp();

//            $(this).text('Mostrar');
//            $(this).parent().removeClass("partial_close").addClass("partial_open");
        }else{
            $(this).parent().parent().find("div.detalles").slideDown();

//            $(this).text('Ocultar');
//            $(this).parent().removeClass("partial_open").addClass("partial_close");
        }
    });

    $(".abrir_detalles_hijos").click(function (){

        if ($(this).parent().parent().find("div.detalles_hijos:visible").length >0){
            $(this).parent().parent().find("div.detalles_hijos").slideUp();

            $(this).parent().removeClass("partial_close").addClass("partial_open");
        }else{
            $(this).parent().parent().find("div.detalles_hijos").slideDown();

            $(this).parent().removeClass("partial_open").addClass("partial_close");
        }
    });
    

    
    $('.degradado').gradient({
            from:      '04B404',
            to:        'FFFFFF',
            direction: 'vertical',
            position:  'left'
    });
    
    if(!$.isEmptyObject($.find('#content_notificacion_derecha'))){
        var height_noti_izq = parseFloat(($("#content_notificacion_derecha").css("height")).replace('px','')) - 69;
        $("#content_notificacion_derecha").css("height",height_noti_izq);
    }
    
    if(!$.isEmptyObject($.find('#content_window_right'))){
        var height_noti_izq = parseFloat(($("#content_window_right").css("height")).replace('px','')) - 69;
        $("#content_window_right").css("height",height_noti_izq);
    } 
});







