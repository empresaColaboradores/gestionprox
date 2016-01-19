/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * 
 * @param {type} page_num
 * @returns {n/a}
 * funcion para la consulta asincrona, 
 * consulta que permite aplicar la tecnica de paginacion
 * y mostrar los registros en una bitacora.
 */
function bitacoraPaginacion_1(page_num) {
        
   
    
     
       $.post('controlador/findHistorial_Bitacora_controller_1.php?pn=' + page_num, function(data) {            
            $('#vista3').hide().html(data).fadeIn();
           
          
            
          
            
        });
    
    
   
}


function bitacoraPaginacion_timpo(page_num) {
        
   
    
     
       $.post('controlador/findHistorial_timpo_controller_1.php?pn=' + page_num, function(data) {            
            $('#vista3').hide().html(data).fadeIn();
           
          
            
          
            
        });
    
    
   
}

function paginacionPesajeProduccion(page_num){
    
    $.post('controlador/reportes/estadisticoProduccionPaginada_controller.php?pn=' + page_num, function(data) {            
            $('#vista3').hide().html(data).fadeIn();          
            
        });
    
}

function paginacionConsultaPesajeProduccion(page_num){
    
    $.post('controlador/produccion/consultaPesajeProduccionPaginada_controller.php?pn=' + page_num, function(data) {            
            $('#vista3').hide().html(data).fadeIn();          
            
        });
    
}


function paginacionTiempoImproductivo(page_num){
    
     $.post('controlador/paginacionTiempoImproductivo_controller.php?pn=' + page_num, function(data) {            
            $('#vista3').hide().html(data).fadeIn();
           
          
            
          
            
        });
    
}


function paginacionTiempoImproductivoCorto(page_num){
    
     $.post('controlador/produccion/paginacionTiempoImproductivoCorto_controller.php?pn=' + page_num, function(data) {            
            $('#vista3').hide().html(data).fadeIn();
           
          
            
          
            
        });
    
}


























