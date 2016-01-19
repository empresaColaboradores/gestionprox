function tablaClientePaginadoxz(num) {
    $.post("../controlador/findPaginadoAjax_controller.php?pn=" + num, function(e) {
        $("#vista3").hide().html(e).fadeIn();
       
    })
}