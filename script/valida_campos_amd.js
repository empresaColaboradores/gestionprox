/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */





   
      
        
     /**
     * funcion que valida 
     * que solo se escriba valores numericos
     * @param {type} event
     * @returns {undefined}
     */
    function onlyNumber(e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message

            return false;
        }


    }

       function razonSocial(e) {
           
           
        //if the letter is not digit then display error and don't type anything
        var regex = new RegExp("[a-zA-Z0-9\&\_\-\ñ\Ñ\ \.]");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }

       
        return false;


    }
    
    function olnumberDecimal(e) {
        //if the letter is not digit then display error and don't type anything
        var regex = new RegExp("^[0-9.]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }

       
        return false;


    }

    /**
     * funcion que permite ingresar un formato 
     * de cedula o nit 73.216.155 o  800.800.800-5
     * @param {type} e
     * @returns {Boolean}
     */
     function numberPuntosGuiones(e) {
        //if the letter is not digit then display error and don't type anything
        var regex = new RegExp("^[0-9\.\-]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }

       
        return false;


    }



   /*numero natural*/
  
  
     
     $('.nit_cc').bind('keypress', numberPuntosGuiones);
     $('.nombre_rs').bind('keypress', razonSocial);
     $('.onlyNumber').bind('keypress', razonSocial);
    
     
       

