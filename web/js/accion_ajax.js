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

$('.sf_admin_boolean img').each(function() {
    $(this).attr("src", $(this).attr("src").replace('/images/../images/', '/images/icon/'));
});

$('#sf_admin_content img').each(function() {
    $(this).attr("src", $(this).attr("src").replace('/images/../images/', '/images/icon/'));
});
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
    });
    
$('#sf_admin_content img').each(function() {
    $(this).attr("src", $(this).attr("src").replace('/images/../images/', '/images/icon/'));
});

$('.sf_admin_boolean img').each(function() {
    $(this).attr("src", $(this).attr("src").replace('/images/../images/', '/images/icon/'));
});