<?php
/*
Plugin Name: Plugin Podaci klijenta
Author: Brigita
Version: 0.0.1
Description: This is custom Plugin
*/

if(!defined('ABSPATH')){
    define('ABSPATH', dirname(__FILE__) . '/');
}
 
include_once("podaci_o_klijentu.php");

register_activation_hook(__FILE__, "podaci_o_klijentu");
?>

<?php
