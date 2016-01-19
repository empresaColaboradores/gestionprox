function set_ot(page_num) {
        
   
    
     
       $.post('controlador/set_ot_controller.php?id=' + page_num, function(data) {            
            $('#vista4').hide().html(data).fadeIn();
           
          
            
          
            
        });
    
    
   
}

function consultaCausaBajaProductividad(fecha,turno,maquina){


    
    $.post('controlador/consultarCausaBajaProductividad.php?id=' +fecha+'&turno='+turno+'&maquina='+maquina, function(data) {            
            $('#vista4').hide().html(data).fadeIn();
           
          
            
          
            
        });
    
}


function find_ot_paginacion(page_num) {
    
    
     
       $.post('controlador/paginacion_ot_controller.php?pn=' + page_num, function(data) {            
            $('#vista3').hide().html(data).fadeIn();
           });
}

function find_ot_historial_paginacion(page_num) {
     
       $.post('controlador/paginacionHistorial_ot_controller.php?pn=' + page_num, function(data) {            
            $('#vista3').hide().html(data).fadeIn();
           });
}



function editarRegistroTiempoImproductivo(id_registro){


    
    $.post('controlador/editarRegistroTiempoImproductivo.php?id=' +id_registro, function(data) {            
            $('#vista4').hide().html(data).fadeIn();
           
          
            
          
            
        });
    
}

function editarPesajeProduccion(idOrdenProduccion,consecutivoProduccion,fichaTecnica,maquina,turno){


   
    $.post('controlador/editarRegsitroProduccion_controller.php?id=' +idOrdenProduccion+
            '&consecutivoProduccion='+consecutivoProduccion+
            '&fichaTecnica='+fichaTecnica+
            '&maquina='+maquina+
            '&turno='+turno, function(data) {      


            $('#vista4').hide().html(data).fadeIn();
           
          
            
          
            
        });
    
}








function limpiar(){
    
    
        
       $("#vista4").text("");
    
    
}
