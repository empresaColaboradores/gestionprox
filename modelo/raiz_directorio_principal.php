<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of raiz_directorio_principal
 *
 * @author Rocha
 */
/**
 * funcion que retorna al index del directorio raiz
 */
function raiz(){
     echo('<script>location.href="../"</script>');
     exit();
}

function raiz_amd(){
     echo('<script>location.href="/amd/"</script>');
     exit();
}

?>
