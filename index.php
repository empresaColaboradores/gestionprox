<?php


if (!isset($_SESSION)) {
    session_start();
}


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of index_2
 *
 * @author Rocha
 */
if (isset($_SESSION['k_userName'])) {
    require_once 'index_2.php';
} else {
    
    require_once 'index_1.php';
}
?>
