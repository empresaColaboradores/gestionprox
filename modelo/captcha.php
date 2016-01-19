<?php

if (!isset($_SESSION)) {
    session_start();
}

class Captchap {



    function verifyFormToken($form) {
        
        

        // check if a session is started and a token is transmitted, if not return an error
        if (!isset($_SESSION[$form . '_token'])) {
             $this->error();
            
        }

        // check if the form is sent with token in it
        if (!isset($_POST['captchat'])) {
            $this->error();
        }

        // compare the tokens against each other if they are still the same
        if ($_SESSION[$form . '_token'] !== $_POST['captchat']) {
           $this->error();

        }

          unset($_SESSION[$form . '_token']);

        return true;
    }

// fin valida capchat

    public function captchat($form) {
        $numeroaleatorio = md5(uniqid(microtime(), true));
        $_SESSION[$form . '_token'] = md5($numeroaleatorio);

        return $_SESSION[$form . '_token'];
    }// fin genera captchat


    public function error(){
           echo("<script>alert('Ha ocurrido un error al intentar de procesar los datos, contactar con el administrador')</script>");
            unset($_SESSION[$form . '_token']);
            echo('<script>location.href="../"</script>');
            exit();
    }


}

// fin de la clase
?>
