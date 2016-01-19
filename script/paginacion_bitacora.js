/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function bitacoraPaginacion(page_num) {
        
   
    
     
       $.post('controlador/findHistorial_Bitacora_controller.php?pn=' + page_num, function(data) {            
            $('#vista3').hide().html(data).fadeIn();
           
          
            
          
            
        });
    
    
   
}























