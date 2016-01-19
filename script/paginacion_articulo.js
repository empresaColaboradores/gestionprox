/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function tablaArticulo(page_num) {
    
    
     $.post('../controlador/findArticuloPaginadoAjax_controller.php?pn=' + page_num, function(data) {            
            $('#vista3').hide().html(data).fadeIn();
            
            
        });
}






















