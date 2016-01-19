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
    function onlyNumber(event) {
       // Backspace, tab, enter, end, home, left, right
  // We don't support the del key in Opera because del == . == 46.
  var controlKeys = [8, 9, 13, 35, 36, 37, 39,48,110];
  // IE doesn't support indexOf
  var isControlKey = controlKeys.join(",").match(new RegExp(event.which));
  // Some browsers just don't raise events for control keys. Easy.
  // e.g. Safari backspace.
  if (!event.which || // Control keys in most browsers. e.g. Firefox tab is 0
      (49 <= event.which && event.which <= 57) || // Always 1 through 9
      ( $(this).attr("value")) || // No 0 first digit
      isControlKey) { // Opera assigns values for control keys.
    return;
  } else {
    event.preventDefault();
  }


    }

       function olnumberLetter(e) {
        // keycode in mozillaFirefox no permite la utilizacion de las flechas
        // de desplazamiento izq-arriba-derecha-abajo.
    var regex = new RegExp("[a-zA-Z0-9\b]+$");
    var keyCode = e.keyCode || e.which
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    // Allow: backspace, delete, tab, escape, and enter
    if (regex.test(str) || keyCode == 8 || keyCode == 46 || keyCode == 9 || keyCode == 9) {
        return true;
    }


       
        return false;


    }
    
    function onlyNumberDecimal(e) {
        //if the letter is not digit then display error and don't type anything
        var regex = new RegExp("^[0-9.]+$");
         var keyCode = e.keyCode || e.which
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    // Allow: backspace, delete, tab, escape, and enter
    if (regex.test(str) || keyCode == 8 || keyCode == 46 || (keyCode >= 35 && keyCode <= 40)) {
        return true;
    }

       
        return false;


    }
    
    



   /*numero natural*/
  
     $('.onlyNumbers').bind('keypress', onlyNumber);
     $('.numberLet').bind('keypress', olnumberLetter);
     $('.decimal').bind('keypress', onlyNumberDecimal);
     
     
       

