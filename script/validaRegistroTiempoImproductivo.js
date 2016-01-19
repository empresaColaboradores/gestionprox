/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$("document").ready(function() {
    //El boton desencadena la accion
    $('#enviar').click(function() {
        //Se verifica si la opcion del select esta vacia
       
        
        if ($('#maquina').val() == 0) {
            
            
            
             bootbox.dialog({
    message: "SELECCIONE UNA MAQUINA",
    title: "FALTA SELECCIONAR LA MAQUINA",
   
});
                  return false;
        }
        
      


         if ($('#seccion').val() == 0) {
            
         bootbox.dialog({
    message: "SELECCIONE UN SECCION",
    title: "FALTA SELECCIONAR UNA SECCION  DE LA MAQUINA",
   
});
                  return false;
        }

           if ($('#operador').val() == 0) {
            
         bootbox.dialog({
    message: "SELECCIONE UN OPERADOR",
    title: "FALTA SELECCIONAR EL OPERADOR",
   
});
                  return false;
        }


         if ($('#origen').val() == 0) {
            
         bootbox.dialog({
    message: "SELECCIONE UNA CAUSA  QUE GENERO EL TIEMPO IMPRODUCTIVO",
    title: "SELECCIONE UNA CAUSA QUE GENERO EL TIEMPO IMPRODUCTIVO",
   
});
                  return false;
        }



        if ($('#causa').val() == 0) {
            
         bootbox.dialog({
    message: "SELECCIONE EL TIPO DE  TIEMPO IMPRODUCTIVO",
    title: "SELECCIONE EL TIPO DE  TIEMPO IMPRODUCTIVO",
   
});
                  return false;
        }
        
        
    });
});