<?php



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$_SESSION['tipoinscrito']  = '2';

date_default_timezone_set('America/Belem');
$datetime1 = date_create('2021-04-01');
$datetime2 = new DateTime("now");


if ($datetime1 > $datetime2 ) {
header("Location: principal/inscreverPs.php"); }
 else
     {
      
     header("Location: aviso.html");
     }
     
?>