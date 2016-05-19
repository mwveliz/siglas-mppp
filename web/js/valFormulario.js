
// Funcion para validar ingreso de solo numeros
function soloNumeros(evt){   

var charCode = (evt.which) ? evt.which : event.keyCode
    return (charCode == 8 || (charCode >= 44 && charCode <= 57) || charCode == 188);
}

