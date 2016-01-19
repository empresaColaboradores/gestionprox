/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$(function() {
    //El boton desencadena la accion
    $('#enviar').click(function() {
        //Se verifica si la opcion del select esta vacia
       
        
        if ($('#maquina').val() == 0) {
            
            
            
            alert('POR FAVOR SELECCIONE UNA MAQUINA');
                  return false;
        }
        
         if ($('#operador').val() == 0) {
            
            alert('POR FAVOR SELECCIONE UN OPERADOR');
                  return false;
        }
        
        
    });
});