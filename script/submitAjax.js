/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */







function handler(event){


    
    
        event.preventDefault();
        var $this = $(this);
        var url = $this.attr('action');
        var dataToSend = $this.serialize();

       
        peticionPost(url, dataToSend, $this);
}

  
  
      
  
    
    

    


