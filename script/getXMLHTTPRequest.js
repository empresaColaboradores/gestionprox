/**
*
*funcion que realiza las peticiones asincronas
*/
function peticionPost(url,dataToSend,$this){

	
    
    
    
    var callBack = function (dataReceived){
            $this.hide();
                      
           
            //$('#vista').append(dataReceived);
            $('#vista').hide().html(dataReceived).fadeIn();
        } // end callBack
        
        var typeOfDataToReceive = 'html';
        
        $.post( url, dataToSend, callBack, typeOfDataToReceive );
}



